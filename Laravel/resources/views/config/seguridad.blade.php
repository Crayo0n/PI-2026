@extends('layout.app')

@section('title', 'Configuración de Seguridad - Priority Pulse')

@section('content')
<div class="flex-1 flex flex-col h-full overflow-hidden bg-white relative">
    
    <header class="flex flex-col gap-6 p-8 pb-6 border-b border-gray-100 bg-white z-10">
        <div class="flex flex-wrap justify-between items-end gap-4">
            <div class="flex flex-col gap-1">
                <h2 class="text-3xl font-black tracking-tight text-gray-900">Configuración de Seguridad</h2>
                <p class="text-[#6e00ff] text-sm font-semibold">Administración avanzada de roles, permisos y políticas de acceso.</p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                    <span class="material-symbols-outlined text-lg">verified_user</span>
                    Aplicar Políticas
                </button>
            </div>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#f8f9fa]">
        <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto h-full">
            
            <div class="w-full lg:w-64 flex-shrink-0">
                <nav class="flex flex-col gap-1 sticky top-0">
                    <h3 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Categorías</h3>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="/configuracion">
                        <span class="material-symbols-outlined text-[20px]">tune</span>
                        General
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm" href="/seguridad">
                        <span class="material-symbols-outlined text-[20px]">security</span>
                        Seguridad
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="#">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        Notificaciones Globales
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="#">
                        <span class="material-symbols-outlined text-[20px]">stadia_controller</span>
                        Parámetros de Gamificación
                    </a>
                </nav>
            </div>

            <div class="flex-1 space-y-6">
                
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-[#f3ebff] p-2 rounded-lg text-[#6e00ff]">
                            <span class="material-symbols-outlined">shield_person</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Gestión de Roles</h3>
                            <p class="text-sm text-gray-500">Define los niveles de acceso y permisos por rol.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-red-100 transition-all cursor-pointer">
                            <div class="bg-red-100 p-2.5 rounded-full text-red-500 flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined">local_police</span>
                            </div>
                            <div>
                                <h4 class="text-gray-900 font-bold text-base">SuperAdmin</h4>
                                <p class="text-xs text-gray-500 mt-1 mb-3">Acceso total al sistema, configuraciones críticas y gestión financiera.</p>
                                <div class="flex gap-2">
                                    <span class="px-2 py-1 bg-red-50 text-red-600 text-[0.65rem] font-bold uppercase tracking-wider rounded border border-red-100">Acceso Completo</span>
                                    <span class="px-2 py-1 bg-gray-200 text-gray-600 text-[0.65rem] font-bold uppercase tracking-wider rounded">3 Usuarios</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-blue-100 transition-all cursor-pointer">
                            <div class="bg-blue-100 p-2.5 rounded-full text-blue-500 flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined">gavel</span>
                            </div>
                            <div>
                                <h4 class="text-gray-900 font-bold text-base">Moderador</h4>
                                <p class="text-xs text-gray-500 mt-1 mb-3">Gestión de contenido de usuarios, reportes y sanciones.</p>
                                <div class="flex gap-2">
                                    <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[0.65rem] font-bold uppercase tracking-wider rounded border border-blue-100">Gestión de Contenido</span>
                                    <span class="px-2 py-1 bg-gray-200 text-gray-600 text-[0.65rem] font-bold uppercase tracking-wider rounded">12 Usuarios</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-emerald-100 transition-all cursor-pointer">
                            <div class="bg-emerald-100 p-2.5 rounded-full text-emerald-500 flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined">support_agent</span>
                            </div>
                            <div>
                                <h4 class="text-gray-900 font-bold text-base">Soporte</h4>
                                <p class="text-xs text-gray-500 mt-1 mb-3">Acceso a tickets de soporte y visualización de datos de usuario (solo lectura).</p>
                                <div class="flex gap-2">
                                    <span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[0.65rem] font-bold uppercase tracking-wider rounded border border-emerald-100">Lectura Limitada</span>
                                    <span class="px-2 py-1 bg-gray-200 text-gray-600 text-[0.65rem] font-bold uppercase tracking-wider rounded">8 Usuarios</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-orange-50 p-2 rounded-lg text-orange-500">
                            <span class="material-symbols-outlined">password</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Políticas de Contraseñas</h3>
                            <p class="text-sm text-gray-500">Configuración de seguridad para el acceso de cuentas administrativas.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-1">Rotación Forzada de Contraseñas</label>
                            <p class="text-xs text-gray-500 mb-3">Establece la frecuencia con la que los usuarios deben actualizar sus credenciales.</p>
                            <div class="relative">
                                <select class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] appearance-none cursor-pointer shadow-sm">
                                    <option>Nunca</option>
                                    <option>Cada 30 días</option>
                                    <option>Cada 60 días</option>
                                    <option selected>Cada 90 días</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex items-start justify-between">
                                <div class="pr-4">
                                    <h4 class="text-gray-900 font-bold text-sm mb-1">Requerir 2FA</h4>
                                    <p class="text-xs text-gray-500">Autenticación de dos factores obligatoria.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-1">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>

                            <div class="flex items-start justify-between">
                                <div class="pr-4">
                                    <h4 class="text-gray-900 font-bold text-sm mb-1">Bloqueo tras intentos fallidos</h4>
                                    <p class="text-xs text-gray-500">Bloquear cuenta tras 5 intentos incorrectos.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer flex-shrink-0 mt-1">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection