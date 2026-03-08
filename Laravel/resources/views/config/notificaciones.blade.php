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
                <button class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Guardar Cambios
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="/seguridad">
                        <span class="material-symbols-outlined text-[20px]">security</span>
                        Seguridad
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm" href="/notificaciones">
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
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
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
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-50 p-2.5 rounded-lg text-blue-500">
                            <span class="material-symbols-outlined">notifications_active</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Notificaciones de Usuario</h3>
                            <p class="text-sm text-gray-500">Configuración de triggers automáticos para engagement y actividad.</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="bg-orange-50 text-orange-500 p-2 rounded-full flex-shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">local_fire_department</span>
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-sm mb-0.5">Rachas (Streaks)</h4>
                                    <p class="text-xs text-gray-500">Alertar al usuario cuando está a punto de perder su racha diaria.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>

                        <div class="border-t border-gray-100 ml-14"></div>

                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="bg-yellow-50 text-yellow-500 p-2 rounded-full flex-shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">emoji_events</span>
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-sm mb-0.5">Logros Desbloqueados</h4>
                                    <p class="text-xs text-gray-500">Notificación inmediata al conseguir un nuevo hito.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>

                        <div class="border-t border-gray-100 ml-14"></div>

                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="bg-pink-50 text-pink-500 p-2 rounded-full flex-shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">favorite</span>
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold text-sm mb-0.5">Interacción Social</h4>
                                    <p class="text-xs text-gray-500">Avisar sobre "Likes" y comentarios en publicaciones.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-[#f0f7ff] border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                    <div class="text-blue-500 font-bold mt-0.5">
                        <span class="material-symbols-outlined text-[20px]">info</span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-blue-900 uppercase tracking-wider">Nota sobre el rendimiento</h4>
                        <p class="text-xs text-blue-700 mt-1 leading-relaxed">Las notificaciones masivas de "Avisos del Sistema" se procesan en cola y pueden tardar hasta 5 minutos en llegar a todos los usuarios activos.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection