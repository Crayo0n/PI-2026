from pydantic import BaseModel
from typing import Optional

class NivelBase(BaseModel):
    numero_nivel: int
    nombre: str
    xp_requerida: int
    color_hex: Optional[str] = "#FFFFFF"

class NivelCreate(NivelBase):
    pass

class NivelUpdate(BaseModel):
    numero_nivel: Optional[int] = None
    nombre: Optional[str] = None
    xp_requerida: Optional[int] = None
    color_hex: Optional[str] = None

class NivelResponse(NivelBase):
    id: int

    class Config:
        from_attributes = True
