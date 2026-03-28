@extends('layout.app')

@section('title', 'Notificaciones Globales - Priority Pulse')

@section('content')
<div class="flex-1 flex flex-col h-full overflow-hidden bg-white relative">

    <header class="flex flex-col gap-6 p-8 pb-6 border-b border-gray-100 bg-white z-10">
        <div class="flex flex-wrap justify-between items-end gap-4">
            <div class="flex flex-col gap-1">
                <h2 class="text-3xl font-black tracking-tight text-gray-900">Notificaciones Globales</h2>
                <p class="text-[#6e00ff] text-sm font-semibold">Gestiona los avisos del sistema y las notificaciones automáticas.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="guardarCambios()" class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Guardar Cambios
                </button>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#f8f9fa]">
        <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">

            {{-- Sidebar nav --}}
            <div class="w-full lg:w-64 flex-shrink-0">
                <nav class="flex flex-col gap-1 sticky top-0">
                    <h3 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Categorías</h3>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="/configuracion">
                        <span class="material-symbols-outlined text-[20px]">tune</span>
                        General
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="/seguridad">
                        <span class="material-symbols-outlined text-[20px]">security</span>
                        Seguridad
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        Notificaciones
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="/gamificacion">
                        <span class="material-symbols-outlined text-[20px]">stadia_controller</span>
                        Gamificación
                    </a>
                </nav>
            </div>

            {{-- Contenido principal --}}
            <div class="flex-1 space-y-6">

                {{-- Toast --}}
                <div id="toast" class="hidden fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-3 rounded-xl shadow-xl text-sm font-bold text-white bg-emerald-600 transition-all duration-300">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    <span id="toast-msg">Cambios guardados.</span>
                </div>

                {{-- Enviar nueva alerta --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="bg-[#f3ebff] p-2.5 rounded-lg text-[#6e00ff]">
                            <span class="material-symbols-outlined">send</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Enviar Alerta Global</h3>
                            <p class="text-sm text-gray-500">Crea una notificación que se registra en el sistema para todos los usuarios.</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mensaje de la alerta</label>
                            <textarea id="alerta-mensaje" rows="3"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition resize-none"
                                placeholder="Ej: El sistema estará en mantenimiento el viernes de 22:00 a 24:00 hrs..."></textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <button id="btn-enviar-alerta" onclick="enviarAlerta()"
                                class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-sm transition-all">
                                <span class="material-symbols-outlined text-[18px]">campaign</span>
                                Publicar Alerta
                            </button>
                            <span id="alerta-feedback" class="hidden text-sm font-semibold"></span>
                        </div>
                    </div>
                </div>

                {{-- Avisos del Sistema --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-[#f3ebff] p-2.5 rounded-lg text-[#6e00ff]">
                            <span class="material-symbols-outlined">campaign</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Avisos del Sistema</h3>
                            <p class="text-sm text-gray-500">Alertas críticas y anuncios visibles para todos los usuarios.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-[#fffaf0] border border-orange-100 rounded-xl">
                            <div class="flex items-center gap-4">
                                <div class="text-orange-500 flex-shrink-0">
                                    <span class="material-symbols-outlined">engineering</span>
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-sm mb-0.5">Alerta de Mantenimiento</h4>
                                    <p class="text-xs text-gray-500">Muestra un banner global informando sobre mantenimiento programado.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input id="toggle-mantenimiento" type="checkbox" class="sr-only peer"
                                    onchange="savePref('notif_mantenimiento', this.checked)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="text-[#6e00ff] flex-shrink-0">
                                    <span class="material-symbols-outlined">update</span>
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-sm mb-0.5">Novedades de Versión</h4>
                                    <p class="text-xs text-gray-500">Notificar automáticamente cuando se despliega una nueva versión de la app.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input id="toggle-version" type="checkbox" class="sr-only peer"
                                    onchange="savePref('notif_version', this.checked)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Notificaciones de Usuario --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-50 p-2.5 rounded-lg text-blue-500">
                            <span class="material-symbols-outlined">notifications_active</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Notificaciones de Usuario</h3>
                            <p class="text-sm text-gray-500">Triggers automáticos para engagement y actividad.</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @php
                        $togglesUsuario = [
                            ['id'=>'toggle-streaks', 'key'=>'notif_streaks', 'default'=>true,  'icon'=>'local_fire_department', 'bg'=>'bg-orange-50', 'color'=>'text-orange-500', 'title'=>'Rachas (Streaks)',     'desc'=>'Alertar al usuario cuando está a punto de perder su racha diaria.'],
                            ['id'=>'toggle-logros',  'key'=>'notif_logros',  'default'=>true,  'icon'=>'emoji_events',           'bg'=>'bg-yellow-50', 'color'=>'text-yellow-500', 'title'=>'Logros Desbloqueados', 'desc'=>'Notificación inmediata al conseguir un nuevo hito.'],
                            ['id'=>'toggle-social',  'key'=>'notif_social',  'default'=>false, 'icon'=>'favorite',               'bg'=>'bg-pink-50',   'color'=>'text-pink-500',   'title'=>'Interacción Social',   'desc'=>'Avisar sobre "Likes" y comentarios en publicaciones.'],
                            ['id'=>'toggle-niveles', 'key'=>'notif_niveles', 'default'=>true,  'icon'=>'military_tech',          'bg'=>'bg-purple-50', 'color'=>'text-purple-500', 'title'=>'Subida de Nivel',      'desc'=>'Notificar cuando el usuario sube de nivel.'],
                        ];
                        @endphp
                        @foreach($togglesUsuario as $t)
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="{{ $t['bg'] }} {{ $t['color'] }} p-2 rounded-full flex-shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">{{ $t['icon'] }}</span>
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-sm mb-0.5">{{ $t['title'] }}</h4>
                                    <p class="text-xs text-gray-500">{{ $t['desc'] }}</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input id="{{ $t['id'] }}" type="checkbox" class="sr-only peer"
                                    {{ $t['default'] ? 'checked' : '' }}
                                    onchange="savePref('{{ $t['key'] }}', this.checked)">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>
                        @if(!$loop->last)<div class="border-t border-gray-100 ml-14"></div>@endif
                        @endforeach
                    </div>
                </div>

                {{-- Feed en tiempo real --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-3">
                            <div class="bg-gray-100 p-2.5 rounded-lg text-gray-500">
                                <span class="material-symbols-outlined">history</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Historial de Alertas</h3>
                                <p class="text-sm text-gray-500">Últimas notificaciones registradas en el sistema.</p>
                            </div>
                        </div>
                        <button onclick="loadFeed()" class="text-xs font-bold text-[#6e00ff] flex items-center gap-1 hover:underline">
                            <span class="material-symbols-outlined text-[16px]">refresh</span> Recargar
                        </button>
                    </div>
                    <div id="notif-feed" class="space-y-3">
                        <div class="flex items-center justify-center gap-2 py-8 text-sm text-gray-400">
                            <span class="material-symbols-outlined text-gray-300" style="animation: spin 1s linear infinite">refresh</span>
                            Cargando historial...
                        </div>
                    </div>
                </div>

                {{-- Nota --}}
                <div class="bg-[#f0f7ff] border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                    <span class="material-symbols-outlined text-blue-400 text-[20px] mt-0.5">info</span>
                    <div>
                        <h4 class="text-xs font-bold text-blue-900 uppercase tracking-wider">Nota sobre el rendimiento</h4>
                        <p class="text-xs text-blue-700 mt-1 leading-relaxed">Las notificaciones masivas de "Avisos del Sistema" se procesan en cola y pueden tardar hasta 5 minutos en llegar a todos los usuarios activos.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

// ─── Persistencia ─────────────────────────────────────────────────────────────
function savePref(key, val) {
    localStorage.setItem(key, String(val));
}

function loadPrefs() {
    const toggles = {
        'toggle-mantenimiento': { key: 'notif_mantenimiento', def: false },
        'toggle-version':       { key: 'notif_version',       def: true  },
        'toggle-streaks':       { key: 'notif_streaks',       def: true  },
        'toggle-logros':        { key: 'notif_logros',        def: true  },
        'toggle-social':        { key: 'notif_social',        def: false },
        'toggle-niveles':       { key: 'notif_niveles',       def: true  },
    };
    Object.entries(toggles).forEach(([id, { key, def }]) => {
        const saved = localStorage.getItem(key);
        const el = document.getElementById(id);
        if (el) el.checked = saved !== null ? saved === 'true' : def;
    });
}

function guardarCambios() {
    // Guardar todos los toggles activos
    ['toggle-mantenimiento','toggle-version','toggle-streaks','toggle-logros','toggle-social','toggle-niveles'].forEach(id => {
        const el = document.getElementById(id);
        if (el) savePref(id.replace('toggle-', 'notif_'), el.checked);
    });
    showToast('Preferencias de notificación guardadas.', 'success');
}

// ─── Enviar alerta global ─────────────────────────────────────────────────────
async function enviarAlerta() {
    const mensaje = document.getElementById('alerta-mensaje').value.trim();
    if (!mensaje) {
        setFeedback('alerta-feedback', false, 'Escribe un mensaje antes de publicar.');
        return;
    }
    const btn = document.getElementById('btn-enviar-alerta');
    btn.disabled = true;
    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">hourglass_empty</span> Enviando...';

    try {
        const res = await fetch('/api/alerta', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ mensaje, usuario_id: 1 })
        });
        const json = await res.json();
        if (json.ok || res.ok) {
            setFeedback('alerta-feedback', true, '✅ Alerta publicada correctamente.');
            document.getElementById('alerta-mensaje').value = '';
            setTimeout(() => loadFeed(), 800);
        } else {
            setFeedback('alerta-feedback', false, '❌ Error al publicar la alerta.');
        }
    } catch {
        setFeedback('alerta-feedback', false, '❌ Error de conexión.');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">campaign</span> Publicar Alerta';
    }
}

// ─── Feed de notificaciones ───────────────────────────────────────────────────
async function loadFeed() {
    const feed = document.getElementById('notif-feed');
    feed.innerHTML = '<div class="flex items-center justify-center gap-2 py-8 text-sm text-gray-400"><span class="material-symbols-outlined text-gray-300" style="animation: spin 1s linear infinite">refresh</span> Cargando...</div>';
    try {
        const res  = await fetch('/api/config/logs', { headers: { 'X-CSRF-TOKEN': CSRF } });
        const data = await res.json();
        if (!data || data.length === 0) {
            feed.innerHTML = '<p class="text-sm text-gray-400 text-center py-6">No hay notificaciones registradas.</p>';
            return;
        }
        feed.innerHTML = data.map((n, i) => `
            <div class="flex items-start gap-3 p-3 ${i % 2 === 0 ? 'bg-gray-50' : 'bg-white'} border border-gray-100 rounded-xl">
                <div class="w-8 h-8 rounded-full bg-[#f3ebff] text-[#6e00ff] flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-[16px]">notifications</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-800 font-medium leading-snug">${n.mensaje ?? '—'}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs text-gray-400">Usuario #${n.usuario_id ?? '?'}</span>
                        <span class="text-gray-200">·</span>
                        <span class="text-xs text-[#6e00ff] font-bold">ID ${n.id}</span>
                    </div>
                </div>
            </div>`).join('');
    } catch {
        feed.innerHTML = '<p class="text-sm text-red-400 text-center py-6">Error al cargar el historial.</p>';
    }
}

// ─── Toast ────────────────────────────────────────────────────────────────────
function showToast(msg, type = 'success') {
    const toast = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    toast.className = `fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-3 rounded-xl shadow-xl text-sm font-bold text-white transition-all duration-300 ${type === 'error' ? 'bg-red-600' : 'bg-emerald-600'}`;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 3000);
}

function setFeedback(id, ok, msg) {
    const el = document.getElementById(id);
    if (!el) return;
    el.textContent = msg;
    el.className = `text-sm font-semibold ${ok ? 'text-emerald-600' : 'text-red-500'}`;
    el.classList.remove('hidden');
    if (ok) setTimeout(() => el.classList.add('hidden'), 3000);
}

document.addEventListener('DOMContentLoaded', () => {
    loadPrefs();
    loadFeed();
});
</script>
@endsection