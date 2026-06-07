import logging
from contextlib import asynccontextmanager

from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import JSONResponse
from slowapi import Limiter, _rate_limit_exceeded_handler
from slowapi.errors import RateLimitExceeded
from slowapi.util import get_remote_address

from app.config import get_settings
from app.dependencies import init_services
from app.routers import health, index, search

logging.basicConfig(level=logging.INFO, format="%(asctime)s %(levelname)s %(message)s")
limiter = Limiter(key_func=get_remote_address)


@asynccontextmanager
async def lifespan(app: FastAPI):
    init_services()
    yield


def create_app() -> FastAPI:
    settings = get_settings()
    app = FastAPI(title="TTO AI Search", version="1.0.0", lifespan=lifespan)
    app.state.limiter = limiter
    app.add_exception_handler(RateLimitExceeded, _rate_limit_exceeded_handler)

    origins = [o.strip() for o in settings.allowed_origins.split(",") if o.strip()]
    app.add_middleware(
        CORSMiddleware,
        allow_origins=origins,
        allow_credentials=True,
        allow_methods=["*"],
        allow_headers=["*"],
    )

    @app.exception_handler(Exception)
    async def generic_handler(request: Request, exc: Exception):
        logging.exception("Unhandled error")
        return JSONResponse(status_code=500, content={"detail": "An error occurred processing your request."})

    app.include_router(health.router)
    app.include_router(search.router)
    app.include_router(index.router)

    return app


app = create_app()
