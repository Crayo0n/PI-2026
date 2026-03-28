from flask import Flask, render_template, redirect, url_for, request, flash, session
import requests
import functools

API_URL = "http://api:8000/api/v1"

app = Flask(__name__)
app.secret_key = 'priority_pulse_mvp_secure_key'

def login_required(f):
    @functools.wraps(f)
    def decorated_function(*args, **kwargs):
        if 'usuario_id' not in session:
            return redirect(url_for('login'))
        return f(*args, **kwargs)
    return decorated_function

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

    usuario_info = {
        "nombre": session.get('nombre_usuario', 'Usuario'),
        "nivel": 4,
        "xp": 500,
        "xp_siguiente": 1000,
        "racha": 12
    }
    
    try:
        # Verificar y resetear racha si han pasado mas de 24h
        requests.post(f'{API_URL}/usuarios/{usuario_id}/check-streak')

        # Fetch tasks and routines for specific user
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
            usuario_info['xp'] = u_data.get('xp_total', 0)
            usuario_info['racha'] = u_data.get('racha_actual', 0)

    except Exception as e:
        print(f"Error cargando desde FastAPI: {e}")
        
    return render_template('/inicio/inicio.html', tareas=tareas, rutinas=rutinas, usuario=usuario_info)

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

@app.route('/agregar-rutina-molde', methods=['POST'])
@login_required
def agregar_rutina_molde():
    molde = request.form.get('molde')
    
    if molde == 'manana_maestra':
        rutina_payload = {
            "nombre": "Mañana Maestra",
            "usuario_id": session['usuario_id'],
            "esta_activa": True
        }
        
        try:
            res_rut = requests.post(f'{API_URL}/rutinas/', json=rutina_payload)
            if res_rut.status_code == 201:
                rutina_id = res_rut.json().get('id')
                
                tareas_molde = [
                    {"titulo": "Hidratación", "descripcion": "Beber 500ml de agua con limón", "xp_recompensa": 5},
                    {"titulo": "Estiramiento", "descripcion": "Movilidad ligera para despertar el cuerpo", "xp_recompensa": 10},
                    {"titulo": "Meditación", "descripcion": "Enfoque en la respiración y presencia", "xp_recompensa": 15},
                    {"titulo": "Diario de gratitud", "descripcion": "Escribir 3 cosas por las que estás agradecido", "xp_recompensa": 5},
                    {"titulo": "Planificación", "descripcion": "Revisar agenda y prioridades del día", "xp_recompensa": 15}
                ]
                
                for t in tareas_molde:
                    t_payload = {
                        "titulo": t["titulo"],
                        "descripcion": t["descripcion"],
                        "usuario_id": session['usuario_id'],
                        "es_critica": False,
                        "xp_recompensa": t["xp_recompensa"],
                        "estado": "pendiente",
                        "rutina_id": rutina_id,
                        "tags": "Hábito,Mañana"
                    }
                    requests.post(f'{API_URL}/tareas/', json=t_payload)
                    
                flash('¡Rutina "Mañana Maestra" añadida a tu día!', 'success')
            else:
                flash('Error al añadir la rutina desde la biblioteca.', 'error')
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
    return render_template('/rutinas/rutinas.html')

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

@app.route('/perfil')
@login_required
def perfil():
    usuario = {}
    try:
        res = requests.get(f'{API_URL}/usuarios/{session["usuario_id"]}')
        if res.status_code == 200:
            usuario = res.json()
    except Exception as e:
        print(f"Error conectando a FastAPI: {e}")
    return render_template('/perfil/perfil.html', usuario=usuario)

@app.route('/editar-perfil', methods=['GET', 'POST'])
@login_required
def editar_perfil():
    if request.method == 'POST':
        nombre_usuario = request.form.get('nombre_usuario')
        correo = request.form.get('correo')
        payload = {"nombre_usuario": nombre_usuario, "correo": correo}
        try:
            res = requests.put(f'{API_URL}/usuarios/{session["usuario_id"]}', json=payload)
            if res.status_code == 200:
                flash('Perfil actualizado con éxito.', 'success')
            else:
                flash('No se pudo actualizar el perfil.', 'error')
        except Exception as e:
            flash('Error de conexión con el servidor.', 'error')
        return redirect(url_for('perfil'))
    else:
        usuario = {}
        try:
            res = requests.get(f'{API_URL}/usuarios/{session["usuario_id"]}')
            if res.status_code == 200:
                usuario = res.json()
        except Exception as e:
            print(f"Error conectando a FastAPI: {e}")
        return render_template('/perfil/editar.html', usuario=usuario)

@app.route('/ajustes-notificaciones')
@login_required
def ajustes_notificaciones():
    return render_template('/notificaciones/ajuste.html')

if __name__ == '__main__':
    app.run(debug=True, port=5000)