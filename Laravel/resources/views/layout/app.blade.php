<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Priority Pulse')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />

    @vite(['resources/css/layout.css'])

    @stack('styles')
</head>

<body>

    <aside class="sidebar">
        <div class="brand flex items-center gap-2">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo Priority Pulse" class="h-9 w-auto">
        </div>

        <ul class="nav-menu">
            @php
            $currentPath = request()->path();
            $mainNav = [
                [
                    'href'    => 'dashboard',
                    'icon'    => 'dashboard',
                    'label'   => 'Dashboard',
                    'matches' => ['dashboard'],
                ],
                [
                    'href'    => 'usuarios',
                    'icon'    => 'group',
                    'label'   => 'Gestión de Usuarios',
                    'matches' => ['usuarios'],
                ],
                [
                    'href'    => 'analitica',
                    'icon'    => 'bar_chart',
                    'label'   => 'Analítica',
                    'matches' => ['analitica', 'analitica/*'],
                ],
                [
                    'href'    => 'configuracion',
                    'icon'    => 'settings',
                    'label'   => 'Configuración',
                    'matches' => ['configuracion', 'seguridad', 'notificaciones', 'gamificacion'],
                ],
            ];
            @endphp
            @foreach($mainNav as $item)
            <li class="nav-item {{ request()->is($item['matches']) ? 'active' : '' }}">
                <a href="/{{ $item['href'] }}">
                    <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                    {{ $item['label'] }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="sidebar-logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</body>

</html>