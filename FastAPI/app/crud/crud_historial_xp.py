from sqlalchemy.orm import Session
from app.models.historial_xp import HistorialXp
from app.schemas.historial_xp import HistorialXpCreate

def get_historial_xp(db: Session, historial_id: int):
    return db.query(HistorialXp).filter(HistorialXp.id == historial_id).first()

def get_historiales_por_usuario(db: Session, usuario_id: int, skip: int = 0, limit: int = 100):
    return db.query(HistorialXp).filter(
        HistorialXp.usuario_id == usuario_id
    ).order_by(HistorialXp.fecha.desc()).offset(skip).limit(limit).all()

def crear_registro_xp(db: Session, registro_xp: HistorialXpCreate):
    db_registro = HistorialXp(**registro_xp.model_dump())
    db.add(db_registro)
    db.commit()
    db.refresh(db_registro)
    return db_registro
