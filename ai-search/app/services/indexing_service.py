from __future__ import annotations

import logging
from typing import Any

import httpx
from PIL import Image

from app.config import Settings
from app.schemas.request import IndexProductPayload, IndexBlogPayload
from app.services.embedding_service import EmbeddingService
from app.services.vector_search import build_index_text, metadata_from_payload
from app.utils.image_utils import load_image_from_bytes, resize_image
from app.utils.vector_db import VectorStore

logger = logging.getLogger(__name__)


def build_blog_index_text(data: dict[str, Any]) -> str:
    parts = [
        data.get("title", ""),
        data.get("category", ""),
        data.get("meta_keywords", ""),
        data.get("content", ""),
    ]
    return " | ".join(p for p in parts if p)


def blog_metadata_from_payload(data: dict[str, Any], settings: Settings) -> dict[str, Any]:
    return {
        "title": data.get("title", ""),
        "slug": data.get("slug", ""),
        "category": data.get("category", ""),
        "excerpt": data.get("content", "")[:300],
        "image_url": data.get("image_url", ""),
        "created_at": data.get("created_at", ""),
        "index_version": settings.index_version,
    }


class IndexingService:
    def __init__(self, settings: Settings, store: VectorStore, embeddings: EmbeddingService):
        self.settings = settings
        self.store = store
        self.embeddings = embeddings

    def index_product(self, payload: IndexProductPayload) -> dict[str, Any]:
        data = payload.model_dump()
        product_id = str(data["id"])
        meta = metadata_from_payload(data, self.settings)

        text = build_index_text(data)
        text_vec = self.embeddings.embed_text(text)
        self.store.upsert_text(product_id, text_vec, meta)

        has_image = False
        if data.get("has_image_embedding") and data.get("reference_image_url"):
            try:
                image = self._fetch_image(data["reference_image_url"])
                image_vec = self.embeddings.embed_image(image)
                self.store.upsert_image(product_id, image_vec, meta)
                has_image = True
            except Exception as exc:
                logger.warning("Image embed failed for %s: %s", product_id, exc)

        return {"id": product_id, "text_indexed": True, "image_indexed": has_image}

    def bulk_index(self, products: list[IndexProductPayload], replace: bool = True) -> dict[str, Any]:
        if replace and products:
            self.store.clear_all()
        indexed = 0
        image_indexed = 0
        errors = []
        for product in products:
            try:
                result = self.index_product(product)
                indexed += 1
                if result.get("image_indexed"):
                    image_indexed += 1
            except Exception as exc:
                errors.append({"id": product.id, "error": str(exc)})
        return {
            "indexed": indexed,
            "image_indexed": image_indexed,
            "errors": errors,
            "total": len(products),
        }

    def index_blog(self, payload: IndexBlogPayload) -> dict[str, Any]:
        data = payload.model_dump()
        blog_id = str(data["id"])
        meta = blog_metadata_from_payload(data, self.settings)

        text = build_blog_index_text(data)
        text_vec = self.embeddings.embed_text(text)
        self.store.upsert_blog_text(blog_id, text_vec, meta)

        return {"id": blog_id, "text_indexed": True}

    def bulk_index_blogs(self, blogs: list[IndexBlogPayload], replace: bool = True) -> dict[str, Any]:
        if replace:
            # Clear only the blogs collection to avoid erasing products.
            if hasattr(self.store, "_blogs") and hasattr(self.store._blogs, "delete"):
                try:
                    self.store._blogs.delete()
                except Exception:
                    pass
            elif hasattr(self.store, "_index") and hasattr(self.store._index, "delete"):
                # For Pinecone
                try:
                    self.store._index.delete(delete_all=True, namespace="blog")
                except Exception:
                    pass

        indexed = 0
        errors = []
        for blog in blogs:
            try:
                self.index_blog(blog)
                indexed += 1
            except Exception as exc:
                errors.append({"id": blog.id, "error": str(exc)})
        return {
            "indexed": indexed,
            "errors": errors,
            "total": len(blogs),
        }

    def delete_product(self, product_id: str) -> None:
        self.store.delete_product(product_id)

    def delete_blog(self, blog_id: str) -> None:
        self.store.delete_blog(blog_id)

    def _fetch_image(self, url: str) -> Image.Image:
        if url.startswith("/"):
            raise ValueError("Relative image URL cannot be fetched by AI service")
        with httpx.Client(timeout=30.0, follow_redirects=True) as client:
            response = client.get(url)
            response.raise_for_status()
            img = load_image_from_bytes(response.content)
            return resize_image(img)
