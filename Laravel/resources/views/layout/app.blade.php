<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Priority Pulse')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    @vite(['resources/css/layout.css'])
    
    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <div class="brand">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            Priority Pulse
        </div>

        <ul class="nav-menu">
            <li class="nav-item"><a href="#">Dashboard</a></li>
            <li class="nav-item active"><a href="#">Gestión de Usuarios</a></li>
            <li class="nav-item"><a href="#">Analítica</a></li>
            <li class="nav-item"><a href="#">Configuración</a></li>
        </ul>

        <div class="sidebar-footer">
            <a href="#"> Cerrar Sesión</a>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>