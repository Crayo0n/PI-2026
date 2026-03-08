<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Priority Pulse</title>
    @vite(['resources/css/login.css'])
</head>
<body>
    <div class="split-layout">
        
        <div class="left-panel">
            <div class="logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
                Priority Pulse
            </div>
            
            <div class="left-content">
                <h1>Administra y<br>escala la<br>productividad<br>global</h1>
                <p>Accede al panel de control centralizado para monitorear el rendimiento, gestionar usuarios y optimizar el flujo de trabajo de toda la organización.</p>
            </div>
            
            <div class="left-footer">
                © 2026 Priority Pulse Inc. &nbsp;•&nbsp; Privacidad &nbsp;•&nbsp; Términos
            </div>
        </div>

        <div class="right-panel">
            <div class="login-container">
                <h2>Bienvenido,<br>Administrador</h2>
                <p>Ingresa tus credenciales para acceder al sistema.</p>

                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input type="email" id="email" placeholder="admin@prioritypulse.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" id="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="options">
                        <input type="checkbox" id="remember">
                        <label for="remember">Recordar este dispositivo por 30 días</label>
                    </div>

                    <button type="button" class="btn-submit">
                        Iniciar Sesión
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>