from sqlalchemy import Integer, String, ForeignKey, Text, DateTime, Boolean
from sqlalchemy.orm import Mapped, mapped_column, relationship
from datetime import datetime
from app.models.base import Base

class Notificacion(Base):
    __tablename__ = "notificaciones"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    titulo: Mapped[str] = mapped_column(String)
    mensaje: Mapped[str] = mapped_column(Text)
    leida: Mapped[bool] = mapped_column(Boolean, default=False)
    fecha_creacion: Mapped[datetime] = mapped_column(DateTime, default=datetime.utcnow)

    usuario: Mapped["Usuario"] = relationship("Usuario", back_populates="notificaciones")
