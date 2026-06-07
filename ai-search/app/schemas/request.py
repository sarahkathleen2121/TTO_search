from typing import Any, Optional

from pydantic import BaseModel, Field, field_validator


class SearchFilters(BaseModel):
    category: Optional[str] = None
    color: Optional[str] = None
    material: Optional[str] = None
    brand: Optional[str] = None
    availability: Optional[str] = None


class TextSearchRequest(BaseModel):
    query: str = Field(..., min_length=1, max_length=500)
    filters: Optional[SearchFilters] = None
    sort: str = "relevance"
    page: int = Field(1, ge=1)
    limit: int = Field(20, ge=1, le=100)

    @field_validator("query")
    @classmethod
    def sanitize_query(cls, v: str) -> str:
        return v.strip()


class IndexProductPayload(BaseModel):
    id: str
    title: str
    description: str = ""
    category: str = ""
    brand: str = ""
    colors: list[str] = Field(default_factory=list)
    materials: list[str] = Field(default_factory=list)
    price: Optional[float] = None
    availability: str = "in_stock"
    slug: str = ""
    reference_image_url: str = ""
    has_image_embedding: bool = True


class BulkIndexRequest(BaseModel):
    products: list[IndexProductPayload]
    replace: bool = True


class SceneSearchCoords(BaseModel):
    x: float = Field(..., ge=0, le=1)
    y: float = Field(..., ge=0, le=1)
    width: float = Field(..., gt=0, le=1)
    height: float = Field(..., gt=0, le=1)
