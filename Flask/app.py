from flask import Flask, render_template, redirect, url_for, request, flash, session
import requests
import functools
from datetime import datetime

API_URL = "http://api:8000/api/v1"

app = Flask(__name__)
app.secret_key = 'priority_pulse_mvp_secure_key'

import os
import glob
from werkzeug.utils import secure_filename

AVATARS_FOLDER = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'static', 'images', 'avatars')
os.makedirs(AVATARS_FOLDER, exist_ok=True)

@app.context_processor
def avatar_processor():
    def get_avatar_url(uid):
        if not uid:
            return url_for('static', filename='images/avatar.png')
        patron = os.path.join(AVATARS_FOLDER, f"avatar_{uid}.*")
        coincidencias = glob.glob(patron)
        if coincidencias:
            archivo = os.path.basename(coincidencias[0])
            # Generar un hash temporal a partir del tiempo del archivo base para vencer al cache
            t = int(os.path.getmtime(coincidencias[0]))
            return url_for('static', filename=f'images/avatars/{archivo}') + f"?v={t}"
        return url_for('static', filename='images/avatar.png')
    return dict(get_avatar_url=get_avatar_url)
def login_required(f):
    @functools.wraps(f)
    def decorated_function(*args, **kwargs):
        if 'usuario_id' not in session:
            return redirect(url_for('login'))
        return f(*args, **kwargs)
    return decorated_function

@app.template_filter('timeago')
def timeago_filter(date_str):
    if not date_str:
        return ""
    try:
        # Pydantic returns ISO format e.g. "2026-03-27T12:00:00"
        dt = datetime.fromisoformat(date_str.replace('Z', '+00:00'))
        # Using naive utc for simpler diff calculation as MVP
        dt = dt.replace(tzinfo=None)
        now = datetime.utcnow()
        diff = now - dt

        seconds = diff.total_seconds()
        if seconds < 60:
            return "hace un momento"
        elif seconds < 3600:
            minutes = int(seconds / 60)
            return f"hace {minutes}m"
        elif seconds < 86400:
            hours = int(seconds / 3600)
            return f"hace {hours}h"
        elif seconds < 172800:
            return "ayer"
        else:
            days = int(seconds / 86400)
            return f"hace {days}d"
    except Exception as e:
        return ""

@app.context_processor
def inject_user_stats():
    if 'usuario_id' in session:
        try:
            uid = session['usuario_id']
            # Obtener datos del usuario
            res_user = requests.get(f'{API_URL}/usuarios/{uid}')
            nav_user = None
            if res_user.status_code == 200:
                data = res_user.json()
                nav_user = {
                    'id': uid,
                    'nombre': data.get('nombre_usuario', session.get('nombre_usuario', 'Puruhára')),
                    'racha': data.get('racha_actual', 0),
                    'xp': data.get('xp_total', 0),
                    'xp_total': data.get('xp_total', 0), # Agregamos esto para el HTML
                    'nivel': data.get('nivel', {}).get('numero_nivel', 1) if data.get('nivel') else 1,
                    'xp_requerida': data.get('nivel', {}).get('xp_requerida', 100) if data.get('nivel') else 100,
                    'xp_siguiente': data.get('nivel', {}).get('xp_requerida', 100) if data.get('nivel') else 100 # ¡ESTA ES LA QUE FALTABA!
                }
            
            # Obtener notificaciones
            res_notif = requests.get(f'{API_URL}/notificaciones/usuario/{uid}')
            nav_notifs = []
            no_leidas = 0
            if res_notif.status_code == 200:
                # Top 10 recents max in the global context
                nav_notifs = res_notif.json()[:10]
                no_leidas = sum(1 for n in nav_notifs if not n.get('leida', True))

            return {
                'nav_usuario': nav_user,
                'nav_notificaciones': nav_notifs,
                'nav_notif_no_leidas': no_leidas
            }
        except:
            pass
    return {'nav_usuario': None, 'nav_notificaciones': [], 'nav_notif_no_leidas': 0}

@app.route('/')
def index():
    if 'usuario_id' in session:
        return redirect(url_for('inicio'))
    return redirect(url_for('login'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if 'usuario_id' in session:
        return redirect(url_for('inicio'))
        
    if request.method == 'POST':
        email = request.form.get('email')
        password = request.form.get('password')
        try:
            response = requests.post(f'{API_URL}/usuarios/login', json={"correo": email, "password": password})
            if response.status_code == 200:
                user = response.json()
                session['usuario_id'] = user['id']
                session['nombre_usuario'] = user['nombre_usuario']
                return redirect(url_for('inicio'))
            else:
                flash('Credenciales incorrectas.', 'error')
        except Exception as e:
            flash('Error conectando con autenticación.', 'error')
    return render_template('/auth/login.html')

@app.route('/registro', methods=['GET', 'POST'])
def registro():
    if 'usuario_id' in session:
        return redirect(url_for('inicio'))
        
    if request.method == 'POST':
        fullname = request.form.get('fullname')
        email = request.form.get('email')
        nametag = request.form.get('nametag')
        password = request.form.get('password')
        try:
            payload = {"correo": email, "nombre_usuario": fullname, "password": password}
            response = requests.post(f'{API_URL}/usuarios/', json=payload)
            if response.status_code in [200, 201]:
                user = response.json()
                session['usuario_id'] = user['id']
                session['nombre_usuario'] = user['nombre_usuario']
                return redirect(url_for('inicio'))
            else:
                flash('Error al crear cuenta. ' + response.text, 'error')
        except Exception as e:
            flash('Error registrando usuario.', 'error')
    return render_template('/auth/registro.html')

@app.route('/logout')
def logout():
    session.clear()
    return redirect(url_for('login'))

@app.route('/terminos')
def terminos():
    return render_template('/legal/terminos.html')

@app.route('/privacidad')
def privacidad():
    return render_template('/legal/privacidad.html')

@app.route('/inicio')
@login_required
def inicio():
    tareas = []
    rutinas = []
    usuario_id = session['usuario_id']

    usuario_data = {"nombre": session.get('nombre_usuario', 'Puruhára'), "nivel": 1, "xp": 0, "xp_siguiente": 100, "racha": 0}
    
    try:
        requests.post(f'{API_URL}/usuarios/{usuario_id}/check-streak')
        response_tareas = requests.get(f'{API_URL}/tareas/')
        if response_tareas.status_code == 200:
            todas_las_tareas = response_tareas.json()
            tareas = [t for t in todas_las_tareas if not t.get('rutina_id') and t.get('usuario_id') == usuario_id]
            
        response_rutinas = requests.get(f'{API_URL}/rutinas/usuario/{usuario_id}')
        if response_rutinas.status_code == 200:
            rutinas = response_rutinas.json()

        response_user = requests.get(f'{API_URL}/usuarios/{usuario_id}')
        if response_user.status_code == 200:
            u_data = response_user.json()
            
            usuario_data['xp'] = u_data.get('xp_total', 0)
            usuario_data['racha'] = u_data.get('racha_actual', 0)
            
            if u_data.get('nivel'):
                usuario_data['nivel'] = u_data['nivel'].get('numero_nivel', 1)
                usuario_data['xp_siguiente'] = u_data['nivel'].get('xp_requerida', 100)

    except Exception as e:
        print(f"Jejavy FastAPI guive: {e}")
        
    return render_template('/inicio/inicio.html', tareas=tareas, rutinas=rutinas, usuario=usuario_data)

@app.route('/perfil')
@login_required
def perfil():
    usuario_id = session['usuario_id']
    stats = {
        "total_tareas": 0,
        "miembro_desde": "Recientemente"
    }
    heatmap_grid = []
    
    try:
        response_user = requests.get(f'{API_URL}/usuarios/{usuario_id}')
        if response_user.status_code == 200:
            u_data = response_user.json()
            if u_data.get('fecha_creacion'):
                from datetime import datetime
                # Asumimos formato ISO
                try:
                    fecha = datetime.fromisoformat(u_data['fecha_creacion'].replace("Z", "+00:00"))
                    meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                    stats['miembro_desde'] = f"{meses[fecha.month - 1]} {fecha.year}"
                except:
                    pass

        response_tareas = requests.get(f'{API_URL}/tareas/usuario/{usuario_id}')
        if response_tareas.status_code == 200:
            todas_las_tareas = response_tareas.json()
            stats['total_tareas'] = len(todas_las_tareas)
            
        # Peticion del Heatmap al Backend
        try:
            from datetime import timedelta, datetime as dt
            res_heatmap = requests.get(f'{API_URL}/historiales_xp/usuario/{usuario_id}/heatmap?dias=210')
            if res_heatmap.status_code == 200:
                data_heatmap = res_heatmap.json()
                mapa_fechas = {item['fecha']: item['xp'] for item in data_heatmap}
                
                hoy = dt.utcnow().date()
                for i in range(209, -1, -1):
                    dia = hoy - timedelta(days=i)
                    fecha_str = dia.strftime("%Y-%m-%d")
                    xp = mapa_fechas.get(fecha_str, 0)
                    
                    if xp == 0: nivel = 0
                    elif xp <= 50: nivel = 1
                    elif xp <= 150: nivel = 2
                    elif xp <= 300: nivel = 3
                    else: nivel = 4
                        
                    heatmap_grid.append({
                        'fecha': fecha_str,
                        'xp': xp,
                        'nivel': nivel
                    })
        except Exception as e:
            print(f"Error procesando Heatmap: {e}")
            
    except Exception as e:
        print(f"Error cargando perfil: {e}")

    return render_template('/perfil/perfil.html', stats=stats, heatmap_grid=heatmap_grid)


@app.route('/crear-tarea', methods=['POST'])
@login_required
def crear_tarea():
    titulo = request.form.get('titulo')
    descripcion = request.form.get('descripcion')
    fecha_limite = request.form.get('fecha_limite')
    prioridad = request.form.get('prioridad')
    tags = request.form.get('tags')
    rutina_id = request.form.get('rutina_id')
    
    es_critica = False
    xp_recompensa = 10
    
    if prioridad and prioridad.isdigit():
        p_val = int(prioridad)
        xp_recompensa = p_val
        if p_val >= 80:
            es_critica = True
            
    payload = {
        "titulo": titulo,
        "descripcion": descripcion,
        "usuario_id": session['usuario_id'],
        "es_critica": es_critica,
        "xp_recompensa": xp_recompensa,
        "estado": "pendiente"
    }
    
    if fecha_limite:
        payload["fecha_limite"] = fecha_limite
    if tags:
        payload["tags"] = tags
    if rutina_id:
        payload["rutina_id"] = int(rutina_id)
    
    try:
        response = requests.post(f'{API_URL}/tareas/', json=payload)
        if response.status_code == 201:
            flash('¡Tarea creada exitosamente!', 'success')
        else:
            flash('Ocurrió un problema al guardar la tarea.', 'error')
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
        flash('Error de conexión con el servidor.', 'error')
        
    return redirect(url_for('inicio'))

@app.route('/editar-tarea/<int:tarea_id>', methods=['POST'])
@login_required
def editar_tarea(tarea_id):
    titulo = request.form.get('titulo')
    descripcion = request.form.get('descripcion')
    fecha_limite = request.form.get('fecha_limite')
    prioridad = request.form.get('prioridad')
    tags = request.form.get('tags')
    
    es_critica = False
    xp_recompensa = 10
    
    if prioridad and prioridad.isdigit():
        p_val = int(prioridad)
        xp_recompensa = p_val
        if p_val >= 80:
            es_critica = True
            
    payload = {
        "titulo": titulo,
        "descripcion": descripcion,
        "es_critica": es_critica,
        "xp_recompensa": xp_recompensa
    }
    
    if fecha_limite:
        payload["fecha_limite"] = fecha_limite
    if tags:
        payload["tags"] = tags
        
    try:
        response = requests.put(f'{API_URL}/tareas/{tarea_id}', json=payload)
        if response.status_code == 200:
            flash('Tarea actualizada correctamente.', 'success')
        else:
            flash('No se pudo actualizar la tarea.', 'error')
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
        flash('Error de conexión con el servidor.', 'error')
        
    return redirect(url_for('inicio'))

@app.route('/eliminar-tarea/<int:tarea_id>', methods=['POST'])
@login_required
def eliminar_tarea(tarea_id):
    try:
        response = requests.delete(f'{API_URL}/tareas/{tarea_id}')
        if response.status_code == 204:
            flash('La tarea fue eliminada.', 'success')
        else:
            flash('Hubo un error al intentar eliminar la tarea.', 'error')
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
        flash('Error de conexión con el servidor.', 'error')
        
    return redirect(url_for('inicio'))

@app.route('/crear-rutina', methods=['POST'])
@login_required
def crear_rutina():
    nombre = request.form.get('nombre')
    
    payload = {
        "nombre": nombre,
        "usuario_id": session['usuario_id'],
        "esta_activa": True
    }
    
    try:
        response = requests.post(f'{API_URL}/rutinas/', json=payload)
        if response.status_code == 201:
            flash('¡Rutina creada exitosamente!', 'success')
        else:
            flash('Error al crear rutina.', 'error')
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
        flash('Error de conexión con el servidor.', 'error')
        
    return redirect(url_for('inicio'))


@app.route('/eliminar-rutina/<int:rutina_id>', methods=['POST'])
@login_required
def eliminar_rutina(rutina_id):
    try:
        response = requests.delete(f'{API_URL}/rutinas/{rutina_id}')
        if response.status_code == 204:
            flash('La rutina fue eliminada.', 'success')
        else:
            flash('Hubo un error al intentar eliminar la rutina.', 'error')
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
        flash('Error de conexión con el servidor.', 'error')
        
    return redirect(url_for('inicio'))

@app.route('/toggle-tarea/<int:tarea_id>', methods=['POST'])
@login_required
def toggle_tarea(tarea_id):
    try:
        res = requests.get(f'{API_URL}/tareas/{tarea_id}')
        if res.status_code == 200:
            tarea = res.json()
            nuevo_estado = "completada" if tarea.get("estado") != "completada" else "pendiente"
            
            payload = {
                "estado": nuevo_estado
            }
            put_res = requests.put(f'{API_URL}/tareas/{tarea_id}', json=payload)
            
            if put_res.status_code == 200:
                if nuevo_estado == "completada":
                    flash('¡Excelente! Tarea completada. +XP', 'success')
                else:
                    flash('Tarea desmarcada.', 'info')
            else:
                flash('Error al actualizar la tarea.', 'error')
    except Exception as e:
        flash('Error de conexión con el servidor.', 'error')
        
    return redirect(url_for('inicio'))

@app.route('/rutinas')
@login_required
def rutinas():
    rutinas_publicas = []
    try:
        response = requests.get(f'{API_URL}/rutinas/publicas')
        if response.status_code == 200:
            rutinas_publicas = response.json()
    except Exception as e:
        print(f"Error fetching public routines: {e}")
        
    return render_template('/rutinas/rutinas.html', rutinas=rutinas_publicas)

@app.route('/agregar_rutina_molde', methods=['POST'])
@login_required
def agregar_rutina_molde():
    rutina_id = request.form.get('rutina_id')
    usuario_id = session.get('usuario_id')
    
    try:
        # 1. Fetch the public routine template including its tasks
        res = requests.get(f'{API_URL}/rutinas/{rutina_id}')
        if res.status_code != 200:
            flash('No se pudo encontrar la rutina seleccionada.', 'error')
            return redirect(url_for('rutinas'))
        
        molde = res.json()
        
        # 2. Create the new user routine
        nueva_rutina_payload = {
            "nombre": molde['nombre'],
            "usuario_id": usuario_id,
            "esta_activa": True
        }
        res_rutina = requests.post(f'{API_URL}/rutinas/', json=nueva_rutina_payload)
        
        if res_rutina.status_code == 201:
            nueva_rutina = res_rutina.json()
            nueva_rutina_id = nueva_rutina['id']
            
            # 3. Clone each task from the template to the new routine
            tareas_originales = molde.get('tareas', [])
            for t in tareas_originales:
                tarea_payload = {
                    "titulo": t['titulo'],
                    "descripcion": t['descripcion'],
                    "usuario_id": usuario_id,
                    "rutina_id": nueva_rutina_id,
                    "xp_recompensa": t['xp_recompensa'],
                    "estado": "pendiente"
                }
                requests.post(f'{API_URL}/tareas/', json=tarea_payload)
            
            flash(f'¡Genial! La rutina "{molde["nombre"]}" ha sido añadida a tu día.', 'success')
        else:
            flash('Hubo un problema al crear tu rutina personalizada.', 'error')
            
    except Exception as e:
        print(f"Error cloning routine: {e}")
        flash('Error de conexión con el servidor al procesar la rutina.', 'error')
        
    return redirect(url_for('inicio'))

@app.route('/clasificacion')
@login_required
def clasificacion():
    usuarios = []
    try:
        response = requests.get(f'{API_URL}/usuarios/leaderboard?limit=50')
        if response.status_code == 200:
            usuarios = response.json()
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
    return render_template('/inicio/clasificacion.html', usuarios=usuarios)

@app.route('/editar-perfil', methods=['GET', 'POST'])
@login_required
def editar_perfil():
    if request.method == 'POST':
        nombre_usuario = request.form.get('nombre_usuario')
        correo = request.form.get('correo')
        
        # Procesamiento de Foto de Perfil
        if 'foto_perfil' in request.files:
            foto = request.files['foto_perfil']
            if foto and foto.filename:
                viejos = glob.glob(os.path.join(AVATARS_FOLDER, f"avatar_{session['usuario_id']}.*"))
                for v in viejos:
                    try: os.remove(v)
                    except: pass
                
                ext = secure_filename(foto.filename).rsplit('.', 1)[-1].lower() if '.' in foto.filename else 'png'
                nuevo_nombre = f"avatar_{session['usuario_id']}.{ext}"
                foto.save(os.path.join(AVATARS_FOLDER, nuevo_nombre))

        payload = {"nombre_usuario": nombre_usuario, "correo": correo}
        try:
            res = requests.put(f'{API_URL}/usuarios/{session["usuario_id"]}', json=payload)
            if res.status_code == 200:
                session['nombre_usuario'] = nombre_usuario
                flash('Perfil actualizado con éxito.', 'success')
            else:
                flash('No se pudo actualizar el perfil.', 'error')
        except Exception as e:
            flash('Error de conexión con el servidor.', 'error')
        return redirect(url_for('editar_perfil'))
    else:
        usuario = {}
        try:
            res = requests.get(f'{API_URL}/usuarios/{session["usuario_id"]}')
            if res.status_code == 200:
                usuario = res.json()
        except:
            pass
        return render_template('/perfil/editar.html', usuario=usuario)

@app.route('/cambiar-password', methods=['POST'])
@login_required
def cambiar_password():
    password_actual = request.form.get('password_actual')
    nueva_password = request.form.get('nueva_password')
    confirmacion = request.form.get('confirmacion_password')

    if nueva_password != confirmacion:
        flash('Las contraseñas nuevas no coinciden.', 'warning')
        return redirect(url_for('editar_perfil'))

    payload = {
        "password_actual": password_actual,
        "nueva_password": nueva_password
    }
    
    try:
        res = requests.put(f'{API_URL}/usuarios/{session["usuario_id"]}/password', json=payload)
        if res.status_code == 200:
            flash('Contraseña actualizada correctamente.', 'success')
            return redirect(url_for('perfil'))
        else:
            flash(res.json().get('detail', 'Error al actualizar contraseña.'), 'error')
    except Exception as e:
        flash('Error de conexión con el servidor.', 'error')

    return redirect(url_for('editar_perfil'))

@app.route('/eliminar-cuenta', methods=['POST'])
@login_required
def eliminar_cuenta():
    try:
        res = requests.delete(f'{API_URL}/usuarios/{session["usuario_id"]}')
        if res.status_code == 200:
            session.clear()
            flash('Tu cuenta ha sido eliminada permanentemente.', 'success')
            return redirect(url_for('login'))
        else:
            flash('Hubo un problema al intentar eliminar tu cuenta.', 'error')
            return redirect(url_for('editar_perfil'))
    except Exception as e:
        flash('Error de conexión con el servidor.', 'error')
        return redirect(url_for('editar_perfil'))


@app.route('/ajustes-notificaciones')
@login_required
def ajustes_notificaciones():
    return render_template('/notificaciones/ajuste.html')

if __name__ == '__main__':
    app.run(debug=True, port=5000)