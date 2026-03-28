from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.historial_xp import HistorialXpCreate, HistorialXpResponse, HeatmapItem
from app.crud import crud_historial_xp

router = APIRouter()

@router.post("/", response_model=HistorialXpResponse, status_code=status.HTTP_201_CREATED)
def create_historial_xp(registro: HistorialXpCreate, db: Session = Depends(get_db)):
    # Nota: Aquí se debería sumar también la XP al campo xp_total del Usuario en una sola transacción.
    return crud_historial_xp.crear_registro_xp(db=db, registro_xp=registro)

@router.get("/usuario/{usuario_id}", response_model=List[HistorialXpResponse])
def read_historial_usuario(usuario_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_historial_xp.get_historiales_por_usuario(db, usuario_id=usuario_id, skip=skip, limit=limit)

@router.get("/{historial_id}", response_model=HistorialXpResponse)
def read_historial(historial_id: int, db: Session = Depends(get_db)):
    db_historial = crud_historial_xp.get_historial_xp(db, historial_id=historial_id)
    if db_historial is None:
        raise HTTPException(status_code=404, detail="Registro de XP no encontrado")
    return db_historial

@router.get("/usuario/{usuario_id}/heatmap", response_model=List[HeatmapItem])
def get_user_heatmap(usuario_id: int, dias: int = 210, db: Session = Depends(get_db)):
    return crud_historial_xp.get_heatmap_actividad(db, usuario_id=usuario_id, dias=dias)
