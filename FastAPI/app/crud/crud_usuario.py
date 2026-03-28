from sqlalchemy.orm import Session
from app.models.usuario import Usuario
from app.schemas.usuario import UsuarioCreate, UsuarioUpdate
from datetime import datetime, timedelta, timezone
from app.crud.crud_notificacion import crear_notificacion
from app.schemas.notificacion import NotificacionCreate

def get_usuario(db: Session, usuario_id: int):
    return db.query(Usuario).filter(Usuario.id == usuario_id).first()

def get_usuario_by_correo(db: Session, correo: str):
    return db.query(Usuario).filter(Usuario.correo == correo).first()

def autenticar_usuario(db: Session, correo: str, password: str):
    usuario = get_usuario_by_correo(db, correo=correo)
    if not usuario:
        return None
    if usuario.password_hash == password + "notreallyhashed":
        return usuario
    return None

def get_usuarios(db: Session, skip: int = 0, limit: int = 100):
    return db.query(Usuario).offset(skip).limit(limit).all()

def get_usuarios_by_xp(db: Session, limit: int = 100):
    return db.query(Usuario).filter(Usuario.rol != 'admin').order_by(Usuario.xp_total.desc()).limit(limit).all()

def crear_usuario(db: Session, usuario: UsuarioCreate):
    fake_hashed_password = usuario.password + "notreallyhashed"
    db_usuario = Usuario(
        correo=usuario.correo, 
        nombre_usuario=usuario.nombre_usuario,
        password_hash=fake_hashed_password,
        rol=usuario.rol
    )
    db.add(db_usuario)
    db.commit()
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
        diferencia_dias = (ahora.date() - ultima.date()).days
        if diferencia_dias >= 2:  # Faltó un día entero -> racha rota
            usuario.racha_actual = 1
        elif ahora.date() > ultima.date():
            # Nueva tarea en un día distinto (dentro de 24h)
            usuario.racha_actual += 1
            if usuario.racha_actual > 1 and usuario.racha_actual % 7 == 0:
                notif = NotificacionCreate(
                    usuario_id=usuario_id,
                    titulo="¡Logro de Racha!",
                    mensaje=f"Felicidades, has alcanzado una racha de {usuario.racha_actual} días seguidos."
                )
                crear_notificacion(db, notif)
        # else: mismo día, no incrementar de nuevo

    usuario.ultima_tarea_completada = ahora
    db.add(usuario)
    db.commit()

def verificar_y_resetear_racha(db: Session, usuario_id: int):
    usuario = get_usuario(db, usuario_id)
    if not usuario or usuario.ultima_tarea_completada is None:
        return
    ahora = datetime.utcnow()
    diferencia_dias = (ahora.date() - usuario.ultima_tarea_completada.date()).days
    if diferencia_dias >= 2 and usuario.racha_actual > 0:
        if usuario.racha_actual >= 3:
            notif = NotificacionCreate(
                usuario_id=usuario_id,
                titulo="¡Racha perdida!",
                mensaje=f"Oh no, has perdido tu racha de {usuario.racha_actual} días. ¡A empezar de nuevo mañana!"
            )
            crear_notificacion(db, notif)
        usuario.racha_actual = 0
        db.add(usuario)
        db.commit()

def eliminar_usuario(db: Session, usuario_id: int):
    usuario = get_usuario(db, usuario_id)
    if usuario:
        db.delete(usuario)
        db.commit()
        return True
    return False

def cambiar_password(db: Session, usuario_id: int, password_actual: str, nueva_password: str):
    usuario = get_usuario(db, usuario_id)
    if not usuario:
        return False, "Usuario no encontrado"
    if usuario.password_hash != password_actual + "notreallyhashed":
        return False, "Contraseña actual incorrecta"
    usuario.password_hash = nueva_password + "notreallyhashed"
    db.add(usuario)
    db.commit()
    return True, "Contraseña actualizada"
