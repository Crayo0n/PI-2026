from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.rutina import RutinaCreate, RutinaResponse, RutinaUpdate, RegistroRutinaCreate, RegistroRutinaResponse
from app.crud import crud_rutina

router = APIRouter()

# --- Endpoint Rutinas Principales ---

@router.post("/", response_model=RutinaResponse, status_code=status.HTTP_201_CREATED)
def create_rutina(rutina: RutinaCreate, db: Session = Depends(get_db)):
    return crud_rutina.crear_rutina(db=db, rutina=rutina)

@router.get("/usuario/{usuario_id}", response_model=List[RutinaResponse])
def read_rutinas_by_usuario(usuario_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_rutina.get_rutinas_by_usuario(db, usuario_id=usuario_id, skip=skip, limit=limit)

@router.get("/{rutina_id}", response_model=RutinaResponse)
def read_rutina(rutina_id: int, db: Session = Depends(get_db)):
    db_rutina = crud_rutina.get_rutina(db, rutina_id=rutina_id)
    if db_rutina is None:
        raise HTTPException(status_code=404, detail="Rutina no encontrada")
    return db_rutina

@router.put("/{rutina_id}", response_model=RutinaResponse)
def update_rutina(rutina_id: int, rutina_in: RutinaUpdate, db: Session = Depends(get_db)):
    db_rutina = crud_rutina.get_rutina(db, rutina_id=rutina_id)
    if db_rutina is None:
        raise HTTPException(status_code=404, detail="Rutina no encontrada")
    return crud_rutina.actualizar_rutina(db=db, db_rutina=db_rutina, rutina_update=rutina_in)

@router.delete("/{rutina_id}", status_code=status.HTTP_204_NO_CONTENT)
def delete_rutina(rutina_id: int, db: Session = Depends(get_db)):
    db_rutina = crud_rutina.get_rutina(db, rutina_id=rutina_id)
    if db_rutina is None:
        raise HTTPException(status_code=404, detail="Rutina no encontrada")
    crud_rutina.eliminar_rutina(db=db, rutina_id=rutina_id)
    return None

# --- Endpoints Rutinas Registros (completadas) ---

@router.post("/{rutina_id}/registros", response_model=RegistroRutinaResponse, status_code=status.HTTP_201_CREATED)
def create_registro_rutina(rutina_id: int, registro: RegistroRutinaCreate, db: Session = Depends(get_db)):
    db_rutina = crud_rutina.get_rutina(db, rutina_id=rutina_id)
    if db_rutina is None:
        raise HTTPException(status_code=404, detail="Rutina no encontrada")
    
    return crud_rutina.registrar_rutina_completada(db=db, rutina_id=rutina_id, registro=registro)

@router.get("/{rutina_id}/registros", response_model=List[RegistroRutinaResponse])
def read_registros_rutina(rutina_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_rutina.get_registros_by_rutina(db, rutina_id=rutina_id, skip=skip, limit=limit)
