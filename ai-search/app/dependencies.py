import logging
import threading

from app.config import get_settings
from app.services.embedding_service import EmbeddingService
from app.services.indexing_service import IndexingService
from app.services.vector_search import VectorSearchService
from app.utils.vector_db import VectorStore, create_vector_store

logger = logging.getLogger(__name__)

_embeddings: EmbeddingService | None = None
_store: VectorStore | None = None
_models_loading = False
_models_ready = False


def init_services() -> None:
    """Start vector store immediately; load ML models in background (CPU can take several minutes)."""
    global _embeddings, _store, _models_loading, _models_ready
    settings = get_settings()
    _store = create_vector_store(settings)
    _embeddings = EmbeddingService(settings)

    if settings.skip_model_load:
        _embeddings.load_models()
        _models_ready = True
        return

    if _models_loading or _models_ready:
        return

    _models_loading = True

    def _load():
        global _models_ready, _models_loading
        try:
            logger.info("Loading embedding models (first run may download weights)...")
            _embeddings.load_models()
            _models_ready = True
            logger.info("Embedding models ready")
        except Exception as exc:
            logger.exception("Model load failed: %s", exc)
        finally:
            _models_loading = False

    threading.Thread(target=_load, name="model-loader", daemon=True).start()


def models_ready() -> bool:
    return _models_ready and _embeddings is not None and _embeddings.models_loaded


def models_loading() -> bool:
    return _models_loading


def get_embedding_service() -> EmbeddingService:
    if _embeddings is None:
        init_services()
    assert _embeddings is not None
    return _embeddings


def get_vector_store() -> VectorStore:
    if _store is None:
        init_services()
    assert _store is not None
    return _store


def get_vector_search_service() -> VectorSearchService:
    settings = get_settings()
    return VectorSearchService(settings, get_vector_store(), get_embedding_service())


def get_indexing_service() -> IndexingService:
    settings = get_settings()
    return IndexingService(settings, get_vector_store(), get_embedding_service())
