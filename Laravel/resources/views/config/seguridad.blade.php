@extends('layout.app')

@section('title', 'Configuración de Seguridad - Priority Pulse')

@section('content')
    <div class="flex-1 flex flex-col h-full overflow-hidden bg-white relative">

        <header class="flex flex-col gap-6 p-8 pb-6 border-b border-gray-100 bg-white z-10">
            <div class="flex flex-wrap justify-between items-end gap-4">
                <div class="flex flex-col gap-1">
                    <h2 class="text-3xl font-black tracking-tight text-gray-900">Configuración de Seguridad</h2>
                    <p class="text-[#6e00ff] text-sm font-semibold">Administración avanzada de roles, permisos y políticas
                        de acceso.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="aplicarPoliticas()"
                        class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                        <span class="material-symbols-outlined text-[18px]">verified_user</span>
                        Aplicar Políticas
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
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors"
                            href="/configuracion">
                            <span class="material-symbols-outlined text-[20px]">tune</span>
                            General
                        </a>
                        <a
                            class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm">
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

                    {{-- Toast --}}
                    <div id="toast"
                        class="hidden fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-3 rounded-xl shadow-xl text-sm font-bold text-white bg-emerald-600 transition-all duration-300">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <span id="toast-msg">Políticas aplicadas correctamente.</span>
                    </div>

                    {{-- Gestión de Roles --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-[#f3ebff] p-2 rounded-lg text-[#6e00ff]">
                                <span class="material-symbols-outlined">shield_person</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Gestión de Roles</h3>
                                <p class="text-sm text-gray-500">Niveles de acceso y permisos por rol en el sistema.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Admin --}}
                            <div
                                class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-red-100 transition-all">
                                <div class="bg-red-100 p-2.5 rounded-full text-red-500 flex-shrink-0 mt-1">
                                    <span class="material-symbols-outlined">local_police</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-gray-900 font-bold text-base">Admin</h4>
                                    <p class="text-xs text-gray-500 mt-1 mb-3">Acceso total al sistema, configuraciones
                                        críticas y gestión de la plataforma.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="px-2 py-1 bg-red-50 text-red-600 text-[0.65rem] font-bold uppercase tracking-wider rounded border border-red-100">Acceso
                                            Completo</span>
                                        <span
                                            class="px-2 py-1 bg-gray-100 text-gray-600 text-[0.65rem] font-bold uppercase tracking-wider rounded">
                                            <span id="badge-admin">—</span> usuarios
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Usuario --}}
                            <div
                                class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-emerald-100 transition-all">
                                <div class="bg-emerald-100 p-2.5 rounded-full text-emerald-500 flex-shrink-0 mt-1">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-gray-900 font-bold text-base">Usuario</h4>
                                    <p class="text-xs text-gray-500 mt-1 mb-3">Acceso estándar a la app. Puede completar
                                        tareas, ver su progreso y logros.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[0.65rem] font-bold uppercase tracking-wider rounded border border-emerald-100">Acceso
                                            Estándar</span>
                                        <span
                                            class="px-2 py-1 bg-gray-100 text-gray-600 text-[0.65rem] font-bold uppercase tracking-wider rounded">
                                            <span id="badge-usuario">—</span> usuarios
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Políticas de contraseñas --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-orange-50 p-2 rounded-lg text-orange-500">
                                <span class="material-symbols-outlined">password</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Políticas de Contraseñas</h3>
                                <p class="text-sm text-gray-500">Configuración de seguridad para el acceso de cuentas.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-1">Rotación Forzada</label>
                                <p class="text-xs text-gray-500 mb-3">Frecuencia con la que los usuarios deben actualizar
                                    sus credenciales.</p>
                                <div class="relative">
                                    <select id="pol-rotacion" onchange="savePref('pol_rotacion', this.value)"
                                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] appearance-none cursor-pointer shadow-sm">
                                        <option value="nunca">Nunca</option>
                                        <option value="30">Cada 30 días</option>
                                        <option value="60">Cada 60 días</option>
                                        <option value="90">Cada 90 días</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <div class="flex items-start justify-between">
                                    <div class="pr-4">
                                        <h4 class="text-gray-900 font-bold text-sm mb-1">Requerir 2FA</h4>
                                        <p class="text-xs text-gray-500">Autenticación de dos factores obligatoria para
                                            admins.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-1">
                                        <input id="toggle-2fa" type="checkbox" class="sr-only peer"
                                            onchange="savePref('seg_2fa', this.checked)">
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500">
                                        </div>
                                    </label>
                                </div>

                                <div class="flex items-start justify-between">
                                    <div class="pr-4">
                                        <h4 class="text-gray-900 font-bold text-sm mb-1">Bloqueo tras intentos fallidos</h4>
                                        <p class="text-xs text-gray-500">Bloquear cuenta tras 5 intentos incorrectos.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-1">
                                        <input id="toggle-bloqueo" type="checkbox" class="sr-only peer"
                                            onchange="savePref('seg_bloqueo', this.checked)">
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500">
                                        </div>
                                    </label>
                                </div>

                                <div class="flex items-start justify-between">
                                    <div class="pr-4">
                                        <h4 class="text-gray-900 font-bold text-sm mb-1">Registro de auditoría</h4>
                                        <p class="text-xs text-gray-500">Registrar cada acción de admin en el log del
                                            sistema.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-1">
                                        <input id="toggle-auditoria" type="checkbox" class="sr-only peer"
                                            onchange="savePref('seg_auditoria', this.checked)">
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alerta de seguridad --}}
                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 flex gap-3 items-start">
                        <span class="material-symbols-outlined text-amber-500 text-[20px] mt-0.5">warning</span>
                        <div>
                            <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider">Importante</h4>
                            <p class="text-xs text-amber-700 mt-1 leading-relaxed">Los cambios en políticas de seguridad
                                afectan a todos los administradores activos. Comunica los cambios antes de aplicarlos para
                                evitar bloqueos inesperados.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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

        // ─── Persistencia con localStorage ───────────────────────────────────────────
        function savePref(key, val) {
            localStorage.setItem(key, val);
        }

        function loadPrefs() {
            // Toggles
            document.getElementById('toggle-2fa').checked = localStorage.getItem('seg_2fa') !== 'false';
            document.getElementById('toggle-bloqueo').checked = localStorage.getItem('seg_bloqueo') !== 'false';
            document.getElementById('toggle-auditoria').checked = localStorage.getItem('seg_auditoria') !== 'false';

            // Select
            const rotacion = localStorage.getItem('pol_rotacion') ?? '90';
            const sel = document.getElementById('pol-rotacion');
            [...sel.options].forEach(o => { if (o.value === rotacion) o.selected = true; });
        }

        // ─── Aplicar Políticas ────────────────────────────────────────────────────────
        function aplicarPoliticas() {
            // Guardar estado actual
            savePref('pol_rotacion', document.getElementById('pol-rotacion').value);
            savePref('seg_2fa', document.getElementById('toggle-2fa').checked);
            savePref('seg_bloqueo', document.getElementById('toggle-bloqueo').checked);
            savePref('seg_auditoria', document.getElementById('toggle-auditoria').checked);
            showToast('Políticas de seguridad aplicadas correctamente.', 'success');
        }

        // ─── Toast ────────────────────────────────────────────────────────────────────
        function showToast(msg, type = 'success') {
            const toast = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            toast.className = `fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-3 rounded-xl shadow-xl text-sm font-bold text-white transition-all duration-300 ${type === 'error' ? 'bg-red-600' : 'bg-emerald-600'}`;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // ─── Cargar usuarios y conteo de roles ────────────────────────────────────────
        async function loadUsuarios() {
            try {
                const res = await fetch('/api/config/stats', { headers: { 'X-CSRF-TOKEN': CSRF } });
                const data = await res.json();

                // Sidebar counters
                if (data) {
                    document.getElementById('count-admin').textContent = data.total_admin ?? '—';
                    document.getElementById('count-usuario').textContent = data.total_usuarios_rol ?? data.total_usuarios ?? '—';
                    document.getElementById('count-total').textContent = data.total_usuarios ?? '—';
                    document.getElementById('badge-admin').textContent = data.total_admin ?? '—';
                    document.getElementById('badge-usuario').textContent = data.total_usuarios_rol ?? (data.total_usuarios ?? '—');
                }
            } catch { /* silencioso */ }

            // Cargar lista de los últimos 5 usuarios
            try {
                const res2 = await fetch('/usuarios', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                // La ruta /usuarios devuelve HTML; usamos el endpoint de stats que ya tiene datos.
                // Para mostrar usuarios usamos el proxy de stats combinado con un fetch a /usuarios via API.
                const res3 = await fetch('/api/config/usuarios-recientes', { headers: { 'X-CSRF-TOKEN': CSRF } });
                if (res3.ok) {
                    const users = await res3.json();
                    renderUsuarios(users);
                }
            } catch { renderUsuariosError(); }
        }

        function renderUsuarios(users) {
            const lista = document.getElementById('sesiones-lista');
            if (!users || users.length === 0) {
                lista.innerHTML = '<p class="text-sm text-gray-400 text-center py-4">No hay usuarios disponibles.</p>';
                return;
            }
            lista.innerHTML = users.slice(0, 6).map(u => `
            <div class="flex items-center justify-between py-2 px-3 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#f3ebff] text-[#6e00ff] flex items-center justify-center font-black text-sm flex-shrink-0">
                        ${u.nombre_usuario.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-900">${u.nombre_usuario}</div>
                        <div class="text-xs text-gray-400">${u.correo}</div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold px-2 py-0.5 rounded-full ${u.rol === 'admin' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700'}">
                        ${u.rol}
                    </span>
                    <span class="text-xs text-[#6e00ff] font-bold">${Number(u.xp_total).toLocaleString()} XP</span>
                </div>
            </div>`).join('');
        }

        function renderUsuariosError() {
            document.getElementById('sesiones-lista').innerHTML =
                '<p class="text-sm text-gray-400 text-center py-4">No se pudo cargar la lista de usuarios.</p>';
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadPrefs();
            loadUsuarios();
        });
    </script>
@endsection