from sqlalchemy.orm import Session
from app.models.nivel import Nivel
from app.schemas.nivel import NivelCreate, NivelUpdate

def get_nivel(db: Session, nivel_id: int):
    return db.query(Nivel).filter(Nivel.id == nivel_id).first()

def get_niveles(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Nivel).offset(skip).limit(limit).all()

def crear_nivel(db: Session, nivel: NivelCreate):
    db_nivel = Nivel(**nivel.model_dump())
    db.add(db_nivel)
    db.commit()
    db.refresh(db_nivel)
    return db_nivel

def actualizar_nivel(db: Session, db_nivel: Nivel, nivel_update: NivelUpdate):
    update_data = nivel_update.model_dump(exclude_unset=True)
    for key, value in update_data.items():
        setattr(db_nivel, key, value)
    db.commit()
    db.refresh(db_nivel)
    return db_nivel

def eliminar_nivel(db: Session, nivel_id: int):
    db_nivel = get_nivel(db, nivel_id)
    if db_nivel:
        db.delete(db_nivel)
        db.commit()
    return db_nivel
