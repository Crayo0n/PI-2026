from flask import Flask, render_template, redirect, url_for

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('/auth/login.html')

@app.route('/registro')
def registro():
    return render_template('/auth/registro.html')

@app.route('/terminos')
def terminos():
    return render_template('/legal/terminos.html')

@app.route('/privacidad')
def privacidad():
    return render_template('/legal/privacidad.html')

@app.route('/inicio')
def inicio():
    return render_template('/inicio/inicio.html')

@app.route('/rutinas')
def rutinas():
    return render_template('/rutinas/rutinas.html')

@app.route('/clasificacion')
def clasificacion():
    return render_template('/inicio/clasificacion.html')

@app.route('/perfil')
def perfil():
    return render_template('/perfil/perfil.html')

@app.route('/editar-perfil')
def editar_perfil():
    return render_template('/perfil/editar.html')

@app.route('/ajustes-notificaciones')
def ajustes_notificaciones():
    return render_template('/notificaciones/ajuste.html')

if __name__ == '__main__':
    app.run(debug=True, port=5000)