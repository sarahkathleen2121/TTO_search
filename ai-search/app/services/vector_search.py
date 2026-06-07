from __future__ import annotations

import json
from typing import Any, Optional

from app.config import Settings
from app.schemas.request import SearchFilters
from app.schemas.response import ProductResult, SearchResponse
from app.services.embedding_service import EmbeddingService
from app.services.llm_related_service import LlmRelatedService
from app.utils.related_products import (
    build_search_context,
    detect_primary_types,
    product_matches_primary_types,
)
from app.utils.vector_db import VectorStore


def build_index_text(payload: dict[str, Any]) -> str:
    colors = payload.get("colors") or []
    materials = payload.get("materials") or []
    if isinstance(colors, str):
        colors = json.loads(colors) if colors.startswith("[") else [colors]
    if isinstance(materials, str):
        materials = json.loads(materials) if materials.startswith("[") else [materials]
    parts = [
        payload.get("title", ""),
        payload.get("brand", ""),
        payload.get("category", ""),
        ", ".join(colors) if colors else "",
        ", ".join(materials) if materials else "",
        payload.get("description", ""),
    ]
    return " | ".join(p for p in parts if p)


def metadata_from_payload(payload: dict[str, Any], settings: Settings) -> dict[str, Any]:
    colors = payload.get("colors") or []
    materials = payload.get("materials") or []
    if not isinstance(colors, str):
        colors = json.dumps(colors)
    if not isinstance(materials, str):
        materials = json.dumps(materials)
    return {
        "title": payload.get("title", ""),
        "description": (payload.get("description") or "")[:500],
        "category": payload.get("category", ""),
        "brand": payload.get("brand", ""),
        "colors": colors,
        "materials": materials,
        "price": float(payload.get("price") or 0),
        "availability": payload.get("availability", "in_stock"),
        "slug": payload.get("slug", ""),
        "image_url": payload.get("reference_image_url", ""),
        "index_version": settings.index_version,
    }


def build_where(filters: Optional[SearchFilters]) -> Optional[dict[str, Any]]:
    if not filters:
        return None
    clauses = []
    if filters.category:
        clauses.append({"category": filters.category})
    if filters.brand:
        clauses.append({"brand": filters.brand})
    if filters.availability:
        clauses.append({"availability": filters.availability})
    if not clauses:
        return None
    if len(clauses) == 1:
        return clauses[0]
    return {"$and": clauses}


def meta_to_result(product_id: str, score: float, meta: dict[str, Any]) -> ProductResult:
    colors_raw = meta.get("colors", "")
    materials_raw = meta.get("materials", "")
    color = ""
    material = ""
    try:
        if colors_raw:
            parsed = json.loads(colors_raw) if isinstance(colors_raw, str) and colors_raw.startswith("[") else [colors_raw]
            color = parsed[0] if parsed else ""
    except json.JSONDecodeError:
        color = str(colors_raw)
    try:
        if materials_raw:
            parsed = json.loads(materials_raw) if isinstance(materials_raw, str) and materials_raw.startswith("[") else [materials_raw]
            material = parsed[0] if parsed else ""
    except json.JSONDecodeError:
        material = str(materials_raw)

    return ProductResult(
        id=product_id,
        title=meta.get("title", ""),
        description=meta.get("description", ""),
        image_url=meta.get("image_url", ""),
        category=meta.get("category", ""),
        color=color,
        material=material,
        brand=meta.get("brand", ""),
        price=float(meta.get("price") or 0) or None,
        availability=meta.get("availability", "in_stock"),
        similarity_score=round(score, 4),
        slug=meta.get("slug", ""),
    )


def apply_confidence_gate(
    matches: list[tuple[str, float, dict[str, Any]]],
    settings: Settings,
) -> tuple[list[tuple[str, float, dict[str, Any]]], str, Optional[float], Optional[str]]:
    if not matches:
        return [], "none", None, "We couldn't find a close visual match. Try a clearer product photo, different angle, or use text search."

    top_score = matches[0][1]
    if top_score < settings.image_min_score:
        return (
            [],
            "none",
            top_score,
            "We couldn't find a close visual match. Try a clearer product photo, different angle, or use text search.",
        )

    filtered = [m for m in matches if m[1] >= settings.image_min_score]
    if len(filtered) > 1 and (filtered[0][1] - filtered[1][1]) < settings.image_min_gap and top_score < 0.35:
        filtered = filtered[:1]

    confidence = "high" if top_score >= 0.35 else "medium"
    return filtered, confidence, top_score, None


def paginate_matches(
    matches: list[tuple[str, float, dict[str, Any]]],
    page: int,
    limit: int,
) -> SearchResponse:
    total = len(matches)
    start = (page - 1) * limit
    end = start + limit
    page_matches = matches[start:end]
    results = [meta_to_result(pid, score, meta) for pid, score, meta in page_matches]
    return SearchResponse(results=results, total=total, page=page, limit=limit)


class VectorSearchService:
    def __init__(
        self,
        settings: Settings,
        store: VectorStore,
        embeddings: EmbeddingService,
        llm_related: LlmRelatedService | None = None,
    ):
        self.settings = settings
        self.store = store
        self.embeddings = embeddings
        self.llm_related = llm_related or LlmRelatedService(settings)

    def search_text(
        self,
        query: str,
        filters: Optional[SearchFilters],
        sort: str,
        page: int,
        limit: int,
        include_related: bool = True,
    ) -> SearchResponse:
        # If skip_model_load is True or models are not loaded, use a smart keyword fallback search over Chroma metadata
        if self.settings.skip_model_load or self.embeddings._text_model is None:
            if hasattr(self.store, "_text") and hasattr(self.store._text, "get"):
                data = self.store._text.get(include=["metadatas"])
                ids = data.get("ids", [])
                metadatas = data.get("metadatas", [])
                
                stop_words = {
                    "i", "me", "my", "we", "our", "you", "your", "he", "she", "it", "they",
                    "a", "an", "the", "this", "that", "these", "those",
                    "is", "am", "are", "was", "were", "be", "been", "being",
                    "have", "has", "had", "do", "does", "did",
                    "will", "would", "shall", "should", "can", "could", "may", "might",
                    "want", "need", "looking", "find", "get", "show",
                    "for", "of", "in", "on", "at", "to", "with", "from", "by", "about",
                    "and", "or", "but", "not", "no", "so", "if", "then",
                    "some", "any", "all", "very", "just", "also", "please", "thanks"
                }
                
                import re
                words = re.findall(r'\w+', query.lower())
                keywords = [w for w in words if len(w) >= 2 and w not in stop_words]
                
                scored_matches = []
                for pid, meta in zip(ids, metadatas):
                    if not meta:
                        continue
                    
                    if filters:
                        if filters.category and meta.get("category") != filters.category:
                            continue
                        if filters.brand and meta.get("brand") != filters.brand:
                            continue
                        if filters.availability and meta.get("availability") != filters.availability:
                            continue
                    
                    if not keywords:
                        scored_matches.append((pid, 0.5, meta))
                        continue
                    
                    score = 0
                    title = (meta.get("title") or "").lower()
                    description = (meta.get("description") or "").lower()
                    category = (meta.get("category") or "").lower()
                    brand = (meta.get("brand") or "").lower()
                    
                    matched_kws = 0
                    for kw in keywords:
                        kw_score = 0
                        pattern = kw
                        if kw.endswith('s') and len(kw) > 3:
                            pattern = kw[:-1]
                        
                        if pattern in title:
                            kw_score += 15.0 if re.search(rf'\b{pattern}', title) else 7.0
                        if pattern in category:
                            kw_score += 10.0 if re.search(rf'\b{pattern}', category) else 5.0
                        if pattern in brand:
                            kw_score += 6.0 if re.search(rf'\b{pattern}', brand) else 3.0
                        if pattern in description:
                            kw_score += 2.0 if re.search(rf'\b{pattern}', description) else 1.0
                        
                        if kw_score > 0:
                            score += kw_score
                            matched_kws += 1
                    
                    if matched_kws > 0:
                        normalized_score = 0.5 + (0.45 * (matched_kws / len(keywords))) * min(1.0, score / 20.0)
                        scored_matches.append((pid, normalized_score, meta))
                
                matches = sorted(scored_matches, key=lambda m: -m[1])
            else:
                vector = self.embeddings.embed_text(query)
                top_k = self.settings.text_top_k_filtered if filters else self.settings.text_top_k
                where = build_where(filters)
                matches = self.store.query_text(vector, top_k=top_k, where=where)
        else:
            vector = self.embeddings.embed_text(query)
            top_k = self.settings.text_top_k_filtered if filters else self.settings.text_top_k
            where = build_where(filters)
            matches = self.store.query_text(vector, top_k=top_k, where=where)

        matches = self._sort_matches(matches, sort)
        response = paginate_matches(matches, page, limit)
        if matches:
            response.top_score = matches[0][1]
            response.confidence = "high" if matches[0][1] >= 0.35 else "medium"
        else:
            response.confidence = "none"
            response.message = "No products matched your search. Try different keywords or filters."

        if include_related and self.settings.related_products_enabled and query.strip():
            exclude = {m[0] for m in matches}
            context = build_search_context(matches)
            related, heading = self.search_related_products(
                query, exclude_ids=exclude, search_context=context
            )
            response.related_results = related
            response.related_heading = heading

        return response

    def search_related_products(
        self,
        query: str,
        exclude_ids: set[str] | None = None,
        search_context: str = "",
    ) -> tuple[list[ProductResult], str | None]:
        exclude_ids = exclude_ids or set()
        primary_types = detect_primary_types(f"{query} {search_context}")
        phrases, heading = self.llm_related.suggest_complementary_phrases(query, search_context)
        if not phrases:
            return [], None

        limit = self.settings.related_products_limit
        min_score = self.settings.related_min_score
        seen = set(exclude_ids)
        related: list[ProductResult] = []

        all_docs = []
        if (self.settings.skip_model_load or self.embeddings._text_model is None) and hasattr(self.store, "_text") and hasattr(self.store._text, "get"):
            data = self.store._text.get(include=["metadatas"])
            ids = data.get("ids", [])
            metadatas = data.get("metadatas", [])
            all_docs = list(zip(ids, metadatas))

        for phrase in phrases:
            if all_docs:
                words = [w for w in phrase.lower().split() if len(w) >= 2]
                phrase_matches = []
                for pid, meta in all_docs:
                    if not meta:
                        continue
                    score = 0
                    title = (meta.get("title") or "").lower()
                    description = (meta.get("description") or "").lower()
                    category = (meta.get("category") or "").lower()
                    
                    for w in words:
                        pattern = w
                        if w.endswith('s') and len(w) > 3:
                            pattern = w[:-1]
                        
                        if pattern in title:
                            score += 10.0
                        if pattern in category:
                            score += 8.0
                        if pattern in description:
                            score += 2.0
                    
                    if score > 0:
                        sim_score = min(0.95, 0.3 + (score / 30.0))
                        phrase_matches.append((pid, sim_score, meta))
                matches = sorted(phrase_matches, key=lambda m: -m[1])
            else:
                vector = self.embeddings.embed_text(phrase)
                matches = self.store.query_text(vector, top_k=40, where=None)

            for pid, score, meta in matches:
                if pid in seen or score < min_score:
                    continue
                if product_matches_primary_types(meta, primary_types):
                    continue
                seen.add(pid)
                related.append(meta_to_result(pid, score, meta))
                if len(related) >= limit:
                    return related, heading
            if len(related) >= limit:
                break

        return related[:limit], heading

    def search_image_matches(
        self,
        matches: list[tuple[str, float, dict[str, Any]]],
        sort: str,
        page: int,
        limit: int,
        include_related: bool = True,
    ) -> SearchResponse:
        filtered, confidence, top_score, message = apply_confidence_gate(matches, self.settings)
        filtered = self._sort_matches(filtered, sort)
        capped = filtered[: self.settings.image_max_results]
        response = paginate_matches(capped, page, limit)
        response.confidence = confidence
        response.top_score = top_score
        response.message = message

        if (
            include_related
            and self.settings.related_products_enabled
            and filtered
            and confidence != "none"
        ):
            top_meta = filtered[0][2]
            related_query = f"{top_meta.get('title', '')} {top_meta.get('category', '')}".strip()
            exclude = {m[0] for m in filtered}
            context = build_search_context(filtered)
            related, heading = self.search_related_products(
                related_query or "office furniture",
                exclude_ids=exclude,
                search_context=context,
            )
            response.related_results = related
            response.related_heading = heading or "Complete your space"

        return response

    def _sort_matches(
        self,
        matches: list[tuple[str, float, dict[str, Any]]],
        sort: str,
    ) -> list[tuple[str, float, dict[str, Any]]]:
        if sort == "category":
            return sorted(matches, key=lambda m: (m[2].get("category", ""), -m[1]))
        if sort == "price":
            return sorted(matches, key=lambda m: (float(m[2].get("price") or 0), -m[1]))
        return sorted(matches, key=lambda m: -m[1])
