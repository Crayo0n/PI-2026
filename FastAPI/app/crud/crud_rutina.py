from sqlalchemy.orm import Session
from app.models.rutina import Rutina, RegistroRutina
from app.schemas.rutina import RutinaCreate, RutinaUpdate, RegistroRutinaCreate

# ---- RUTINA CRUD ----
def get_rutina(db: Session, rutina_id: int):
    return db.query(Rutina).filter(Rutina.id == rutina_id).first()

def get_rutinas_by_usuario(db: Session, usuario_id: int, skip: int = 0, limit: int = 100):
    return db.query(Rutina).filter(Rutina.usuario_id == usuario_id).offset(skip).limit(limit).all()

def get_rutinas_publicas(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Rutina).filter(Rutina.es_publica == True).offset(skip).limit(limit).all()

def crear_rutina(db: Session, rutina: RutinaCreate):
    db_rutina = Rutina(**rutina.model_dump())
    db.add(db_rutina)
    db.commit()
    db.refresh(db_rutina)
    return db_rutina

def actualizar_rutina(db: Session, db_rutina: Rutina, rutina_update: RutinaUpdate):
    update_data = rutina_update.model_dump(exclude_unset=True)
    for key, value in update_data.items():
        setattr(db_rutina, key, value)
    db.commit()
    db.refresh(db_rutina)
    return db_rutina

def eliminar_rutina(db: Session, rutina_id: int):
    db_rutina = get_rutina(db, rutina_id)
    if db_rutina:
        db.delete(db_rutina)
        db.commit()
    return db_rutina

# ---- REGISTRO RUTINA CRUD ----
def registrar_rutina_completada(db: Session, rutina_id: int, registro: RegistroRutinaCreate):
    db_registro = RegistroRutina(**registro.model_dump(), rutina_id=rutina_id)
    db.add(db_registro)
    db.commit()
    db.refresh(db_registro)
    return db_registro

def get_registros_by_rutina(db: Session, rutina_id: int, skip: int = 0, limit: int = 100):
    return db.query(RegistroRutina).filter(RegistroRutina.rutina_id == rutina_id).offset(skip).limit(limit).all()
