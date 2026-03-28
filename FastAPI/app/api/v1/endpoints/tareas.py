from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.tarea import TareaCreate, TareaResponse, TareaUpdate
from app.crud import crud_tarea, crud_usuario

router = APIRouter()

@router.post("/", response_model=TareaResponse, status_code=status.HTTP_201_CREATED)
def create_tarea(tarea: TareaCreate, db: Session = Depends(get_db)):
    # NOTA: En producción puedes validar aquí si el usuario_id existe en bd primero.
    return crud_tarea.crear_tarea(db=db, tarea=tarea)

@router.get("/", response_model=List[TareaResponse])
def read_tareas(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_tarea.get_todas_las_tareas(db, skip=skip, limit=limit)

@router.get("/usuario/{usuario_id}", response_model=List[TareaResponse])
def read_tareas_by_usuario(usuario_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_tarea.get_tareas_by_usuario(db, usuario_id=usuario_id, skip=skip, limit=limit)

@router.get("/{tarea_id}", response_model=TareaResponse)
def read_tarea(tarea_id: int, db: Session = Depends(get_db)):
    db_tarea = crud_tarea.get_tarea(db, tarea_id=tarea_id)
    if db_tarea is None:
        raise HTTPException(status_code=404, detail="Tarea no encontrada")
    return db_tarea

@router.put("/{tarea_id}", response_model=TareaResponse)
def update_tarea(tarea_id: int, tarea_in: TareaUpdate, db: Session = Depends(get_db)):
    db_tarea = crud_tarea.get_tarea(db, tarea_id=tarea_id)
    if db_tarea is None:
        raise HTTPException(status_code=404, detail="Tarea no encontrada")
    updated = crud_tarea.actualizar_tarea(db=db, db_tarea=db_tarea, tarea_update=tarea_in)
    # Actualizar racha si la tarea fue marcada como completada
    if tarea_in.estado == "completada" and db_tarea.usuario_id:
        crud_usuario.actualizar_racha_tras_tarea(db, usuario_id=db_tarea.usuario_id)
    return updated

@router.delete("/{tarea_id}", status_code=status.HTTP_204_NO_CONTENT)
def delete_tarea(tarea_id: int, db: Session = Depends(get_db)):
    db_tarea = crud_tarea.get_tarea(db, tarea_id=tarea_id)
    if db_tarea is None:
        raise HTTPException(status_code=404, detail="Tarea no encontrada")
    crud_tarea.eliminar_tarea(db=db, tarea_id=tarea_id)
    return None
