# TTO AI Search Service

FastAPI microservice for semantic text search and CLIP-based image/scene search.

## Run locally

```bash
cd ai-search
python -m venv .venv
.venv\Scripts\activate
pip install -r requirements.txt
copy .env.example .env
uvicorn app.main:app --host 0.0.0.0 --port 8001 --reload
```

Set `SKIP_MODEL_LOAD=true` in `.env` for fast startup without downloading ML models (uses deterministic fallback embeddings).

## Docker

```bash
docker compose up ai-search --build
```

## Laravel integration

1. `php artisan migrate`
2. `php artisan products:import-excel`
3. Start this service on port 8001
4. `php artisan search:index-all`

Configure Laravel `.env`:

```
AI_SEARCH_BASE_URL=http://127.0.0.1:8001
AI_SEARCH_API_KEY=change-me-internal-key
MEDIA_BASE_URL=https://thetotaloffice.com
```
