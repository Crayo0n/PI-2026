from fastapi import FastAPI
from app.api.v1.api import api_router
from app.core.config import settings
from app.db.database import engine, Base, sesionLocal
from app.models.usuario import Usuario
import app.models

Base.metadata.create_all(bind=engine)

def seed_default_user():
    db = sesionLocal()
    try:
        # Check if user with ID 1 exists
        user = db.query(Usuario).filter(Usuario.id == 1).first()
        if not user:
            new_user = Usuario(
                id=1,
                nombre_usuario="MVP Demo User",
                correo="demo@prioritypulse.com",
                password_hash="fakehash_mvp_only"
            )
            db.add(new_user)
            db.commit()
    except Exception as e:
        print(f"Error seeding default user: {e}")
    finally:
        db.close()

seed_default_user()


app = FastAPI(
    title=settings.PROJECT_NAME,
    openapi_url="/api/v1/openapi.json"
)

# Incluyendo los routers
app.include_router(api_router, prefix="/api/v1")

@app.get("/")
def root():
    return {"message": "Bienvenido a la API de PI-2026"}
