from app.utils.related_products import (
    detect_primary_types,
    product_matches_primary_types,
)


def test_chair_query_detects_chair_type():
    assert "chair" in detect_primary_types("ergonomic office chairs")


def test_related_skips_same_family():
    meta = {"title": "Task Chair Pro", "category": "Seating"}
    assert product_matches_primary_types(meta, {"chair"})
