from sqlalchemy.orm import Session
from app.models.medalla import Medalla, UsuarioMedalla
from app.schemas.medalla import MedallaCreate, MedallaUpdate, UsuarioMedallaCreate

# ---- MEDALLA CRUD ----
def get_medalla(db: Session, medalla_id: int):
    return db.query(Medalla).filter(Medalla.id == medalla_id).first()

def get_medallas(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Medalla).offset(skip).limit(limit).all()

def crear_medalla(db: Session, medalla: MedallaCreate):
    db_medalla = Medalla(**medalla.model_dump())
    db.add(db_medalla)
    db.commit()
    db.refresh(db_medalla)
    return db_medalla

def actualizar_medalla(db: Session, db_medalla: Medalla, medalla_update: MedallaUpdate):
    update_data = medalla_update.model_dump(exclude_unset=True)
    for key, value in update_data.items():
        setattr(db_medalla, key, value)
    db.commit()
    db.refresh(db_medalla)
    return db_medalla

def eliminar_medalla(db: Session, medalla_id: int):
    db_medalla = get_medalla(db, medalla_id)
    if db_medalla:
        db.delete(db_medalla)
        db.commit()
    return db_medalla

# ---- USUARIO_MEDALLA CRUD (Otorgar) ----
def otorgar_medalla(db: Session, usuario_medalla: UsuarioMedallaCreate):
    db_usuario_medalla = UsuarioMedalla(**usuario_medalla.model_dump())
    db.add(db_usuario_medalla)
    db.commit()
    db.refresh(db_usuario_medalla)
    return db_usuario_medalla

def get_medallas_by_usuario(db: Session, usuario_id: int, skip: int = 0, limit: int = 100):
    return db.query(UsuarioMedalla).filter(UsuarioMedalla.usuario_id == usuario_id).offset(skip).limit(limit).all()
