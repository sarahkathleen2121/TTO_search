from __future__ import annotations

import json
import logging
from functools import lru_cache

import httpx

from app.config import Settings

logger = logging.getLogger(__name__)

SYSTEM_PROMPT = """You are a merchandising expert for The Total Office (TTO), an office furniture supplier.
Given a customer's search query, suggest complementary product types they might also need in the same workspace.
Rules:
- Do NOT repeat the same product type as the query (e.g. chairs query -> suggest desks, lighting, storage, not more chairs).
- Use short catalog-style phrases suitable for semantic product search (2-4 words each).
- Focus on office / commercial furniture and accessories.
- Return valid JSON only."""


class LlmRelatedService:
    def __init__(self, settings: Settings):
        self.settings = settings

    def suggest_complementary_phrases(
        self, query: str, search_context: str = ""
    ) -> tuple[list[str], str]:
        query = query.strip()
        if not query:
            return [], ""

        if self.settings.groq_api_key:
            try:
                return self._groq_phrases(query, search_context)
            except Exception as exc:
                logger.warning("Groq related-products failed, using fallback: %s", exc)

        return self._fallback_phrases(query)

    def _groq_phrases(self, query: str, search_context: str = "") -> tuple[list[str], str]:
        context_block = ""
        if search_context.strip():
            context_block = (
                f"\nThe customer already found these products (do NOT suggest more of the same type):\n"
                f"{search_context.strip()}\n"
            )
        payload = {
            "model": self.settings.groq_model,
            "temperature": 0.4,
            "response_format": {"type": "json_object"},
            "messages": [
                {"role": "system", "content": SYSTEM_PROMPT},
                {
                    "role": "user",
                    "content": (
                        f'Customer query: "{query}"\n'
                        f"{context_block}"
                        f'Return JSON: {{"phrases": ["phrase1", ...], "heading": "short UI heading"}}'
                        f"\nProvide {self.settings.related_products_phrases} complementary phrases only."
                    ),
                },
            ],
        }
        headers = {
            "Authorization": f"Bearer {self.settings.groq_api_key}",
            "Content-Type": "application/json",
        }
        url = f"{self.settings.groq_base_url.rstrip('/')}/chat/completions"
        with httpx.Client(timeout=self.settings.groq_timeout) as client:
            response = client.post(url, headers=headers, json=payload)
            response.raise_for_status()
            content = response.json()["choices"][0]["message"]["content"]
        data = json.loads(content)
        phrases = [str(p).strip() for p in data.get("phrases", []) if str(p).strip()]
        heading = str(data.get("heading", "")).strip() or self._default_heading(query)
        return phrases[: self.settings.related_products_phrases], heading

    def _fallback_phrases(self, query: str) -> tuple[list[str], str]:
        q = query.lower()
        rules: list[tuple[tuple[str, ...], list[str], str]] = [
            (
                ("chair", "seating", "stool"),
                ["office desks", "task lighting", "monitor arms", "desk storage"],
                "Complete your workspace",
            ),
            (
                ("desk", "table", "workstation"),
                ["ergonomic chairs", "desk lighting", "storage pedestals", "monitor arms"],
                "Pairs well with your desk",
            ),
            (
                ("lamp", "light", "lighting"),
                ["office desks", "ergonomic chairs", "desk organizers"],
                "Lighting & workspace essentials",
            ),
            (
                ("storage", "cabinet", "pedestal", "locker"),
                ["office desks", "ergonomic chairs", "filing accessories"],
                "Organize your office",
            ),
            (
                ("sofa", "lounge", "soft seating"),
                ["coffee tables", "side tables", "accent lighting"],
                "Complete your lounge area",
            ),
            (
                ("monitor", "screen", "arm"),
                ["ergonomic chairs", "sit stand desks", "cable management"],
                "Ergonomic workstation add-ons",
            ),
        ]
        for keywords, phrases, heading in rules:
            if any(k in q for k in keywords):
                return phrases[: self.settings.related_products_phrases], heading

        return (
            ["office desks", "task lighting", "storage solutions", "ergonomic accessories"],
            "You may also like",
        )

    @staticmethod
    def _default_heading(query: str) -> str:
        return f"Goes well with {query}"


@lru_cache
def get_llm_related_service(settings: Settings) -> LlmRelatedService:
    return LlmRelatedService(settings)
