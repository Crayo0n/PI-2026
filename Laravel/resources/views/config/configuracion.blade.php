@extends('layout.app')

@section('title', 'Configuración General - Priority Pulse')

@section('content')
<div class="flex-1 flex flex-col h-full overflow-hidden bg-white relative">
    
    <header class="flex flex-col gap-6 p-8 pb-6 border-b border-gray-100 bg-white z-10">
        <div class="flex flex-wrap justify-between items-end gap-4">
            <div class="flex flex-col gap-1">
                <h2 class="text-3xl font-black tracking-tight text-gray-900">Configuración General</h2>
                <p class="text-[#6e00ff] text-sm font-semibold">Administración de parámetros globales del sistema y preferencias.</p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-bold hover:bg-gray-50 transition-all shadow-sm">
                    Ver Logs
                </button>
                <button class="flex items-center gap-2 px-4 py-2 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm" href="#">
                        General
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="#">
                        Perfil
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="#">
                        Seguridad
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="#">
                        Notificaciones Globales
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="#">
                        Parámetros de Gamificación
                    </a>
                </nav>
            </div>

            <div class="flex-1 space-y-6">
                
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                        <div class="bg-[#f3ebff] p-2 rounded-lg">
                            <div class="w-5 h-5 bg-[#6e00ff] rounded-sm"></div> 
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Control del Sistema</h3>
                            <p class="text-sm text-gray-500">Interruptores principales para la operatividad de la plataforma.</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex flex-col max-w-xl pr-4">
                                <h4 class="text-gray-900 font-bold text-sm mb-1">Mantenimiento del Sistema</h4>
                                <p class="text-xs text-gray-500">Activa el modo mantenimiento. Los usuarios verán una pantalla de "En construcción".</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex flex-col max-w-xl pr-4">
                                <h4 class="text-gray-900 font-bold text-sm mb-1">Registro de Nuevos Usuarios</h4>
                                <p class="text-xs text-gray-500">Permitir que nuevos usuarios se registren en la plataforma.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>

                        <div class="border-t border-gray-100"></div>

                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="flex flex-col max-w-xl pr-4">
                                <h4 class="text-gray-900 font-bold text-sm mb-1">API Integrations (Público)</h4>
                                <p class="text-xs text-gray-500">Habilitar los endpoints públicos de la API para integraciones de terceros.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#6e00ff]"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                        <div class="bg-blue-50 p-2 rounded-lg">
                            <div class="w-5 h-5 bg-blue-500 rounded-sm"></div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Información de la Organización</h3>
                            <p class="text-sm text-gray-500">Datos visibles en correos y pie de página.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre de la Organización</label>
                            <input class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition" type="text" value="Priority Pulse Inc.">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Correo de Soporte</label>
                            <input class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition" type="email" value="support@prioritypulse.com">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Zona Horaria Predeterminada</label>
                            <select class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition">
                                <option>(GMT-05:00) Eastern Time (US & Canada)</option>
                                <option>(GMT-06:00) Central Time (US & Canada)</option>
                                <option selected>(GMT+01:00) Madrid, Paris, Berlin</option>
                            </select>
                            <p class="mt-2 text-xs text-gray-400 font-semibold">Afecta a los reinicios diarios de misiones y cálculos de racha.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                    <div class="text-blue-500 font-bold mt-0.5">ℹ</div>
                    <div>
                        <h4 class="text-xs font-bold text-blue-900 uppercase tracking-wider">Nota sobre cambios</h4>
                        <p class="text-xs text-blue-700 mt-1 leading-relaxed">Los cambios realizados en "Control del Sistema" se aplican inmediatamente, pero pueden tardar hasta 5 minutos en propagarse a todas las sesiones activas de usuarios debido al caché.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection