from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.nivel import NivelCreate, NivelResponse, NivelUpdate
from app.crud import crud_nivel

router = APIRouter()

@router.post("/", response_model=NivelResponse, status_code=status.HTTP_201_CREATED)
def create_nivel(nivel: NivelCreate, db: Session = Depends(get_db)):
    return crud_nivel.crear_nivel(db=db, nivel=nivel)

@router.get("/", response_model=List[NivelResponse])
def read_niveles(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_nivel.get_niveles(db, skip=skip, limit=limit)

@router.get("/{nivel_id}", response_model=NivelResponse)
def read_nivel(nivel_id: int, db: Session = Depends(get_db)):
    db_nivel = crud_nivel.get_nivel(db, nivel_id=nivel_id)
    if db_nivel is None:
        raise HTTPException(status_code=404, detail="Nivel no encontrado")
    return db_nivel

@router.put("/{nivel_id}", response_model=NivelResponse)
def update_nivel(nivel_id: int, nivel_in: NivelUpdate, db: Session = Depends(get_db)):
    db_nivel = crud_nivel.get_nivel(db, nivel_id=nivel_id)
    if db_nivel is None:
        raise HTTPException(status_code=404, detail="Nivel no encontrado")
    return crud_nivel.actualizar_nivel(db=db, db_nivel=db_nivel, nivel_update=nivel_in)

@router.delete("/{nivel_id}", status_code=status.HTTP_204_NO_CONTENT)
def delete_nivel(nivel_id: int, db: Session = Depends(get_db)):
    db_nivel = crud_nivel.get_nivel(db, nivel_id=nivel_id)
    if db_nivel is None:
        raise HTTPException(status_code=404, detail="Nivel no encontrado")
    crud_nivel.eliminar_nivel(db=db, nivel_id=nivel_id)
    return None
