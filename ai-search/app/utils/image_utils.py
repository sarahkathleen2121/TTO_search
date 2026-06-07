from __future__ import annotations

import io
from typing import Tuple

from PIL import Image

ALLOWED_MIME = {"image/jpeg", "image/png", "image/webp"}
MAX_BYTES = 10 * 1024 * 1024
MAX_DIMENSION = 512


def validate_image_bytes(data: bytes, content_type: str | None) -> None:
    if len(data) > MAX_BYTES:
        raise ValueError("Image exceeds 10MB limit")
    if content_type and content_type not in ALLOWED_MIME:
        raise ValueError("Unsupported image type")
    try:
        img = Image.open(io.BytesIO(data))
        img.verify()
    except Exception as exc:
        raise ValueError("Invalid image file") from exc


def load_image_from_bytes(data: bytes) -> Image.Image:
    img = Image.open(io.BytesIO(data))
    return img.convert("RGB")


def resize_image(img: Image.Image, max_dim: int = MAX_DIMENSION) -> Image.Image:
    w, h = img.size
    if max(w, h) <= max_dim:
        return img
    scale = max_dim / max(w, h)
    return img.resize((int(w * scale), int(h * scale)), Image.Resampling.LANCZOS)


def crop_normalized(img: Image.Image, x: float, y: float, width: float, height: float) -> Image.Image:
    w, h = img.size
    left = int(x * w)
    top = int(y * h)
    right = int(min((x + width) * w, w))
    bottom = int(min((y + height) * h, h))
    if right <= left or bottom <= top:
        raise ValueError("Invalid crop coordinates")
    return img.crop((left, top, right, bottom))
