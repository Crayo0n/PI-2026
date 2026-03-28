from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from sqlalchemy import func, cast, Date
from datetime import date

from app.db.database import get_db
from app.models.usuario import Usuario
from app.models.tarea import Tarea
from app.models.medalla import Medalla, UsuarioMedalla
from app.schemas.analitica import DashboardStats, NivelFunnel

router = APIRouter()


@router.get("/dashboard", response_model=DashboardStats, summary="KPIs globales para el Panel Admin")
def get_dashboard_stats(db: Session = Depends(get_db)):

    # --- KPIs de Usuarios ---
    total_usuarios: int = db.query(func.count(Usuario.id)).scalar() or 0

    racha_promedio_raw = db.query(func.avg(Usuario.racha_actual)).scalar()
    racha_promedio: float = round(float(racha_promedio_raw), 1) if racha_promedio_raw else 0.0

    xp_total_generada: int = db.query(func.sum(Usuario.xp_total)).scalar() or 0

    # --- KPIs de Tareas ---
    total_tareas: int = db.query(func.count(Tarea.id)).scalar() or 0

    hoy = date.today()
    tareas_creadas_hoy: int = (
        db.query(func.count(Tarea.id))
        .filter(cast(Tarea.fecha_limite, Date) == hoy)
        .scalar()
        or 0
    )

    # --- KPIs de Medallas ---
    medallas_desbloqueadas: int = db.query(func.count(UsuarioMedalla.id)).scalar() or 0
    total_medallas_catalogo: int = db.query(func.count(Medalla.id)).scalar() or 0

    # --- Funnel de Retención por Niveles ---
    # Contamos usuarios agrupando por su nivel_id (1-10, 11-20, etc.)
    rangos = [
        ("Nivel 1-10",  1,  10),
        ("Nivel 11-20", 11, 20),
        ("Nivel 21-30", 21, 30),
        ("Nivel 31-40", 31, 40),
        ("Elite (40+)", 41, 9999),
    ]

    funnel: list[NivelFunnel] = []
    for rango, min_nivel, max_nivel in rangos:
        count = (
            db.query(func.count(Usuario.id))
            .filter(
                Usuario.nivel_id >= min_nivel,
                Usuario.nivel_id <= max_nivel,
            )
            .scalar()
            or 0
        )
        pct = round((count / total_usuarios * 100), 1) if total_usuarios > 0 else 0.0
        funnel.append(NivelFunnel(rango=rango, total_usuarios=count, porcentaje=pct))

    return DashboardStats(
        total_usuarios=total_usuarios,
        tareas_creadas_hoy=tareas_creadas_hoy,
        total_tareas=total_tareas,
        medallas_desbloqueadas=medallas_desbloqueadas,
        racha_promedio=racha_promedio,
        xp_total_generada=xp_total_generada,
        niveles_funnel=funnel,
        total_medallas_catalogo=total_medallas_catalogo,
    )
