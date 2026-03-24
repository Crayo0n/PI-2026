from sqlalchemy import Integer, String, ForeignKey, DateTime
from sqlalchemy.orm import Mapped, mapped_column, relationship
from datetime import datetime
from app.models.base import Base

class HistorialXp(Base):
    __tablename__ = "historial_xp"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    cantidad_xp: Mapped[int] = mapped_column(Integer)
    motivo: Mapped[str] = mapped_column(String)
    fecha: Mapped[datetime] = mapped_column(DateTime, default=datetime.utcnow)

    usuario: Mapped["Usuario"] = relationship("Usuario", back_populates="historial_xp")
