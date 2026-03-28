from pydantic import BaseModel, EmailStr
from typing import Optional
from app.schemas.nivel import NivelResponse


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

class PasswordUpdate(BaseModel):
    password_actual: str
    nueva_password: str

class UsuarioLogin(BaseModel):
    correo: EmailStr
    password: str

# Propiedades al devolver usuario (output)
class UsuarioResponse(UsuarioBase):
    id: int
    xp_total: int = 0
    racha_actual: int = 0
    rol: str = "user"
    nivel_id: Optional[int] = None
    nivel: Optional[NivelResponse] = None

    class Config:
        from_attributes = True

class NivelResponse(BaseModel):
    id: int
    numero: int
    xp_requerida: int

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
