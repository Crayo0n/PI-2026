from sqlalchemy.orm import Session
from app.models.notificacion import Notificacion
from app.schemas.notificacion import NotificacionCreate, NotificacionUpdate

def get_notificacion(db: Session, notificacion_id: int):
    return db.query(Notificacion).filter(Notificacion.id == notificacion_id).first()

def get_notificaciones_usuario(db: Session, usuario_id: int, skip: int = 0, limit: int = 100):
    return db.query(Notificacion).filter(
        Notificacion.usuario_id == usuario_id
    ).order_by(Notificacion.fecha_creacion.desc()).offset(skip).limit(limit).all()

def crear_notificacion(db: Session, notificacion: NotificacionCreate):
    db_notificacion = Notificacion(**notificacion.model_dump())
    db.add(db_notificacion)
    db.commit()
    db.refresh(db_notificacion)
    return db_notificacion

def marcar_como_leida(db: Session, db_notificacion: Notificacion, notificacion_update: NotificacionUpdate):
    db_notificacion.leida = notificacion_update.leida
    db.commit()
    db.refresh(db_notificacion)
    return db_notificacion

def eliminar_notificacion(db: Session, notificacion_id: int):
    db_notificacion = get_notificacion(db, notificacion_id)
    if db_notificacion:
        db.delete(db_notificacion)
        db.commit()
    return db_notificacion
