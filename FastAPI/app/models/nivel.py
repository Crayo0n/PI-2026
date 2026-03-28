from sqlalchemy import Integer, String
from sqlalchemy.orm import Mapped, mapped_column, relationship
from typing import List
from app.models.base import Base

class Nivel(Base):
    __tablename__ = "niveles"

    id: Mapped[int] = mapped_column(Integer, primary_key=True, index=True)
    numero_nivel: Mapped[int] = mapped_column(Integer)
    nombre: Mapped[str] = mapped_column(String)
    xp_requerida: Mapped[int] = mapped_column(Integer)
    color_hex: Mapped[str] = mapped_column(String)

    usuarios: Mapped[List["Usuario"]] = relationship("Usuario", back_populates="nivel")
