import asyncio
from concurrent.futures import ThreadPoolExecutor

from fastapi import APIRouter, Header, HTTPException

from app.config import get_settings
from app.dependencies import get_indexing_service
from app.schemas.request import BulkIndexRequest, IndexProductPayload

router = APIRouter(tags=["index"])
_executor = ThreadPoolExecutor(max_workers=1)


def verify_api_key(x_api_key: str = Header(..., alias="X-API-Key")):
    if x_api_key != get_settings().api_key:
        raise HTTPException(status_code=401, detail="Unauthorized")


@router.post("/api/index/bulk")
async def bulk_index(body: BulkIndexRequest, x_api_key: str = Header(..., alias="X-API-Key")):
    verify_api_key(x_api_key)
    service = get_indexing_service()
    loop = asyncio.get_event_loop()
    return await loop.run_in_executor(
        _executor,
        lambda: service.bulk_index(body.products, replace=body.replace),
    )


@router.post("/api/index/product")
async def index_product(body: IndexProductPayload, x_api_key: str = Header(..., alias="X-API-Key")):
    verify_api_key(x_api_key)
    service = get_indexing_service()
    loop = asyncio.get_event_loop()
    return await loop.run_in_executor(_executor, lambda: service.index_product(body))


@router.delete("/api/index/product/{product_id}")
def delete_product(product_id: str, x_api_key: str = Header(..., alias="X-API-Key")):
    verify_api_key(x_api_key)
    get_indexing_service().delete_product(product_id)
    return {"deleted": product_id}
