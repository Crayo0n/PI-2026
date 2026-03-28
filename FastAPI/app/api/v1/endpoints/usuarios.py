from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.usuario import UsuarioCreate, UsuarioResponse, UsuarioUpdate, UsuarioLogin
from app.crud import crud_usuario

router = APIRouter()

@router.post("/", response_model=UsuarioResponse)
def create_usuario(usuario: UsuarioCreate, db: Session = Depends(get_db)):
    db_usuario = crud_usuario.get_usuario_by_email(db, correo=usuario.correo)
    if db_usuario:
        raise HTTPException(status_code=400, detail="El email ya está registrado")
    return crud_usuario.crear_usuario(db=db, usuario=usuario)

@router.post("/login", response_model=UsuarioResponse)
def login_usuario(usuario_in: UsuarioLogin, db: Session = Depends(get_db)):
    user = crud_usuario.autenticar_usuario(db, correo=usuario_in.correo, password=usuario_in.password)
    if not user:
        raise HTTPException(status_code=401, detail="Credenciales incorrectas")
    return user

@router.get("/", response_model=List[UsuarioResponse])
def read_usuarios(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    usuarios = crud_usuario.get_usuarios(db, skip=skip, limit=limit)
    return usuarios

@router.get("/leaderboard", response_model=List[UsuarioResponse])
def get_leaderboard(limit: int = 10, db: Session = Depends(get_db)):
    return crud_usuario.get_usuarios_by_xp(db, limit=limit)

@router.get("/{usuario_id}", response_model=UsuarioResponse)
def read_usuario(usuario_id: int, db: Session = Depends(get_db)):
    db_usuario = crud_usuario.get_usuario(db, usuario_id=usuario_id)
    if db_usuario is None:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    return db_usuario

@router.put("/{usuario_id}", response_model=UsuarioResponse)
def update_usuario(usuario_id: int, usuario_in: UsuarioUpdate, db: Session = Depends(get_db)):
    db_usuario = crud_usuario.get_usuario(db, usuario_id=usuario_id)
    if db_usuario is None:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    return crud_usuario.update_usuario(db=db, db_usuario=db_usuario, usuario_in=usuario_in)

@router.post("/{usuario_id}/check-streak", response_model=UsuarioResponse)
def check_streak(usuario_id: int, db: Session = Depends(get_db)):
    """Verifies and resets streak to 0 if more than 24h have passed. Call on page load."""
    db_usuario = crud_usuario.get_usuario(db, usuario_id=usuario_id)
    if db_usuario is None:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    crud_usuario.verificar_y_resetear_racha(db, usuario_id=usuario_id)
    return crud_usuario.get_usuario(db, usuario_id=usuario_id)
