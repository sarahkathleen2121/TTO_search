from __future__ import annotations

from abc import ABC, abstractmethod
from typing import Any, Optional

import numpy as np

from app.config import Settings


class VectorStore(ABC):
    @abstractmethod
    def upsert_text(self, product_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        pass

    @abstractmethod
    def upsert_image(self, product_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        pass

    @abstractmethod
    def upsert_blog_text(self, blog_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        pass

    @abstractmethod
    def delete_product(self, product_id: str) -> None:
        pass

    @abstractmethod
    def delete_blog(self, blog_id: str) -> None:
        pass

    @abstractmethod
    def query_text(
        self, vector: list[float], top_k: int, where: Optional[dict[str, Any]] = None
    ) -> list[tuple[str, float, dict[str, Any]]]:
        pass

    @abstractmethod
    def query_image(
        self, vector: list[float], top_k: int, where: Optional[dict[str, Any]] = None
    ) -> list[tuple[str, float, dict[str, Any]]]:
        pass

    @abstractmethod
    def query_blog_text(
        self, vector: list[float], top_k: int, where: Optional[dict[str, Any]] = None
    ) -> list[tuple[str, float, dict[str, Any]]]:
        pass

    @abstractmethod
    def count_text(self) -> int:
        pass

    @abstractmethod
    def count_image(self) -> int:
        pass

    @abstractmethod
    def count_blog_text(self) -> int:
        pass

    @abstractmethod
    def clear_all(self) -> None:
        pass

    @abstractmethod
    def distinct_metadata(self, field: str, namespace: str = "text") -> list[str]:
        pass


class ChromaVectorStore(VectorStore):
    def __init__(self, settings: Settings):
        import chromadb

        self._client = chromadb.PersistentClient(path=settings.chroma_persist_dir)
        self._text = self._client.get_or_create_collection(settings.text_collection)
        self._image = self._client.get_or_create_collection(settings.image_collection)
        self._blogs = self._client.get_or_create_collection(settings.blogs_collection)

    def upsert_text(self, product_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        self._text.upsert(ids=[product_id], embeddings=[vector], metadatas=[metadata])

    def upsert_image(self, product_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        self._image.upsert(ids=[product_id], embeddings=[vector], metadatas=[metadata])

    def upsert_blog_text(self, blog_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        self._blogs.upsert(ids=[blog_id], embeddings=[vector], metadatas=[metadata])

    def delete_product(self, product_id: str) -> None:
        try:
            self._text.delete(ids=[product_id])
        except Exception:
            pass
        try:
            self._image.delete(ids=[product_id])
        except Exception:
            pass

    def delete_blog(self, blog_id: str) -> None:
        try:
            self._blogs.delete(ids=[blog_id])
        except Exception:
            pass

    def query_text(
        self, vector: list[float], top_k: int, where: Optional[dict[str, Any]] = None
    ) -> list[tuple[str, float, dict[str, Any]]]:
        return self._query(self._text, vector, top_k, where)

    def query_image(
        self, vector: list[float], top_k: int, where: Optional[dict[str, Any]] = None
    ) -> list[tuple[str, float, dict[str, Any]]]:
        return self._query(self._image, vector, top_k, where)

    def query_blog_text(
        self, vector: list[float], top_k: int, where: Optional[dict[str, Any]] = None
    ) -> list[tuple[str, float, dict[str, Any]]]:
        return self._query(self._blogs, vector, top_k, where)

    def _query(self, collection, vector, top_k, where):
        kwargs: dict[str, Any] = {"query_embeddings": [vector], "n_results": top_k}
        if where:
            kwargs["where"] = where
        result = collection.query(**kwargs)
        ids = result.get("ids", [[]])[0]
        distances = result.get("distances", [[]])[0]
        metadatas = result.get("metadatas", [[]])[0]
        out = []
        for pid, dist, meta in zip(ids, distances, metadatas):
            score = 1.0 - float(dist)
            out.append((pid, score, meta or {}))
        return out

    def count_text(self) -> int:
        return self._text.count()

    def count_image(self) -> int:
        return self._image.count()

    def count_blog_text(self) -> int:
        return self._blogs.count()

    def clear_all(self) -> None:
        from app.config import get_settings

        settings = get_settings()
        names = [settings.text_collection, settings.image_collection, settings.blogs_collection]
        for name in names:
            try:
                self._client.delete_collection(name)
            except Exception:
                pass
        self._text = self._client.get_or_create_collection(settings.text_collection)
        self._image = self._client.get_or_create_collection(settings.image_collection)
        self._blogs = self._client.get_or_create_collection(settings.blogs_collection)

    def distinct_metadata(self, field: str, namespace: str = "text") -> list[str]:
        if namespace == "text":
            collection = self._text
        elif namespace == "image":
            collection = self._image
        else:
            collection = self._blogs
            
        data = collection.get(include=["metadatas"])
        values: set[str] = set()
        for meta in data.get("metadatas") or []:
            if not meta:
                continue
            raw = meta.get(field)
            if raw:
                if isinstance(raw, str) and raw.startswith("["):
                    import json

                    try:
                        for item in json.loads(raw):
                            values.add(str(item))
                    except json.JSONDecodeError:
                        values.add(raw)
                else:
                    values.add(str(raw))
        return sorted(values)


class PineconeVectorStore(VectorStore):
    def __init__(self, settings: Settings):
        from pinecone import Pinecone

        pc = Pinecone(api_key=settings.pinecone_api_key)
        self._index = pc.Index(settings.pinecone_index)
        self._text_ns = "text"
        self._image_ns = "image"
        self._blog_ns = "blog"

    def upsert_text(self, product_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        self._index.upsert(vectors=[{"id": product_id, "values": vector, "metadata": metadata}], namespace=self._text_ns)

    def upsert_image(self, product_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        self._index.upsert(vectors=[{"id": product_id, "values": vector, "metadata": metadata}], namespace=self._image_ns)

    def upsert_blog_text(self, blog_id: str, vector: list[float], metadata: dict[str, Any]) -> None:
        self._index.upsert(vectors=[{"id": blog_id, "values": vector, "metadata": metadata}], namespace=self._blog_ns)

    def delete_product(self, product_id: str) -> None:
        self._index.delete(ids=[product_id], namespace=self._text_ns)
        self._index.delete(ids=[product_id], namespace=self._image_ns)

    def delete_blog(self, blog_id: str) -> None:
        self._index.delete(ids=[blog_id], namespace=self._blog_ns)

    def query_text(self, vector, top_k, where=None):
        return self._query(self._text_ns, vector, top_k, where)

    def query_image(self, vector, top_k, where=None):
        return self._query(self._image_ns, vector, top_k, where)

    def query_blog_text(self, vector, top_k, where=None):
        return self._query(self._blog_ns, vector, top_k, where)

    def _query(self, namespace, vector, top_k, where):
        result = self._index.query(vector=vector, top_k=top_k, include_metadata=True, namespace=namespace, filter=where)
        out = []
        for match in result.get("matches", []):
            out.append((match["id"], float(match["score"]), match.get("metadata") or {}))
        return out

    def count_text(self) -> int:
        return self._index.describe_index_stats().get("namespaces", {}).get(self._text_ns, {}).get("vector_count", 0)

    def count_image(self) -> int:
        return self._index.describe_index_stats().get("namespaces", {}).get(self._image_ns, {}).get("vector_count", 0)

    def count_blog_text(self) -> int:
        return self._index.describe_index_stats().get("namespaces", {}).get(self._blog_ns, {}).get("vector_count", 0)

    def clear_all(self) -> None:
        self._index.delete(delete_all=True, namespace=self._text_ns)
        self._index.delete(delete_all=True, namespace=self._image_ns)
        self._index.delete(delete_all=True, namespace=self._blog_ns)

    def distinct_metadata(self, field: str, namespace: str = "text") -> list[str]:
        return []


def create_vector_store(settings: Settings) -> VectorStore:
    if settings.vector_store.lower() == "pinecone":
        return PineconeVectorStore(settings)
    return ChromaVectorStore(settings)
