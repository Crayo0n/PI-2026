@extends('layout.app')

@section('title', 'Configuración General - Priority Pulse')

@section('content')
    <div class="flex-1 flex flex-col h-full overflow-hidden bg-white relative">

        <header class="flex flex-col gap-6 p-8 pb-6 border-b border-gray-100 bg-white z-10">
            <div class="flex flex-wrap justify-between items-end gap-4">
                <div class="flex flex-col gap-1">
                    <h2 class="text-3xl font-black tracking-tight text-gray-900">Configuración General</h2>
                    <p class="text-[#6e00ff] text-sm font-semibold">Administración de parámetros globales del sistema y
                        preferencias.</p>
                </div>
                <div class="flex gap-3 items-center">
                    <button onclick="toggleLogsPanel()"
                        class="flex items-center gap-2 px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-bold hover:bg-gray-50 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">article</span>
                        Ver Logs
                    </button>
                    <button onclick="guardarConfiguracion()"
                        class="flex items-center gap-2 px-4 py-2 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#f8f9fa]">
            <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">

                {{-- Sidebar de navegación --}}
                <div class="w-full lg:w-64 flex-shrink-0">
                    <nav class="flex flex-col gap-1 sticky top-0">
                        <h3 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Categorías</h3>
                        <a
                            class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm">
                            <span class="material-symbols-outlined text-[20px]">tune</span>
                            General
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors"
                            href="/seguridad">
                            <span class="material-symbols-outlined text-[20px]">security</span>
                            Seguridad
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors"
                            href="/notificaciones">
                            <span class="material-symbols-outlined text-[20px]">notifications</span>
                            Notificaciones
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors"
                            href="/gamificacion">
                            <span class="material-symbols-outlined text-[20px]">stadia_controller</span>
                            Gamificación
                        </a>
                    </nav>
                </div>

                {{-- Contenido principal --}}
                <div class="flex-1 space-y-6">

                    {{-- Toast de confirmación --}}
                    <div id="toast"
                        class="hidden fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-3 rounded-xl shadow-xl text-sm font-bold text-white transition-all duration-300 bg-emerald-600">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span id="toast-msg">Cambios guardados correctamente.</span>
                    </div>

                    {{-- Control del Sistema --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                            <div class="bg-[#f3ebff] p-2 rounded-lg">
                                <span class="material-symbols-outlined text-[#6e00ff] text-[20px]">settings_suggest</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Control del Sistema</h3>
                                <p class="text-sm text-gray-500">Interruptores principales para la operatividad de la
                                    plataforma.</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div
                                class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex flex-col max-w-xl pr-4">
                                    <h4 class="text-gray-900 font-bold text-sm mb-1">Modo Mantenimiento</h4>
                                    <p class="text-xs text-gray-500">Activa el modo mantenimiento. Los usuarios verán una
                                        pantalla de "En construcción".</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input id="toggle-mantenimiento" type="checkbox" class="sr-only peer"
                                        onchange="saveToggle('mantenimiento', this.checked)">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500">
                                    </div>
                                </label>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            <div
                                class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex flex-col max-w-xl pr-4">
                                    <h4 class="text-gray-900 font-bold text-sm mb-1">Registro de Nuevos Usuarios</h4>
                                    <p class="text-xs text-gray-500">Permitir que nuevos usuarios se registren en la
                                        plataforma.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input id="toggle-registro" type="checkbox" class="sr-only peer"
                                        onchange="saveToggle('registro', this.checked)">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]">
                                    </div>
                                </label>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            <div
                                class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex flex-col max-w-xl pr-4">
                                    <h4 class="text-gray-900 font-bold text-sm mb-1">API Integrations (Público)</h4>
                                    <p class="text-xs text-gray-500">Habilitar los endpoints públicos de la API para
                                        integraciones de terceros.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input id="toggle-api" type="checkbox" class="sr-only peer"
                                        onchange="saveToggle('api', this.checked)">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Información de la Organización --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                            <div class="bg-blue-50 p-2 rounded-lg">
                                <span class="material-symbols-outlined text-blue-500 text-[20px]">business</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Información de la Organización</h3>
                                <p class="text-sm text-gray-500">Datos visibles en correos y pie de página.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nombre de la Organización</label>
                                <input id="org-nombre"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition"
                                    type="text" placeholder="Priority Pulse Inc.">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Correo de Soporte</label>
                                <input id="org-correo"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition"
                                    type="email" placeholder="support@prioritypulse.com">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Zona Horaria
                                    Predeterminada</label>
                                <select id="org-timezone"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition">
                                    <option value="EST">(GMT-05:00) Eastern Time (US & Canada)</option>
                                    <option value="CST">(GMT-06:00) Central Time (US & Canada)</option>
                                    <option value="MST">(GMT-07:00) Mountain Time (US & Canada)</option>
                                    <option value="PST">(GMT-08:00) Pacific Time (US & Canada)</option>
                                    <option value="CET">(GMT+01:00) Madrid, Paris, Berlin</option>
                                    <option value="UTC">(GMT+00:00) UTC</option>
                                </select>
                                <p class="mt-2 text-xs text-gray-400 font-semibold">Afecta a los reinicios diarios de
                                    misiones y cálculos de racha.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Nota informativa --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                        <span class="material-symbols-outlined text-blue-400 text-[20px] mt-0.5">info</span>
                        <div>
                            <h4 class="text-xs font-bold text-blue-900 uppercase tracking-wider">Nota sobre cambios</h4>
                            <p class="text-xs text-blue-700 mt-1 leading-relaxed">Los cambios en "Control del Sistema" se
                                aplican inmediatamente, pero pueden tardar hasta 5 minutos en propagarse a todas las
                                sesiones activas de usuarios debido al caché.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Panel de Logs lateral --}}
    <div id="logs-panel"
        class="fixed top-0 right-0 h-full w-96 bg-white border-l border-gray-200 shadow-2xl z-40 transform translate-x-full transition-transform duration-300 flex flex-col">
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <div>
                <h3 class="font-bold text-gray-900">Logs del Sistema</h3>
                <p class="text-xs text-gray-400 mt-0.5">Últimas notificaciones registradas</p>
            </div>
            <button onclick="toggleLogsPanel()" class="text-gray-400 hover:text-gray-600">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div id="logs-body" class="flex-1 overflow-y-auto p-4 space-y-3">
            <div class="flex items-center justify-center h-32 text-gray-400 text-sm">
                <span class="material-symbols-outlined animate-spin mr-2"
                    style="animation: spin 1s linear infinite">refresh</span>
                Cargando logs...
            </div>
        </div>
    </div>
    <div id="logs-overlay" class="fixed inset-0 bg-black/20 z-30 hidden" onclick="toggleLogsPanel()"></div>

    <style>
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

        // ─── Persistencia de toggles con localStorage ───────────────────────────────
        const KEYS = {
            mantenimiento: { id: 'toggle-mantenimiento', default: false },
            registro: { id: 'toggle-registro', default: true },
            api: { id: 'toggle-api', default: true },
        };

        function loadToggles() {
            Object.entries(KEYS).forEach(([key, cfg]) => {
                const saved = localStorage.getItem('cfg_' + key);
                const val = saved !== null ? saved === 'true' : cfg.default;
                document.getElementById(cfg.id).checked = val;
            });
        }

        function saveToggle(key, val) {
            localStorage.setItem('cfg_' + key, val);
            showToast(val ? `${key.charAt(0).toUpperCase() + key.slice(1)} activado.` : `${key.charAt(0).toUpperCase() + key.slice(1)} desactivado.`, val && key === 'mantenimiento' ? 'error' : 'success');
        }

        // ─── Persistencia de formulario con localStorage ─────────────────────────────
        function loadOrgInfo() {
            const nombre = localStorage.getItem('cfg_org_nombre') ?? '';
            const correo = localStorage.getItem('cfg_org_correo') ?? '';
            const timezone = localStorage.getItem('cfg_org_timezone') ?? 'CET';
            if (nombre) document.getElementById('org-nombre').value = nombre;
            if (correo) document.getElementById('org-correo').value = correo;
            const sel = document.getElementById('org-timezone');
            [...sel.options].forEach(o => { if (o.value === timezone) o.selected = true; });
        }

        function guardarConfiguracion() {
            const nombre = document.getElementById('org-nombre').value.trim();
            const correo = document.getElementById('org-correo').value.trim();
            const timezone = document.getElementById('org-timezone').value;
            localStorage.setItem('cfg_org_nombre', nombre);
            localStorage.setItem('cfg_org_correo', correo);
            localStorage.setItem('cfg_org_timezone', timezone);
            showToast('Configuración guardada correctamente.', 'success');
        }

        // ─── Toast ────────────────────────────────────────────────────────────────────
        function showToast(msg, type = 'success') {
            const toast = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            toast.className = `fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-3 rounded-xl shadow-xl text-sm font-bold text-white transition-all duration-300 ${type === 'error' ? 'bg-red-600' : 'bg-emerald-600'}`;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // ─── Panel de Logs ────────────────────────────────────────────────────────────
        let logsLoaded = false;
        function toggleLogsPanel() {
            const panel = document.getElementById('logs-panel');
            const overlay = document.getElementById('logs-overlay');
            const isOpen = !panel.classList.contains('translate-x-full');

            if (isOpen) {
                panel.classList.add('translate-x-full');
                overlay.classList.add('hidden');
            } else {
                panel.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                if (!logsLoaded) loadLogs();
            }
        }

        async function loadLogs() {
            try {
                const res = await fetch('/api/config/logs', { headers: { 'X-CSRF-TOKEN': CSRF } });
                const data = await res.json();
                const body = document.getElementById('logs-body');
                logsLoaded = true;

                if (!data || data.length === 0) {
                    body.innerHTML = '<p class="text-sm text-gray-400 text-center py-8">No hay logs registrados.</p>';
                    return;
                }

                body.innerHTML = data.map(n => `
                <div class="border border-gray-100 rounded-xl p-3 bg-gray-50">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-[#6e00ff] text-[16px] mt-0.5">notifications</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 leading-snug">${n.mensaje ?? '—'}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs text-gray-400">Usuario #${n.usuario_id ?? '?'}</span>
                                <span class="text-xs text-gray-300">·</span>
                                <span class="text-xs text-gray-400">ID ${n.id}</span>
                            </div>
                        </div>
                    </div>
                </div>`).join('');
            } catch {
                document.getElementById('logs-body').innerHTML =
                    '<p class="text-sm text-red-400 text-center py-8">Error al cargar logs desde la API.</p>';
            }
        }

        // ─── Stats del sidebar desde la API ──────────────────────────────────────────
        async function loadStats() {
            try {
                const res = await fetch('/api/config/stats', { headers: { 'X-CSRF-TOKEN': CSRF } });
                const data = await res.json();
                if (data) {
                    document.getElementById('stat-usuarios').textContent = data.total_usuarios?.toLocaleString() ?? '—';
                    document.getElementById('stat-tareas').textContent = data.total_tareas?.toLocaleString() ?? '—';
                    document.getElementById('stat-xp').textContent = (data.xp_total_sistema ?? 0).toLocaleString() + ' XP';
                    document.getElementById('stat-medallas').textContent = data.total_medallas?.toLocaleString() ?? '—';
                }
            } catch { /* API no devuelve datos aún */ }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadToggles();
            loadOrgInfo();
            loadStats();
        });
    </script>
@endsection