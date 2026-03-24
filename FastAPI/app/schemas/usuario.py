from pydantic import BaseModel, EmailStr
from typing import Optional

# Propiedades compartidas
class UsuarioBase(BaseModel):
    nombre: Optional[str] = None
    email: EmailStr
    is_active: Optional[bool] = True

# Propiedades al crear usuario (input)
class UsuarioCreate(UsuarioBase):
    password: str

# Propiedades al devolver usuario (output)
class UsuarioResponse(UsuarioBase):
    id: int

    class Config:
        from_attributes = True
