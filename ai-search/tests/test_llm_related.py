from app.config import Settings
from app.services.llm_related_service import LlmRelatedService


def test_fallback_chair_query_suggests_complements():
    service = LlmRelatedService(Settings(groq_api_key=""))
    phrases, heading = service.suggest_complementary_phrases("ergonomic office chairs")
    assert len(phrases) >= 2
    assert not any("chair" in p.lower() for p in phrases)
    assert heading
