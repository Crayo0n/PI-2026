@extends('layout.app')

@section('title', 'Dashboard - Priority Pulse')

@section('content')
<div class="flex-1 overflow-y-auto p-8 bg-[#f8f9fa] w-full h-full">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Control Operativo</h1>
            <p class="text-sm text-gray-500 mt-1">Visión general del sistema y operaciones en tiempo real.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="window.location.reload()" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <svg id="refresh-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Actualizar
            </button>
            <button onclick="document.getElementById('modal-alerta').classList.remove('hidden')" class="flex items-center gap-2 px-4 py-2 bg-[#6e00ff] border border-transparent rounded-lg text-sm font-bold text-white hover:bg-[#5a00d1] transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                Nueva Alerta
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            <div class="flex justify-between items-start mb-2 relative z-10">
                <h3 class="text-sm font-semibold text-gray-500">Usuarios en Línea</h3>
                <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-4xl font-black text-gray-900">{{ $stats ? number_format($stats['total_usuarios']) : '—' }}</span>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        12%
                    </span>
                    <span class="text-xs text-gray-400">vs. ayer</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#f3ebff] rounded-full -mr-16 -mt-16 opacity-50"></div>
            <div class="flex justify-between items-start mb-2 relative z-10">
                <h3 class="text-sm font-semibold text-gray-500">Tareas Creadas Hoy</h3>
                <div class="p-2 bg-[#f3ebff] text-[#6e00ff] rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-4xl font-black text-gray-900">{{ $stats ? number_format($stats['tareas_creadas_hoy']) : '—' }}</span>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs text-gray-400">Total en sistema:</span>
                    <span class="text-xs font-bold text-[#6e00ff]">{{ $stats ? number_format($stats['total_tareas']) : '—' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            <div class="flex justify-between items-start mb-2 relative z-10">
                <h3 class="text-sm font-semibold text-gray-500">Medallas Desbloqueadas</h3>
                <div class="p-2 bg-orange-100 text-orange-500 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-4xl font-black text-gray-900">{{ $stats ? number_format($stats['medallas_desbloqueadas']) : '—' }}</span>
                <div class="mt-2">
                    <span class="text-xs font-bold text-orange-600 bg-orange-100 px-2 py-1 rounded flex items-center w-max gap-1 border border-orange-200">
                        Catálogo: {{ $stats ? $stats['total_medallas_catalogo'] : '0' }} tipos
                    </span>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Crecimiento del Pulso</h2>
                <p class="text-xs text-gray-400">Adquisición de usuarios nuevos (Últimos 30 días)</p>
            </div>
            <div class="flex items-center gap-2 text-xs font-semibold text-gray-500">
                <span class="w-2 h-2 rounded-full bg-[#6e00ff]"></span> Datos en tiempo real
            </div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-[#faf8ff] border border-[#ede0ff] rounded-xl p-4 text-center">
                <div class="text-2xl font-black text-[#6e00ff]">{{ $stats ? number_format($stats['xp_total_generada']) : '0' }}</div>
                <div class="text-xs text-gray-500 font-semibold mt-1">XP Total Generada</div>
            </div>
            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 text-center">
                <div class="text-2xl font-black text-orange-500">{{ $stats ? $stats['racha_promedio'] : '0.0' }} días</div>
                <div class="text-xs text-gray-500 font-semibold mt-1">Racha Promedio</div>
            </div>
            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 text-center">
                <div class="text-2xl font-black text-emerald-600">{{ $stats ? number_format($stats['total_tareas']) : '0' }}</div>
                <div class="text-xs text-gray-500 font-semibold mt-1">Total de Tareas</div>
            </div>
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-center">
                <div class="text-2xl font-black text-blue-600">{{ $stats ? number_format($stats['total_medallas_catalogo']) : '0' }}</div>
                <div class="text-xs text-gray-500 font-semibold mt-1">Tipos de Medalla</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900">Distribución por Nivel</h2>
                <a href="{{ route('analitica') }}" class="text-xs font-bold text-[#6e00ff] hover:underline">Ver Analítica →</a>
            </div>
            <div class="space-y-3">
                @if($stats && count($stats['niveles_funnel']) > 0)
                    @foreach($stats['niveles_funnel'] as $nivel)
                    <div class="flex items-center gap-4">
                        <div class="w-24 text-sm font-bold text-gray-700 text-right flex-shrink-0">{{ $nivel['rango'] }}</div>
                        <div class="flex-1 bg-gray-100 rounded-full h-7 flex items-center">
                            @php $pct = max($nivel['porcentaje'], 2); @endphp
                            <div class="bg-gradient-to-r from-[#6e00ff] to-[#9b51e0] h-full rounded-full flex items-center justify-end px-3 text-white text-xs font-bold"
                                 style="width: {{ $pct }}%">
                                @if($nivel['porcentaje'] > 10) {{ $nivel['porcentaje'] }}% @endif
                            </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 w-12 text-right">{{ number_format($nivel['total_usuarios']) }}</div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8 text-gray-400 text-sm">No hay datos de niveles disponibles.</div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900">Estado del Sistema</h2>
                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
            </div>
            <div class="space-y-4 flex-1">
                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50 relative overflow-hidden">
                    <div class="absolute left-0 top-0 h-full w-1 bg-emerald-400"></div>
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                            <span class="font-bold text-sm text-gray-900">FastAPI (Priority Pulse)</span>
                        </div>
                        <span class="text-[0.65rem] font-bold {{ $stats ? 'text-emerald-600 bg-emerald-100' : 'text-red-600 bg-red-100' }} px-2 py-0.5 rounded uppercase tracking-wider">
                            {{ $stats ? 'Operativo' : 'Sin conexión' }}
                        </span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Usuarios: {{ $stats['total_usuarios'] ?? '—' }}</span>
                        <span>Tareas: {{ $stats['total_tareas'] ?? '—' }}</span>
                    </div>
                </div>
                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50 relative overflow-hidden">
                    <div class="absolute left-0 top-0 h-full w-1 bg-emerald-400"></div>
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path></svg>
                            <span class="font-bold text-sm text-gray-900">PostgreSQL</span>
                        </div>
                        <span class="text-[0.65rem] font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded uppercase tracking-wider">Operativo</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>XP generada: {{ $stats ? number_format($stats['xp_total_generada']) : '—' }}</span>
                        <span>Medallas: {{ $stats['medallas_desbloqueadas'] ?? '—' }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-[#f3ebff] border border-[#e0ccff] rounded-xl p-4 flex gap-3 items-start">
                <svg class="w-5 h-5 text-[#6e00ff] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <div>
                    <h4 class="text-xs font-bold text-[#5a00d1]">Sesión Admin Activa</h4>
                    <p class="text-[0.65rem] text-[#6e00ff] mt-0.5 font-semibold">{{ session('admin_nombre', 'Administrador') }}</p>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ===== Modal: Nueva Alerta ===== --}}
<div id="modal-alerta" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
        <div class="bg-gradient-to-r from-[#6e00ff] to-[#9b51e0] p-5 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <h2 class="text-white font-bold text-base">Nueva Alerta del Sistema</h2>
            </div>
            <button onclick="document.getElementById('modal-alerta').classList.add('hidden')" class="text-white/70 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6">
            <div id="alerta-success" class="hidden mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold px-4 py-3 rounded-lg">✅ Alerta enviada correctamente.</div>
            <div id="alerta-error"   class="hidden mb-4 bg-red-50 border border-red-200 text-red-700 text-sm font-semibold px-4 py-3 rounded-lg">❌ Error al enviar la alerta.</div>

            <label class="block text-xs font-bold text-gray-500 mb-1">Mensaje de la alerta</label>
            <textarea id="alerta-mensaje" rows="3" placeholder="Ej: El servidor entrará en mantenimiento a las 03:00 AM..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#6e00ff] resize-none"></textarea>

            <label class="block text-xs font-bold text-gray-500 mb-1 mt-4">Usuario destino (ID) — dejar vacío para difundir</label>
            <input id="alerta-usuario" type="number" min="1" placeholder="ID del usuario (opcional)" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#6e00ff]">

            <div class="flex gap-3 mt-6">
                <button onclick="document.getElementById('modal-alerta').classList.add('hidden')" class="flex-1 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">Cancelar</button>
                <button onclick="enviarAlerta()" class="flex-1 py-2 bg-[#6e00ff] rounded-lg text-sm font-bold text-white hover:bg-[#5a00d1] transition">Enviar Alerta</button>
            </div>
        </div>
    </div>
</div>

<script>
function enviarAlerta() {
    const mensaje = document.getElementById('alerta-mensaje').value.trim();
    const usuarioId = document.getElementById('alerta-usuario').value.trim();

    if (!mensaje) {
        document.getElementById('alerta-mensaje').focus();
        return;
    }

    const body = { mensaje: mensaje };
    if (usuarioId) body.usuario_id = parseInt(usuarioId);

    fetch('/api/alerta', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: JSON.stringify(body)
    })
    .then(r => {
        document.getElementById(r.ok ? 'alerta-success' : 'alerta-error').classList.remove('hidden');
        if (r.ok) {
            document.getElementById('alerta-mensaje').value = '';
            document.getElementById('alerta-usuario').value = '';
            setTimeout(() => document.getElementById('modal-alerta').classList.add('hidden'), 1800);
        }
    })
    .catch(() => document.getElementById('alerta-error').classList.remove('hidden'));
}
</script>
@endsection