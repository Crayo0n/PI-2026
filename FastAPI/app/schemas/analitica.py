from pydantic import BaseModel
from typing import List


class NivelFunnel(BaseModel):
    rango: str
    total_usuarios: int
    porcentaje: float


class DashboardStats(BaseModel):
    total_usuarios: int
    tareas_creadas_hoy: int
    total_tareas: int
    medallas_desbloqueadas: int
    racha_promedio: float
    xp_total_generada: int
    niveles_funnel: List[NivelFunnel]
    total_medallas_catalogo: int
