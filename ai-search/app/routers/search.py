import json
from typing import Optional

from fastapi import APIRouter, File, Form, Header, HTTPException, UploadFile

from app.dependencies import get_embedding_service, get_vector_search_service, models_loading, models_ready
from app.schemas.request import SearchFilters, TextSearchRequest
from app.config import get_settings
from app.schemas.response import FiltersResponse, ProductResult, SearchResponse, SearchSuggestionItem, SuggestResponse, BlogSearchResponse
from app.services.suggestion_service import SuggestionService
from app.services.scene_processor import process_scene_crop
from app.utils.image_utils import load_image_from_bytes, resize_image, validate_image_bytes

router = APIRouter(tags=["search"])


def _ensure_models_ready():
    if models_loading():
        raise HTTPException(status_code=503, detail="AI models are still loading. Please try again in a few minutes.")
    if not models_ready():
        raise HTTPException(status_code=503, detail="AI models are not available.")


@router.get("/api/search/suggest", response_model=SuggestResponse)
def search_suggest(q: str = "", limit: int = 8):
    settings = get_settings()
    if not settings.suggestions_enabled:
        return SuggestResponse(suggestions=[])

    query = q.strip()
    if len(query) < 2:
        return SuggestResponse(suggestions=[])

    cap = min(max(limit, 1), 12)
    service = SuggestionService(settings)
    phrases = service.suggest_queries(query, cap)
    return SuggestResponse(
        suggestions=[SearchSuggestionItem(text=text, kind="query") for text in phrases]
    )


@router.post("/api/search/text", response_model=SearchResponse)
def search_text(body: TextSearchRequest):
    _ensure_models_ready()
    service = get_vector_search_service()
    return service.search_text(body.query, body.filters, body.sort, body.page, body.limit)


@router.post("/api/search/blogs", response_model=BlogSearchResponse)
def search_blogs(body: TextSearchRequest):
    _ensure_models_ready()
    service = get_vector_search_service()
    return service.search_blogs(body.query, body.filters, body.page, body.limit)


@router.post("/api/search/image", response_model=SearchResponse)
async def search_image(
    image: UploadFile = File(...),
    filters: Optional[str] = Form(None),
    sort: str = Form("relevance"),
    page: int = Form(1),
    limit: int = Form(20),
):
    _ensure_models_ready()
    data = await image.read()
    validate_image_bytes(data, image.content_type)
    img = resize_image(load_image_from_bytes(data))
    embeddings = get_embedding_service()
    vector = embeddings.embed_image(img)
    parsed_filters = _parse_filters(filters)
    store = get_vector_search_service()
    top_k = store.settings.text_top_k_filtered if parsed_filters else store.settings.text_top_k
    matches = store.store.query_image(vector, top_k=top_k, where=_build_where(parsed_filters))
    return store.search_image_matches(matches, sort, page, limit)


@router.post("/api/search/scene", response_model=SearchResponse)
async def search_scene(
    image: UploadFile = File(...),
    x: float = Form(...),
    y: float = Form(...),
    width: float = Form(...),
    height: float = Form(...),
    filters: Optional[str] = Form(None),
    sort: str = Form("relevance"),
    page: int = Form(1),
    limit: int = Form(20),
):
    _ensure_models_ready()
    data = await image.read()
    cropped = process_scene_crop(data, image.content_type, x, y, width, height)
    embeddings = get_embedding_service()
    vector = embeddings.embed_image(cropped)
    parsed_filters = _parse_filters(filters)
    store = get_vector_search_service()
    top_k = store.settings.text_top_k_filtered if parsed_filters else store.settings.text_top_k
    matches = store.store.query_image(vector, top_k=top_k, where=_build_where(parsed_filters))
    return store.search_image_matches(matches, sort, page, limit)


@router.get("/api/products/{product_id}", response_model=ProductResult)
def get_product(product_id: str):
    store = get_vector_search_service().store
    matches = store.query_text([0.0] * 384, top_k=1, where={"slug": product_id})
    if not matches:
        raise HTTPException(status_code=404, detail="Product not found")
    pid, score, meta = matches[0]
    from app.services.vector_search import meta_to_result

    return meta_to_result(pid, score, meta)


@router.get("/api/filters", response_model=FiltersResponse)
def get_filters():
    store = get_vector_search_service().store
    return FiltersResponse(
        categories=store.distinct_metadata("category", "text"),
        colors=store.distinct_metadata("colors", "text"),
        materials=store.distinct_metadata("materials", "text"),
        brands=store.distinct_metadata("brand", "text"),
    )


def _parse_filters(raw: Optional[str]) -> Optional[SearchFilters]:
    if not raw:
        return None
    try:
        return SearchFilters.model_validate(json.loads(raw))
    except Exception as exc:
        raise HTTPException(status_code=422, detail="Invalid filters JSON") from exc


def _build_where(filters: Optional[SearchFilters]):
    from app.services.vector_search import build_where

    return build_where(filters)
