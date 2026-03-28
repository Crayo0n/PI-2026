from sqlalchemy import Integer, String, ForeignKey, DateTime
from sqlalchemy.orm import Mapped, mapped_column, relationship
from typing import List, Optional
from datetime import datetime
from app.models.base import Base

class Usuario(Base):
    __tablename__ = "usuarios"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    nivel_id: Mapped[Optional[int]] = mapped_column(ForeignKey("niveles.id"), nullable=True)
    nombre_usuario: Mapped[str] = mapped_column(String, index=True)
    correo: Mapped[str] = mapped_column(String, unique=True, index=True)
    password_hash: Mapped[str] = mapped_column(String)
    rol: Mapped[str] = mapped_column(String, default="user")
    xp_total: Mapped[int] = mapped_column(Integer, default=0)
    racha_actual: Mapped[int] = mapped_column(Integer, default=0)
    ultima_tarea_completada: Mapped[Optional[datetime]] = mapped_column(DateTime, nullable=True)
    zona_horaria: Mapped[str] = mapped_column(String, default="UTC")

    nivel: Mapped[Optional["Nivel"]] = relationship("Nivel", back_populates="usuarios")
    tareas: Mapped[List["Tarea"]] = relationship("Tarea", back_populates="usuario", cascade="all, delete-orphan")
    rutinas: Mapped[List["Rutina"]] = relationship("Rutina", back_populates="usuario", cascade="all, delete-orphan")
    usuario_medallas: Mapped[List["UsuarioMedalla"]] = relationship("UsuarioMedalla", back_populates="usuario", cascade="all, delete-orphan")
    notificaciones: Mapped[List["Notificacion"]] = relationship("Notificacion", back_populates="usuario", cascade="all, delete-orphan")
    historial_xp: Mapped[List["HistorialXp"]] = relationship("HistorialXp", back_populates="usuario", cascade="all, delete-orphan")
    
    # Amistades
    amistades_enviadas: Mapped[List["Amistad"]] = relationship(
        "Amistad", foreign_keys="[Amistad.usuario_id_1]", back_populates="usuario_1", cascade="all, delete-orphan"
    )
    amistades_recibidas: Mapped[List["Amistad"]] = relationship(
        "Amistad", foreign_keys="[Amistad.usuario_id_2]", back_populates="usuario_2", cascade="all, delete-orphan"
    )
