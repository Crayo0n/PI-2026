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
            <button class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Actualizar
            </button>
            <button class="flex items-center gap-2 px-4 py-2 bg-[#6e00ff] border border-transparent rounded-lg text-sm font-bold text-white hover:bg-[#5a00d1] transition shadow-md">
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
                <span class="text-4xl font-black text-gray-900">1,248</span>
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
                <span class="text-4xl font-black text-gray-900">8,540</span>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-xs font-bold text-[#6e00ff] bg-[#f3ebff] px-2 py-0.5 rounded flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        5.4%
                    </span>
                    <span class="text-xs text-gray-400">vs. promedio</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            <div class="flex justify-between items-start mb-2 relative z-10">
                <h3 class="text-sm font-semibold text-gray-500">Reportes Pendientes</h3>
                <div class="p-2 bg-orange-100 text-orange-500 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <div class="relative z-10">
                <span class="text-4xl font-black text-gray-900">23</span>
                <div class="mt-2">
                    <span class="text-xs font-bold text-orange-600 bg-orange-100 px-2 py-1 rounded flex items-center w-max gap-1 border border-orange-200">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"></path></svg>
                        Requiere atención
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
        
        <div class="relative w-full h-64 border-b border-gray-100 border-dashed">
            <div class="absolute top-[20%] right-[30%] bg-gray-900 text-white text-xs font-bold px-2 py-1 rounded shadow-lg z-20">384 Nuevos</div>
            
            <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                <defs>
                    <linearGradient id="purpleGradient" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0%" stop-color="#6e00ff" stop-opacity="0.3"/>
                        <stop offset="100%" stop-color="#6e00ff" stop-opacity="0.0"/>
                    </linearGradient>
                </defs>
                <path d="M0,90 Q10,85 20,70 T40,65 T60,30 T80,35 L80,100 L0,100 Z" fill="url(#purpleGradient)"/>
                <path d="M0,90 Q10,85 20,70 T40,65 T60,30 T80,35" fill="none" stroke="#6e00ff" stroke-width="2"/>
                <circle cx="80" cy="35" r="2" fill="white" stroke="#6e00ff" stroke-width="1.5" />
            </svg>

            <div class="absolute bottom-[-20px] left-0 w-[80%] flex justify-between text-[0.65rem] text-gray-400">
                <span>01 May</span>
                <span>05 May</span>
                <span>10 May</span>
                <span>15 May</span>
                <span>20 May</span>
                <span>25 May</span>
                <span>30 May</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900">Feed de Actividad Crítica</h2>
                <a href="#" class="text-xs font-bold text-[#6e00ff] hover:underline">Ver todo el historial</a>
            </div>

            <div class="space-y-6">
                <div class="flex gap-4 items-start">
                    <div class="p-2 bg-yellow-50 text-yellow-500 rounded-full border border-yellow-100 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-bold text-gray-900">Nuevo Usuario Nivel 50</h4>
                            <span class="text-xs text-gray-400">Hace 2m</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">El usuario <span class="text-[#6e00ff] font-semibold">@david_pro</span> ha alcanzado el nivel máximo.</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start border-t border-gray-50 pt-6">
                    <div class="p-2 bg-red-50 text-red-500 rounded-full border border-red-100 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-bold text-gray-900">Intento de Acceso Fallido</h4>
                            <span class="text-xs text-gray-400">Hace 42m</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">IP 192.168.1.XX bloqueada tras 5 intentos en cuenta admin.</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start border-t border-gray-50 pt-6">
                    <div class="p-2 bg-blue-50 text-blue-500 rounded-full border border-blue-100 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-bold text-gray-900">Backup Completado</h4>
                            <span class="text-xs text-gray-400">Hace 1h</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Copia de seguridad diaria de la base de datos finalizada con éxito.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-900">Estado de Servidores</h2>
                <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
            </div>

            <div class="space-y-4 flex-1">
                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50 relative overflow-hidden">
                    <div class="absolute left-0 top-0 h-full w-1 bg-emerald-400"></div>
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                            <span class="font-bold text-sm text-gray-900">API Gateway</span>
                        </div>
                        <span class="text-[0.65rem] font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded uppercase tracking-wider">Operativo</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Uptime: 99.99%</span>
                        <span>Resp: 45ms</span>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50 relative overflow-hidden">
                    <div class="absolute left-0 top-0 h-full w-1 bg-emerald-400"></div>
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                            <span class="font-bold text-sm text-gray-900">Database Primary</span>
                        </div>
                        <span class="text-[0.65rem] font-bold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded uppercase tracking-wider">Operativo</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Conexiones: 850</span>
                        <span>Load: 32%</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h4 class="text-xs font-bold text-blue-900">Mantenimiento Programado</h4>
                    <p class="text-[0.65rem] text-blue-700 mt-1 leading-relaxed">El nodo AI-04 se reiniciará a las 03:00 AM UTC para actualizaciones de seguridad.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection