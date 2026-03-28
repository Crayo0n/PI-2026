from pydantic import BaseModel
from typing import Optional
from datetime import datetime

class NotificacionBase(BaseModel):
    titulo: str
    mensaje: str
    leida: Optional[bool] = False

class NotificacionCreate(NotificacionBase):
    usuario_id: int

class NotificacionUpdate(BaseModel):
    leida: bool

class NotificacionResponse(NotificacionBase):
    id: int
    usuario_id: int
    fecha_creacion: datetime

    class Config:
        from_attributes = True
