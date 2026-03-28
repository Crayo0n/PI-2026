from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.medalla import MedallaCreate, MedallaResponse, MedallaUpdate, UsuarioMedallaCreate, UsuarioMedallaResponse
from app.crud import crud_medalla

router = APIRouter()

# --- Endpoints del Catálogo de Medallas ---
@router.post("/", response_model=MedallaResponse, status_code=status.HTTP_201_CREATED)
def create_medalla(medalla: MedallaCreate, db: Session = Depends(get_db)):
    return crud_medalla.crear_medalla(db=db, medalla=medalla)

@router.get("/", response_model=List[MedallaResponse])
def read_medallas(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_medalla.get_medallas(db, skip=skip, limit=limit)

@router.get("/{medalla_id}", response_model=MedallaResponse)
def read_medalla(medalla_id: int, db: Session = Depends(get_db)):
    db_medalla = crud_medalla.get_medalla(db, medalla_id=medalla_id)
    if db_medalla is None:
        raise HTTPException(status_code=404, detail="Medalla no encontrada")
    return db_medalla

@router.put("/{medalla_id}", response_model=MedallaResponse)
def update_medalla(medalla_id: int, medalla_in: MedallaUpdate, db: Session = Depends(get_db)):
    db_medalla = crud_medalla.get_medalla(db, medalla_id=medalla_id)
    if db_medalla is None:
        raise HTTPException(status_code=404, detail="Medalla no encontrada")
    return crud_medalla.actualizar_medalla(db=db, db_medalla=db_medalla, medalla_update=medalla_in)

@router.delete("/{medalla_id}", status_code=status.HTTP_204_NO_CONTENT)
def delete_medalla(medalla_id: int, db: Session = Depends(get_db)):
    db_medalla = crud_medalla.get_medalla(db, medalla_id=medalla_id)
    if db_medalla is None:
        raise HTTPException(status_code=404, detail="Medalla no encontrada")
    crud_medalla.eliminar_medalla(db=db, medalla_id=medalla_id)
    return None

# --- Endpoints de Asignación (Logros Desbloqueados) ---
@router.post("/otorgar", response_model=UsuarioMedallaResponse, status_code=status.HTTP_201_CREATED)
def otorgar_medalla_a_usuario(otorgar_data: UsuarioMedallaCreate, db: Session = Depends(get_db)):
    db_medalla = crud_medalla.get_medalla(db, medalla_id=otorgar_data.medalla_id)
    if db_medalla is None:
        raise HTTPException(status_code=404, detail="La medalla asignada no existe en el catálogo")
    return crud_medalla.otorgar_medalla(db=db, usuario_medalla=otorgar_data)

@router.get("/usuario/{usuario_id}", response_model=List[UsuarioMedallaResponse])
def read_medallas_de_usuario(usuario_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_medalla.get_medallas_by_usuario(db, usuario_id=usuario_id, skip=skip, limit=limit)
