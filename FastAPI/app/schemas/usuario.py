from pydantic import BaseModel, EmailStr
from typing import Optional


class UsuarioBase(BaseModel):
    nombre_usuario: str
    correo: EmailStr
    rol: Optional[str] = "user"
    zona_horaria: Optional[str] = "UTC"


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


# Schema de entrada para el login
class LoginRequest(BaseModel):
    correo: EmailStr
    password: str


# Schema de respuesta del login (solo lo que Laravel necesita en sesión)
class LoginResponse(BaseModel):
    id: int
    nombre_usuario: str
    correo: str
    rol: str
    xp_total: int
