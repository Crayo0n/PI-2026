from fastapi import APIRouter

router = APIRouter()

@router.get("/")
def get_status():
    """
    Endpoint de prueba para verificar que el API está activa.
    """
    return {"status": "ok", "service": "FastAPI is running"}
