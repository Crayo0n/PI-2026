from pydantic import BaseModel
from datetime import datetime

class HistorialXpBase(BaseModel):
    cantidad_xp: int
    motivo: str

class HistorialXpCreate(HistorialXpBase):
    usuario_id: int

class HistorialXpResponse(HistorialXpBase):
    id: int
    usuario_id: int
    fecha: datetime

    class Config:
        from_attributes = True

class HeatmapItem(BaseModel):
    fecha: str
    xp: int
