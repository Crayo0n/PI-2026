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
            <div class="logo flex items-center gap-2">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo Priority Pulse" class="h-8 w-auto">
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

                @if(session('error'))
                <div style="background:#fff0f0;border:1px solid #f5c6cb;color:#842029;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;font-weight:600;">
                    {{ session('error') }}
                </div>
                @endif

                <div id="js-error" style="display:none;background:#fff0f0;border:1px solid #f5c6cb;color:#842029;padding:12px 16px;border-radius:10px;margin-bottom:16px;font-size:14px;font-weight:600;"></div>

                <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input type="email" id="email" name="correo" placeholder="admin@prioritypulse.com" value="{{ old('correo') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" id="password" name="password" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="options">
                        <input type="checkbox" id="remember">
                        <label for="remember">Recordar este dispositivo por 30 días</label>
                    </div>

                    <button type="submit" class="btn-submit">
                        Iniciar Sesión
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                    @csrf
                </form>
            </div>
        </div>
        
    </div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const correo   = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const alertBox = document.getElementById('js-error');

        if (!correo || !password) {
            e.preventDefault();
            alertBox.textContent = !correo
                ? 'Por favor ingresa tu correo electrónico.'
                : 'Por favor ingresa tu contraseña.';
            alertBox.style.display = 'block';
        }
    });
</script>
</body>
</html>