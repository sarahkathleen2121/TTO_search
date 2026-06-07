from __future__ import annotations

import hashlib
import logging
from typing import Optional

import numpy as np
from PIL import Image

from app.config import Settings

logger = logging.getLogger(__name__)


class EmbeddingService:
    def __init__(self, settings: Settings):
        self.settings = settings
        self._text_model = None
        self._clip_model = None
        self._clip_processor = None
        self._loaded = False

    def load_models(self) -> None:
        if self.settings.skip_model_load:
            self._loaded = True
            return
        try:
            from sentence_transformers import SentenceTransformer

            self._text_model = SentenceTransformer(
                "sentence-transformers/all-MiniLM-L6-v2",
                device=self.settings.model_device,
            )
            from transformers import CLIPModel, CLIPProcessor

            self._clip_model = CLIPModel.from_pretrained("openai/clip-vit-base-patch32")
            self._clip_processor = CLIPProcessor.from_pretrained("openai/clip-vit-base-patch32")
            self._clip_model.to(self.settings.model_device)
            self._clip_model.eval()
            self._loaded = True
            logger.info("Embedding models loaded")
        except Exception as exc:
            logger.warning("Model load failed, using deterministic fallback: %s", exc)
            self._loaded = True

    @property
    def models_loaded(self) -> bool:
        return self._loaded

    def embed_text(self, text: str) -> list[float]:
        if self._text_model is not None:
            vec = self._text_model.encode(text, normalize_embeddings=True)
            return vec.tolist()
        return self._fallback_embed(text, dim=384)

    def embed_image(self, image: Image.Image) -> list[float]:
        if self._clip_model is not None and self._clip_processor is not None:
            import torch

            inputs = self._clip_processor(images=image, return_tensors="pt")
            inputs = {k: v.to(self.settings.model_device) for k, v in inputs.items()}
            with torch.no_grad():
                features = self._clip_model.get_image_features(**inputs)
            features = features / features.norm(dim=-1, keepdim=True)
            return features[0].cpu().numpy().tolist()
        raw = image.tobytes()
        return self._fallback_embed(raw.hex()[:8000], dim=512)

    def _fallback_embed(self, text: str, dim: int) -> list[float]:
        digest = hashlib.sha256(text.encode()).digest()
        rng = np.random.default_rng(int.from_bytes(digest[:8], "big"))
        vec = rng.standard_normal(dim)
        vec = vec / np.linalg.norm(vec)
        return vec.astype(float).tolist()
