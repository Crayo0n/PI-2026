from sqlalchemy import Integer, String, ForeignKey, Boolean, Date
from sqlalchemy.orm import Mapped, mapped_column, relationship
from datetime import date
from typing import List
from app.models.base import Base

class Rutina(Base):
    __tablename__ = "rutinas"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    nombre: Mapped[str] = mapped_column(String)
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
