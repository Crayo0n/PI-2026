from app.models.base import Base
from app.models.nivel import Nivel
from app.models.usuario import Usuario
from app.models.tarea import Tarea
from app.models.rutina import Rutina, RegistroRutina
from app.models.medalla import Medalla, UsuarioMedalla
from app.models.amistad import Amistad
from app.models.notificacion import Notificacion
from app.models.historial_xp import HistorialXp

# Definimos que se debe exponer globalmente cuando importe de app.models
__all__ = [
    "Base",
    "Nivel",
    "Usuario",
    "Tarea",
    "Rutina",
    "RegistroRutina",
    "Medalla",
    "UsuarioMedalla",
    "Amistad",
    "Notificacion",
    "HistorialXp"
]
