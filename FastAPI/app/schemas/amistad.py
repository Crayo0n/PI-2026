from pydantic import BaseModel
from typing import Optional

class AmistadBase(BaseModel):
    estado: Optional[str] = "pendiente"

class AmistadCreate(AmistadBase):
    usuario_id_1: int
    usuario_id_2: int

class AmistadUpdate(BaseModel):
    estado: str

class AmistadResponse(AmistadBase):
    id: int
    usuario_id_1: int
    usuario_id_2: int

    class Config:
        from_attributes = True
