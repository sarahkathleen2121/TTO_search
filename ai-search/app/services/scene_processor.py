from __future__ import annotations

from PIL import Image

from app.utils.image_utils import crop_normalized, load_image_from_bytes, resize_image, validate_image_bytes


def process_scene_crop(
    data: bytes,
    content_type: str | None,
    x: float,
    y: float,
    width: float,
    height: float,
) -> Image.Image:
    validate_image_bytes(data, content_type)
    img = load_image_from_bytes(data)
    cropped = crop_normalized(img, x, y, width, height)
    return resize_image(cropped)
