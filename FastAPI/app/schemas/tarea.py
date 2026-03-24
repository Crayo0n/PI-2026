from pydantic import BaseModel
from typing import Optional
from datetime import datetime

class TareaBase(BaseModel):
    titulo: str
    descripcion: Optional[str] = None
    estado: Optional[str] = "pendiente"
    fecha_limite: Optional[datetime] = None
    es_critica: Optional[bool] = False
    xp_recompensa: Optional[int] = 0

class TareaCreate(TareaBase):
    usuario_id: int

class TareaUpdate(BaseModel):
    titulo: Optional[str] = None
    descripcion: Optional[str] = None
    estado: Optional[str] = None
    fecha_limite: Optional[datetime] = None
    es_critica: Optional[bool] = None
    xp_recompensa: Optional[int] = None

class TareaResponse(TareaBase):
    id: int
    usuario_id: int

    class Config:
        from_attributes = True
