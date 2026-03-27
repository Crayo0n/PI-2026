@extends('layout.app')

@section('title', 'Gestión de Usuarios - Priority Pulse')

@section('content')
<div class="flex h-full w-full bg-white overflow-hidden">
    
    {{-- ===== TABLA PRINCIPAL ===== --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto p-8">
        
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestión de Usuarios</h1>
            <p class="text-sm text-gray-500 mt-1">
                Administra la comunidad — 
                <span class="font-bold text-gray-800">{{ count($usuarios) }} usuarios</span> registrados en el sistema.
            </p>
        </div>

        {{-- Barra de herramientas --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                {{-- Exportar CSV --}}
                <button onclick="exportarCSV()" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Exportar CSV
                </button>
                
                {{-- Buscador --}}
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input id="buscador" type="text" placeholder="Buscar por nombre, ID o email..."
                        oninput="filtrarUsuarios()"
                        class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm w-72 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition">
                </div>
            </div>

            <div class="text-sm text-gray-500 font-medium">
                Mostrando <span id="contador-visible" class="font-bold text-gray-900">{{ count($usuarios) }}</span>
                de <span class="font-bold text-gray-900">{{ count($usuarios) }}</span> usuarios
            </div>
        </div>

        {{-- Tabla --}}
        <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#fcfaff] text-[0.75rem] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Usuario</th>
                        <th class="px-6 py-4">Nivel / XP</th>
                        <th class="px-6 py-4">Racha</th>
                        <th class="px-6 py-4">Rol</th>
                        <th class="px-6 py-4 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla-body" class="divide-y divide-gray-100">
                    @forelse($usuarios as $usuario)
                    <tr class="fila-usuario hover:bg-gray-50 transition cursor-pointer"
                        data-nombre="{{ strtolower($usuario['nombre_usuario']) }}"
                        data-correo="{{ strtolower($usuario['correo']) }}"
                        data-id="{{ $usuario['id'] }}"
                        onclick="mostrarPanel({{ json_encode($usuario) }})">

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#f3ebff] text-[#6e00ff] flex items-center justify-center font-black border border-purple-200 text-base flex-shrink-0">
                                    {{ strtoupper(substr($usuario['nombre_usuario'], 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ $usuario['nombre_usuario'] }}</div>
                                    <div class="text-xs text-gray-400">{{ $usuario['correo'] }} · ID {{ $usuario['id'] }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-extrabold text-[#6e00ff]">Lvl {{ $usuario['nivel_id'] ?? 1 }}</div>
                            <div class="text-xs font-bold text-[#6e00ff] bg-[#f3ebff] px-2 py-0.5 rounded-full inline-block mt-1">
                                {{ number_format($usuario['xp_total']) }} XP
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 bg-orange-50 text-orange-600 px-3 py-1 rounded-lg text-sm font-bold w-max border border-orange-100">
                                🔥 {{ $usuario['racha_actual'] }} días
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2 py-1 rounded-full
                                {{ $usuario['rol'] === 'admin' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ ucfirst($usuario['rol']) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <button onclick="event.stopPropagation(); mostrarPanel({{ json_encode($usuario) }})"
                                class="text-xs font-bold text-[#6e00ff] hover:underline">Ver perfil →</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            No se encontraron usuarios desde la API.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Sin resultados de búsqueda --}}
        <div id="no-resultados" class="hidden text-center py-10 text-gray-400 text-sm font-semibold">
            No se encontraron usuarios que coincidan con la búsqueda.
        </div>

    </div>

    {{-- ===== PANEL LATERAL DINÁMICO ===== --}}
    <div id="panel-usuario"
         class="w-80 border-l border-gray-200 bg-white flex flex-col overflow-y-auto transition-all duration-300 hidden lg:flex opacity-60">

        {{-- Estado vacío --}}
        <div id="panel-vacio" class="flex flex-col items-center justify-center flex-1 text-center px-8 text-gray-400">
            <svg class="w-12 h-12 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p class="text-sm font-semibold">Selecciona un usuario<br>para ver su perfil.</p>
        </div>

        {{-- Contenido del usuario seleccionado --}}
        <div id="panel-contenido" class="hidden flex-col h-full">

            <div class="p-6 text-center border-b border-gray-100 relative">
                <button onclick="cerrarPanel()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-[#6e00ff] to-[#9b51e0] flex items-center justify-center font-black text-3xl text-white mx-auto mb-3 shadow-lg" id="panel-avatar"></div>
                <h2 class="text-lg font-extrabold text-gray-900" id="panel-nombre"></h2>
                <p class="text-xs text-gray-400 mt-1" id="panel-correo"></p>
                <div class="flex justify-center gap-2 mt-3">
                    <span id="panel-rol-badge" class="text-xs font-bold px-3 py-1 rounded-full"></span>
                </div>
            </div>

            {{-- Stats del usuario --}}
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-4">Estadísticas</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-[#faf8ff] border border-[#ede0ff] rounded-xl p-3 text-center">
                        <div class="text-xl font-black text-[#6e00ff]" id="panel-xp"></div>
                        <div class="text-xs text-gray-500 font-semibold mt-0.5">XP Total</div>
                    </div>
                    <div class="bg-orange-50 border border-orange-100 rounded-xl p-3 text-center">
                        <div class="text-xl font-black text-orange-500" id="panel-racha">🔥 0</div>
                        <div class="text-xs text-gray-500 font-semibold mt-0.5">Racha actual</div>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3 text-center col-span-2">
                        <div class="text-xl font-black text-emerald-600" id="panel-nivel"></div>
                        <div class="text-xs text-gray-500 font-semibold mt-0.5">Nivel Actual</div>
                    </div>
                </div>
            </div>

            {{-- Info adicional --}}
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Información</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID de usuario</span>
                        <span class="font-bold text-gray-800" id="panel-id"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Correo</span>
                        <span class="font-bold text-gray-800 text-xs truncate max-w-36" id="panel-correo-info"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Rol</span>
                        <span class="font-bold text-gray-800" id="panel-rol-text"></span>
                    </div>
                </div>
            </div>

            {{-- Notas admin --}}
            <div class="p-6 bg-gray-50 flex-1">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Notas Admin</h3>
                </div>
                <textarea id="panel-nota" placeholder="Escribe una nota interna sobre este usuario..."
                    class="w-full h-24 p-3 text-sm bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] resize-none"></textarea>
            </div>

        </div>
    </div>
</div>

{{-- Datos JSON para JS --}}
<script>
const todosUsuarios = @json($usuarios);

function mostrarPanel(u) {
    // Poblar datos
    document.getElementById('panel-avatar').textContent = u.nombre_usuario.charAt(0).toUpperCase();
    document.getElementById('panel-nombre').textContent = u.nombre_usuario;
    document.getElementById('panel-correo').textContent = u.correo;
    document.getElementById('panel-correo-info').textContent = u.correo;
    document.getElementById('panel-id').textContent = '#' + u.id;
    document.getElementById('panel-xp').textContent = Number(u.xp_total).toLocaleString() + ' XP';
    document.getElementById('panel-racha').textContent = '🔥 ' + u.racha_actual + ' días';
    document.getElementById('panel-nivel').textContent = 'Nivel ' + (u.nivel_id ?? 1);
    document.getElementById('panel-rol-text').textContent = u.rol.charAt(0).toUpperCase() + u.rol.slice(1);

    const badge = document.getElementById('panel-rol-badge');
    if (u.rol === 'admin') {
        badge.className = 'text-xs font-bold px-3 py-1 rounded-full bg-red-100 text-red-700';
    } else {
        badge.className = 'text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-700';
    }
    badge.textContent = u.rol.charAt(0).toUpperCase() + u.rol.slice(1);

    // Mostrar/ocultar secciones
    document.getElementById('panel-vacio').classList.add('hidden');
    document.getElementById('panel-contenido').classList.remove('hidden');
    document.getElementById('panel-contenido').classList.add('flex');
    document.getElementById('panel-usuario').classList.remove('opacity-60');

    // Resaltar fila activa
    document.querySelectorAll('.fila-usuario').forEach(r => r.classList.remove('bg-purple-50', 'ring-1', 'ring-inset', 'ring-purple-200'));
    document.querySelectorAll('.fila-usuario').forEach(r => {
        if (r.dataset.id == u.id) r.classList.add('bg-purple-50');
    });
}

function cerrarPanel() {
    document.getElementById('panel-vacio').classList.remove('hidden');
    document.getElementById('panel-contenido').classList.add('hidden');
    document.getElementById('panel-contenido').classList.remove('flex');
    document.getElementById('panel-usuario').classList.add('opacity-60');
    document.querySelectorAll('.fila-usuario').forEach(r => r.classList.remove('bg-purple-50'));
}

function filtrarUsuarios() {
    const q = document.getElementById('buscador').value.toLowerCase().trim();
    const filas = document.querySelectorAll('.fila-usuario');
    let visibles = 0;

    filas.forEach(fila => {
        const nombre = fila.dataset.nombre || '';
        const correo = fila.dataset.correo || '';
        const id     = fila.dataset.id || '';
        const match  = !q || nombre.includes(q) || correo.includes(q) || id.includes(q);
        fila.style.display = match ? '' : 'none';
        if (match) visibles++;
    });

    document.getElementById('contador-visible').textContent = visibles;
    document.getElementById('no-resultados').classList.toggle('hidden', visibles > 0);
}

function exportarCSV() {
    const cabecera = ['ID','Nombre de Usuario','Correo','Nivel','XP Total','Racha Actual','Rol'];
    const filas = todosUsuarios.map(u => [
        u.id, u.nombre_usuario, u.correo, u.nivel_id ?? 1, u.xp_total, u.racha_actual, u.rol
    ]);
    const csv = [cabecera, ...filas].map(r => r.join(',')).join('\n');
    const blob = new Blob(['\uFEFF' + csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = 'usuarios_priority_pulse.csv';
    a.click();
    URL.revokeObjectURL(url);
}
</script>
@endsection