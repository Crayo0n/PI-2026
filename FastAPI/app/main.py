from fastapi import FastAPI
from app.api.v1.api import api_router
from app.core.config import settings
from app.db.database import engine, Base, sesionLocal
from app.models.usuario import Usuario
import app.models

Base.metadata.create_all(bind=engine)

app = FastAPI(
    title=settings.PROJECT_NAME,
    openapi_url="/api/v1/openapi.json"
)

# Incluyendo los routers
app.include_router(api_router, prefix="/api/v1")

@app.get("/")
def root():
    return {"message": "Bienvenido a la API de PI-2026"}