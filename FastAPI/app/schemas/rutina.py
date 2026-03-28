from pydantic import BaseModel
from typing import Optional, List
from datetime import date
from app.schemas.tarea import TareaResponse

# --- RegistroRutina Schemas ---
class RegistroRutinaBase(BaseModel):
    fecha_completada: date

class RegistroRutinaCreate(RegistroRutinaBase):
    pass # rutina_id se puede inferir del endpoint /rutinas/{id}/registros

class RegistroRutinaResponse(RegistroRutinaBase):
    id: int
    rutina_id: int

    class Config:
        from_attributes = True

# --- Rutina Schemas ---
class RutinaBase(BaseModel):
    nombre: str
    descripcion: Optional[str] = None
    icono: Optional[str] = None
    color: Optional[str] = None
    es_publica: Optional[bool] = False
    esta_activa: Optional[bool] = True

class RutinaCreate(RutinaBase):
    usuario_id: Optional[int] = None

class RutinaUpdate(BaseModel):
    nombre: Optional[str] = None
    descripcion: Optional[str] = None
    icono: Optional[str] = None
    color: Optional[str] = None
    es_publica: Optional[bool] = None
    esta_activa: Optional[bool] = None

class RutinaResponse(RutinaBase):
    id: int
    usuario_id: Optional[int] = None
    # Permite incluir los registros hijos al pedir la rutina
    registros: List[RegistroRutinaResponse] = []
    tareas: List[TareaResponse] = []

    class Config:
        from_attributes = True
