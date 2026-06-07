from app.config import Settings
from app.services.suggestion_service import SuggestionService


def test_fallback_suggestions_for_partial_query():
    service = SuggestionService(Settings(groq_api_key=""))
    items = service.suggest_queries("desk", limit=4)
    assert len(items) >= 1
    assert any("desk" in s.lower() for s in items)
