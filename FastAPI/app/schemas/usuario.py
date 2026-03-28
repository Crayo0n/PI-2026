from pydantic import BaseModel, EmailStr
from typing import Optional

# Propiedades compartidas
class UsuarioBase(BaseModel):
    nombre_usuario: Optional[str] = None
    correo: EmailStr
    # is_active: Optional[bool] = True

# Propiedades al crear usuario (input)
class UsuarioCreate(UsuarioBase):
    password: str

class UsuarioUpdate(BaseModel):
    nombre_usuario: Optional[str] = None
    correo: Optional[EmailStr] = None

class UsuarioLogin(BaseModel):
    correo: EmailStr
    password: str

# Propiedades al devolver usuario (output)
class UsuarioResponse(UsuarioBase):
    id: int
    xp_total: int = 0
    racha_actual: int = 0
    rol: str = "user"

    class Config:
        from_attributes = True
