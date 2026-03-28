from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from typing import List

from app.db.database import get_db
from app.schemas.amistad import AmistadCreate, AmistadResponse, AmistadUpdate
from app.crud import crud_amistad

router = APIRouter()

@router.post("/solicitudes", response_model=AmistadResponse, status_code=status.HTTP_201_CREATED)
def enviar_solicitud(solicitud: AmistadCreate, db: Session = Depends(get_db)):
    if solicitud.usuario_id_1 == solicitud.usuario_id_2:
        raise HTTPException(status_code=400, detail="No puedes enviarte solicitud a ti mismo")
        
    amistad_existente = crud_amistad.get_amistad_entre_usuarios(db, solicitud.usuario_id_1, solicitud.usuario_id_2)
    if amistad_existente:
        raise HTTPException(status_code=400, detail="Ya existe una amistad o solicitud entre estos usuarios")
        
    return crud_amistad.enviar_solicitud_amistad(db=db, solicitud=solicitud)

@router.get("/usuario/{usuario_id}", response_model=List[AmistadResponse])
def listar_amistades(usuario_id: int, skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    return crud_amistad.get_amistades_por_usuario(db, usuario_id=usuario_id, skip=skip, limit=limit)

@router.put("/{amistad_id}", response_model=AmistadResponse)
def responder_solicitud(amistad_id: int, actualizacion: AmistadUpdate, db: Session = Depends(get_db)):
    db_amistad = crud_amistad.get_amistad(db, amistad_id=amistad_id)
    if db_amistad is None:
        raise HTTPException(status_code=404, detail="Solicitud de amistad no encontrada")
    
    # Estados admitidos por ejemplo: "aceptada", "rechazada", "bloqueada"
    return crud_amistad.actualizar_estado_amistad(db=db, db_amistad=db_amistad, estado=actualizacion.estado)

@router.delete("/{amistad_id}", status_code=status.HTTP_204_NO_CONTENT)
def borrar_amistad(amistad_id: int, db: Session = Depends(get_db)):
    db_amistad = crud_amistad.get_amistad(db, amistad_id=amistad_id)
    if db_amistad is None:
        raise HTTPException(status_code=404, detail="Amistad no encontrada")
    crud_amistad.eliminar_amistad(db=db, amistad_id=amistad_id)
    return None
