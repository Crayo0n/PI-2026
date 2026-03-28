from sqlalchemy import Integer, String, ForeignKey
from sqlalchemy.orm import Mapped, mapped_column, relationship
from app.models.base import Base

class Amistad(Base):
    __tablename__ = "amistades"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    usuario_id_1: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    usuario_id_2: Mapped[int] = mapped_column(ForeignKey("usuarios.id"))
    estado: Mapped[str] = mapped_column(String, default="pendiente")
