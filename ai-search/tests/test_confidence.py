from app.config import Settings
from app.services.vector_search import apply_confidence_gate


def test_low_confidence_returns_empty():
    settings = Settings(image_min_score=0.28)
    matches = [("1", 0.15, {"title": "Chair"})]
    filtered, confidence, top_score, message = apply_confidence_gate(matches, settings)
    assert filtered == []
    assert confidence == "none"
    assert top_score == 0.15
    assert message is not None


def test_high_confidence_returns_results():
    settings = Settings(image_min_score=0.28)
    matches = [("1", 0.42, {"title": "Chair"})]
    filtered, confidence, top_score, message = apply_confidence_gate(matches, settings)
    assert len(filtered) == 1
    assert confidence == "high"
    assert message is None
