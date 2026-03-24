from sqlalchemy import Integer, String, ForeignKey, Text, DateTime, Boolean
from sqlalchemy.orm import Mapped, mapped_column, relationship
from datetime import datetime
from typing import Optional
from app.models.base import Base

class Tarea(Base):
    __tablename__ = "tareas"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    titulo: Mapped[str] = mapped_column(String)
    descripcion: Mapped[Optional[str]] = mapped_column(Text, nullable=True)
    estado: Mapped[str] = mapped_column(String, default="pendiente")
    fecha_limite: Mapped[Optional[datetime]] = mapped_column(DateTime, nullable=True)
    es_critica: Mapped[bool] = mapped_column(Boolean, default=False)
    xp_recompensa: Mapped[int] = mapped_column(Integer, default=0)

    usuario: Mapped["Usuario"] = relationship("Usuario", back_populates="tareas")
