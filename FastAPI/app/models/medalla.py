from sqlalchemy import Integer, String, ForeignKey, Text, DateTime
from sqlalchemy.orm import Mapped, mapped_column, relationship
from datetime import datetime
from typing import List
from app.models.base import Base

class Medalla(Base):
    __tablename__ = "medallas"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    nombre: Mapped[str] = mapped_column(String)
    descripcion: Mapped[str] = mapped_column(Text)
    url_icono: Mapped[str] = mapped_column(String)
    tipo_trigger: Mapped[str] = mapped_column(String)
    valor_requerido: Mapped[int] = mapped_column(Integer)

    usuario_medallas: Mapped[List["UsuarioMedalla"]] = relationship("UsuarioMedalla", back_populates="medalla")

class UsuarioMedalla(Base):
    __tablename__ = "usuario_medallas"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    medalla_id: Mapped[int] = mapped_column(ForeignKey("medallas.id"))
    fecha_obtencion: Mapped[datetime] = mapped_column(DateTime, default=datetime.utcnow)

    usuario: Mapped["Usuario"] = relationship("Usuario", back_populates="usuario_medallas")
    medalla: Mapped["Medalla"] = relationship("Medalla", back_populates="usuario_medallas")
