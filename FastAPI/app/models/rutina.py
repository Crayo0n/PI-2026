from sqlalchemy import Integer, String, ForeignKey, Boolean, Date, Text
from sqlalchemy.orm import Mapped, mapped_column, relationship
from datetime import date
from typing import List, Optional
from app.models.base import Base

class Rutina(Base):
    __tablename__ = "rutinas"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id: Mapped[Optional[int]] = mapped_column(ForeignKey("usuarios.id"), nullable=True)
    nombre: Mapped[str] = mapped_column(String)
    descripcion: Mapped[Optional[str]] = mapped_column(Text, nullable=True)
    icono: Mapped[Optional[str]] = mapped_column(String, nullable=True)
    color: Mapped[Optional[str]] = mapped_column(String, nullable=True)
    es_publica: Mapped[bool] = mapped_column(Boolean, default=False)
    esta_activa: Mapped[bool] = mapped_column(Boolean, default=True)

    usuario: Mapped["Usuario"] = relationship("Usuario", back_populates="rutinas")
    registros: Mapped[List["RegistroRutina"]] = relationship("RegistroRutina", back_populates="rutina")
    tareas: Mapped[List["Tarea"]] = relationship("Tarea", back_populates="rutina")

class RegistroRutina(Base):
    __tablename__ = "registro_rutinas"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    rutina_id: Mapped[int] = mapped_column(ForeignKey("rutinas.id"))
    fecha_completada: Mapped[date] = mapped_column(Date)

    rutina: Mapped["Rutina"] = relationship("Rutina", back_populates="registros")
