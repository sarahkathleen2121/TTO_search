from typing import Any, Optional

from pydantic import BaseModel


class ProductResult(BaseModel):
    id: str
    title: str
    description: str = ""
    image_url: str = ""
    category: str = ""
    color: str = ""
    material: str = ""
    brand: str = ""
    price: Optional[float] = None
    availability: str = "in_stock"
    similarity_score: float = 0.0
    slug: str = ""


class SearchResponse(BaseModel):
    results: list[ProductResult]
    total: int
    page: int
    limit: int
    confidence: str = "high"
    top_score: Optional[float] = None
    message: Optional[str] = None
    related_results: list[ProductResult] = []
    related_heading: Optional[str] = None


class FiltersResponse(BaseModel):
    categories: list[str]
    colors: list[str]
    materials: list[str]
    brands: list[str]


class SearchSuggestionItem(BaseModel):
    text: str
    kind: str = "query"


class SuggestResponse(BaseModel):
    suggestions: list[SearchSuggestionItem]


class HealthResponse(BaseModel):
    status: str
    models_loaded: bool
    vector_store: str
    text_index_count: int = 0
    image_index_count: int = 0


class BlogResult(BaseModel):
    id: str
    title: str
    slug: str
    url: str = ""
    image_url: str = ""
    excerpt: str = ""
    categories: list[str] = []
    created_at: str = ""
    similarity_score: float = 0.0


class BlogSearchResponse(BaseModel):
    results: list[BlogResult]
    total: int
    page: int
    limit: int

