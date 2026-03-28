from sqlalchemy.orm import Session
from app.models.usuario import Usuario
from app.schemas.usuario import UsuarioCreate, UsuarioUpdate
from datetime import datetime, timedelta, timezone

def get_usuario(db: Session, usuario_id: int):
    return db.query(Usuario).filter(Usuario.id == usuario_id).first()

def get_usuario_by_email(db: Session, correo: str):
    return db.query(Usuario).filter(Usuario.correo == correo).first()

def autenticar_usuario(db: Session, correo: str, password: str):
    usuario = get_usuario_by_email(db, correo=correo)
    if not usuario:
        return None
    if usuario.password_hash == password + "notreallyhashed":
        return usuario
    return None

def get_usuarios(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Usuario).offset(skip).limit(limit).all()

def get_usuarios_by_xp(db: Session, limit: int = 100):
    return db.query(Usuario).order_by(Usuario.xp_total.desc()).limit(limit).all()

def crear_usuario(db: Session, usuario: UsuarioCreate):
    # Nota de seguridad: aquí debes usar una librería como passlib para hacer hash real
    fake_hashed_password = usuario.password + "notreallyhashed"
    
    db_usuario = Usuario(
        correo=usuario.correo, 
        nombre_usuario=usuario.nombre_usuario,
        password_hash=fake_hashed_password,
        # is_active=usuario.is_active # No existe en el modelo, lo omitimos o agregamos
    )
    db.add(db_usuario)
    db.commit()
    db.refresh(db_usuario)
    db.refresh(db_usuario)
    return db_usuario

def update_usuario(db: Session, db_usuario: Usuario, usuario_in: UsuarioUpdate):
    update_data = usuario_in.model_dump(exclude_unset=True)
    for field, value in update_data.items():
        setattr(db_usuario, field, value)
    db.add(db_usuario)
    db.commit()
    db.refresh(db_usuario)
    return db_usuario

def actualizar_racha_tras_tarea(db: Session, usuario_id: int):
    """Call this when a task is marked complete. Updates streak based on last completion time."""
    usuario = get_usuario(db, usuario_id)
    if not usuario:
        return
    ahora = datetime.utcnow()
    ultima = usuario.ultima_tarea_completada

    if ultima is None:
        # Primera tarea completada
        usuario.racha_actual = 1
    else:
        diff = ahora - ultima
        if diff.total_seconds() > 86400:  # Mas de 24h -> racha rota
            usuario.racha_actual = 1
        elif ahora.date() > ultima.date():
            # Nueva tarea en un día distinto (dentro de 24h)
            usuario.racha_actual += 1
        # else: mismo día, no incrementar de nuevo

    usuario.ultima_tarea_completada = ahora
    db.add(usuario)
    db.commit()

def verificar_y_resetear_racha(db: Session, usuario_id: int):
    """Call this on page load to reset streak to 0 if >24h passed without completing a task."""
    usuario = get_usuario(db, usuario_id)
    if not usuario or usuario.ultima_tarea_completada is None:
        return
    ahora = datetime.utcnow()
    diff = ahora - usuario.ultima_tarea_completada
    if diff.total_seconds() > 86400 and usuario.racha_actual > 0:
        usuario.racha_actual = 0
        db.add(usuario)
        db.commit()
