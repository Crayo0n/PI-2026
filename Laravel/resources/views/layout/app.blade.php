<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Priority Pulse')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    @vite(['resources/css/layout.css'])
    
    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <div class="brand flex items-center gap-2">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Priority Pulse" class="h-9 w-auto">
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