from sqlalchemy.orm import Session
from app.models.tarea import Tarea
from app.schemas.tarea import TareaCreate, TareaUpdate
from app.models.nivel import Nivel 

def get_tarea(db: Session, tarea_id: int):
    return db.query(Tarea).filter(Tarea.id == tarea_id).first()

def get_tareas_by_usuario(db: Session, usuario_id: int, skip: int = 0, limit: int = 100):
    return db.query(Tarea).filter(Tarea.usuario_id == usuario_id).offset(skip).limit(limit).all()

def get_todas_las_tareas(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Tarea).offset(skip).limit(limit).all()

def crear_tarea(db: Session, tarea: TareaCreate):
    db_tarea = Tarea(**tarea.model_dump())
    db.add(db_tarea)
    db.commit()
    db.refresh(db_tarea)
    return db_tarea

def actualizar_tarea(db: Session, db_tarea: Tarea, tarea_update: TareaUpdate):
    update_data = tarea_update.model_dump(exclude_unset=True)
    
    if "estado" in update_data:
        nuevo_estado = update_data["estado"]
        estado_anterior = db_tarea.estado
        
        if nuevo_estado == "completada" and estado_anterior != "completada":
            if db_tarea.usuario:
                db_tarea.usuario.xp_total += db_tarea.xp_recompensa
                
                nivel_alcanzado = db.query(Nivel).filter(
                    Nivel.xp_requerida <= db_tarea.usuario.xp_total
                ).order_by(Nivel.xp_requerida.desc()).first()
                
                if nivel_alcanzado:
                    db_tarea.usuario.nivel_id = nivel_alcanzado.id
        
        elif nuevo_estado == "pendiente" and estado_anterior == "completada":
            if db_tarea.usuario:
                db_tarea.usuario.xp_total -= db_tarea.xp_recompensa
                if db_tarea.usuario.xp_total < 0:
                    db_tarea.usuario.xp_total = 0
                
                nivel_alcanzado = db.query(Nivel).filter(
                    Nivel.xp_requerida <= db_tarea.usuario.xp_total
                ).order_by(Nivel.xp_requerida.desc()).first()
                
                if nivel_alcanzado:
                    db_tarea.usuario.nivel_id = nivel_alcanzado.id
                else:
                    db_tarea.usuario.nivel_id = None

    for key, value in update_data.items():
        setattr(db_tarea, key, value)
        
    db.commit()
    db.refresh(db_tarea)
    
    return db_tarea

def eliminar_tarea(db: Session, tarea_id: int):
    db_tarea = get_tarea(db, tarea_id)
    if db_tarea:
        db.delete(db_tarea)
        db.commit()
    return db_tarea
