"""Helpers to keep related (complementary) products distinct from main search matches."""

from __future__ import annotations

import re
from typing import Any

# Map detected query intent -> keywords that indicate the same product family (skip in related).
PRIMARY_TYPES: dict[str, tuple[str, ...]] = {
    "chair": ("chair", "seating", "stool", "bench"),
    "desk": ("desk", "workstation", "work bench"),
    "table": ("table", "conference table", "meeting table"),
    "lamp": ("lamp", "lighting", "light "),
    "storage": ("storage", "cabinet", "pedestal", "locker", "cupboard", "filing"),
    "sofa": ("sofa", "lounge", "settee", "soft seating"),
    "monitor": ("monitor arm", "screen arm", "monitor"),
}

STOP_WORDS = frozenset(
    {
        "office",
        "the",
        "and",
        "for",
        "with",
        "product",
        "products",
        "commercial",
        "ergonomic",
    }
)


def detect_primary_types(text: str) -> set[str]:
    lowered = text.lower()
    found: set[str] = set()
    for ptype, keywords in PRIMARY_TYPES.items():
        if any(k in lowered for k in keywords):
            found.add(ptype)
    return found


def product_matches_primary_types(meta: dict[str, Any], primary_types: set[str]) -> bool:
    if not primary_types:
        return False
    blob = f"{meta.get('category', '')} {meta.get('title', '')}".lower()
    for ptype in primary_types:
        if any(k in blob for k in PRIMARY_TYPES.get(ptype, ())):
            return True
    return False


def build_search_context(matches: list[tuple[str, float, dict[str, Any]]], max_items: int = 3) -> str:
    if not matches:
        return ""
    parts = []
    for _, score, meta in matches[:max_items]:
        title = meta.get("title", "")
        category = meta.get("category", "")
        if title or category:
            parts.append(f"{title} ({category})" if category else title)
    return "; ".join(parts)


def normalize_related_query(query: str, context: str = "") -> str:
    base = query.strip()
    if context.strip():
        return f"{base}. Context from results: {context.strip()}"
    return base
