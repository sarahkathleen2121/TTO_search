from functools import lru_cache

from pydantic_settings import BaseSettings, SettingsConfigDict


class Settings(BaseSettings):
    model_config = SettingsConfigDict(env_file=".env", env_file_encoding="utf-8", extra="ignore")

    api_key: str = "change-me-internal-key"
    vector_store: str = "chroma"
    chroma_persist_dir: str = "./data/chroma"
    text_collection: str = "tto_products_text"
    image_collection: str = "tto_products_image"
    blogs_collection: str = "tto_blogs_text"
    pinecone_api_key: str = ""
    pinecone_index: str = ""
    pinecone_environment: str = ""
    image_min_score: float = 0.28
    image_min_gap: float = 0.04
    image_max_results: int = 20
    text_top_k: int = 100
    text_top_k_filtered: int = 300
    allowed_origins: str = "http://localhost:8000,http://127.0.0.1:8000"
    model_device: str = "cpu"
    skip_model_load: bool = False
    index_version: str = "1"
    related_products_enabled: bool = True
    related_products_limit: int = 8
    related_products_phrases: int = 4
    related_min_score: float = 0.22
    suggestions_enabled: bool = True
    suggestions_limit: int = 6
    groq_api_key: str = ""
    groq_model: str = "llama-3.1-8b-instant"
    groq_base_url: str = "https://api.groq.com/openai/v1"
    groq_timeout: float = 20.0


@lru_cache
def get_settings() -> Settings:
    return Settings()
