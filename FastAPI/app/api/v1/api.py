from fastapi import APIRouter
from app.api.v1.endpoints import status, usuarios, niveles, tareas, rutinas, medallas, amistades, notificaciones, historiales_xp, analitica

api_router = APIRouter()
api_router.include_router(status.router, prefix="/status", tags=["Status"])
api_router.include_router(usuarios.router, prefix="/usuarios", tags=["Usuarios"])
api_router.include_router(niveles.router, prefix="/niveles", tags=["Niveles"])
api_router.include_router(tareas.router, prefix="/tareas", tags=["Tareas"])
api_router.include_router(rutinas.router, prefix="/rutinas", tags=["Rutinas"])
api_router.include_router(medallas.router, prefix="/medallas", tags=["Medallas"])
api_router.include_router(amistades.router, prefix="/amistades", tags=["Amistades"])
api_router.include_router(notificaciones.router, prefix="/notificaciones", tags=["Notificaciones"])
api_router.include_router(historiales_xp.router, prefix="/historial-xp", tags=["Historial XP"])
api_router.include_router(analitica.router, prefix="/analitica", tags=["Analítica Admin"])

