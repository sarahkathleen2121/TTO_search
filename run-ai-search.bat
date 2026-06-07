@echo off
echo Starting TTO AI Search Service...
cd /d "%~dp0ai-search"
.venv\Scripts\uvicorn app.main:app --host 127.0.0.1 --port 8001
pause
