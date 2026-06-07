from fastapi import APIRouter

from app.config import get_settings
from app.dependencies import get_embedding_service, get_vector_store, models_loading, models_ready
from app.schemas.response import HealthResponse

router = APIRouter(tags=["health"])


@router.get("/api/health", response_model=HealthResponse)
def health_check():
    settings = get_settings()
    store = get_vector_store()
    embeddings = get_embedding_service()
    loaded = models_ready()
    status = "ok" if loaded else ("loading" if models_loading() else "ok")
    return HealthResponse(
        status=status,
        models_loaded=loaded,
        vector_store=settings.vector_store,
        text_index_count=store.count_text(),
        image_index_count=store.count_image(),
    )
