from __future__ import annotations

import json
import logging

import httpx

from app.config import Settings

logger = logging.getLogger(__name__)

SYSTEM_PROMPT = """You are a search assistant for The Total Office (TTO), an office furniture catalog.
Given what the user has typed so far, suggest short search queries they might want (2-5 words each).
Focus on office furniture: chairs, desks, tables, storage, lighting, workstations, lounge seating.
Return valid JSON only."""


class SuggestionService:
    def __init__(self, settings: Settings):
        self.settings = settings

    def suggest_queries(self, partial: str, limit: int | None = None) -> list[str]:
        partial = partial.strip()
        if len(partial) < 2:
            return []

        limit = limit or self.settings.suggestions_limit

        if self.settings.groq_api_key:
            try:
                return self._groq_suggest(partial, limit)
            except Exception as exc:
                logger.warning("Groq suggestions failed, using fallback: %s", exc)

        return self._fallback_suggest(partial, limit)

    def _groq_suggest(self, partial: str, limit: int) -> list[str]:
        payload = {
            "model": self.settings.groq_model,
            "temperature": 0.5,
            "response_format": {"type": "json_object"},
            "messages": [
                {"role": "system", "content": SYSTEM_PROMPT},
                {
                    "role": "user",
                    "content": (
                        f'User is typing: "{partial}"\n'
                        f'Return JSON: {{"suggestions": ["query1", "query2", ...]}}'
                        f"\nProvide up to {limit} distinct, relevant completions."
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
        items = [str(s).strip() for s in data.get("suggestions", []) if str(s).strip()]
        seen: set[str] = set()
        out: list[str] = []
        partial_lower = partial.lower()
        for item in items:
            key = item.lower()
            if key in seen or key == partial_lower:
                continue
            seen.add(key)
            out.append(item)
            if len(out) >= limit:
                break
        return out

    def _fallback_suggest(self, partial: str, limit: int) -> list[str]:
        q = partial.lower()
        catalog = [
            "ergonomic office chair",
            "executive desk",
            "height adjustable desk",
            "conference table",
            "task lighting",
            "desk lamp",
            "office storage cabinet",
            "filing pedestal",
            "meeting room chairs",
            "visitor chairs",
            "sit stand workstation",
            "monitor arm",
            "lounge sofa",
            "reception desk",
            "acoustic panel",
        ]
        matches = [s for s in catalog if q in s.lower() or s.lower().startswith(q)]
        if not matches:
            matches = [f"{partial} chair", f"{partial} desk", f"office {partial}"]
        return matches[:limit]
