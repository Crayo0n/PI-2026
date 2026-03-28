from sqlalchemy.orm import Session
from sqlalchemy import or_, and_
from app.models.amistad import Amistad
from app.schemas.amistad import AmistadCreate, AmistadUpdate

def get_amistad(db: Session, amistad_id: int):
    return db.query(Amistad).filter(Amistad.id == amistad_id).first()

def get_amistad_entre_usuarios(db: Session, user1_id: int, user2_id: int):
    return db.query(Amistad).filter(
        or_(
            and_(Amistad.usuario_id_1 == user1_id, Amistad.usuario_id_2 == user2_id),
            and_(Amistad.usuario_id_1 == user2_id, Amistad.usuario_id_2 == user1_id)
        )
    ).first()

def get_amistades_por_usuario(db: Session, usuario_id: int, skip: int = 0, limit: int = 100):
    return db.query(Amistad).filter(
        or_(Amistad.usuario_id_1 == usuario_id, Amistad.usuario_id_2 == usuario_id)
    ).offset(skip).limit(limit).all()

def enviar_solicitud_amistad(db: Session, solicitud: AmistadCreate):
    db_amistad = Amistad(**solicitud.model_dump())
    db.add(db_amistad)
    db.commit()
    db.refresh(db_amistad)
    return db_amistad

def actualizar_estado_amistad(db: Session, db_amistad: Amistad, estado: str):
    db_amistad.estado = estado
    db.commit()
    db.refresh(db_amistad)
    return db_amistad

def eliminar_amistad(db: Session, amistad_id: int):
    db_amistad = get_amistad(db, amistad_id)
    if db_amistad:
        db.delete(db_amistad)
        db.commit()
    return db_amistad
