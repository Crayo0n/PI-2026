from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.notificacion import NotificacionCreate, NotificacionResponse, NotificacionUpdate
from app.crud import crud_notificacion

router = APIRouter()

@router.post("/", response_model=NotificacionResponse, status_code=status.HTTP_201_CREATED)
def create_notificacion(notificacion: NotificacionCreate, db: Session = Depends(get_db)):
    return crud_notificacion.crear_notificacion(db=db, notificacion=notificacion)

@router.get("/usuario/{usuario_id}", response_model=List[NotificacionResponse])
def read_notificaciones_usuario(usuario_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_notificacion.get_notificaciones_usuario(db, usuario_id=usuario_id, skip=skip, limit=limit)

@router.put("/{notificacion_id}/leida", response_model=NotificacionResponse)
def mark_notificacion_leida(notificacion_id: int, actualizacion: NotificacionUpdate, db: Session = Depends(get_db)):
    db_notif = crud_notificacion.get_notificacion(db, notificacion_id=notificacion_id)
    if db_notif is None:
        raise HTTPException(status_code=404, detail="Notificación no encontrada")
    
    return crud_notificacion.marcar_como_leida(db=db, db_notificacion=db_notif, notificacion_update=actualizacion)

@router.delete("/{notificacion_id}", status_code=status.HTTP_204_NO_CONTENT)
def delete_notificacion(notificacion_id: int, db: Session = Depends(get_db)):
    db_notif = crud_notificacion.get_notificacion(db, notificacion_id=notificacion_id)
    if db_notif is None:
        raise HTTPException(status_code=404, detail="Notificación no encontrada")
    
    crud_notificacion.eliminar_notificacion(db=db, notificacion_id=notificacion_id)
    return None
