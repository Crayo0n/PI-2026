@extends('layout.app')

@section('title', 'Analíticas - Priority Pulse')

@section('content')
<div class="flex-1 overflow-y-auto p-8 bg-[#f8f9fa] w-full h-full">

    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Analítica de Gamificación</h1>
            <p class="text-sm text-gray-500 mt-1">Monitorización de interacciones RPG, medallas y progresión de usuarios.</p>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="flex bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm text-sm font-medium">
                <button class="px-4 py-2 text-gray-500 hover:bg-gray-50 transition">Hoy</button>
                <button class="px-4 py-2 text-[#6e00ff] bg-[#f3ebff] border-x border-gray-200">7 Días</button>
                <button class="px-4 py-2 text-gray-500 hover:bg-gray-50 transition">30 Días</button>
            </div>
            
            <button class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] rounded-lg text-sm font-bold text-white hover:bg-[#5a00d1] transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Exportar Reporte
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-gradient-to-br from-[#6e00ff] to-[#5100bc] p-6 rounded-2xl shadow-md text-white flex flex-col justify-between relative overflow-hidden">
            <div>
                <div class="flex items-center gap-2 text-purple-200 font-semibold text-sm mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                    Días Promedio de Racha
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-5xl font-black">14.2</span>
                    <span class="text-lg text-purple-200">días</span>
                </div>
                <p class="text-xs text-purple-200 mt-2">Un aumento del <span class="font-bold text-white">+12%</span> respecto al mes anterior.</p>
            </div>
            
            <div class="flex items-end gap-1.5 mt-6 h-10">
                <div class="w-full bg-white/20 rounded-t-sm h-1/4 hover:bg-white/40 transition"></div>
                <div class="w-full bg-white/20 rounded-t-sm h-2/4 hover:bg-white/40 transition"></div>
                <div class="w-full bg-white/20 rounded-t-sm h-1/3 hover:bg-white/40 transition"></div>
                <div class="w-full bg-white/20 rounded-t-sm h-2/3 hover:bg-white/40 transition"></div>
                <div class="w-full bg-white/30 rounded-t-sm h-1/2 hover:bg-white/50 transition"></div>
                <div class="w-full bg-white/40 rounded-t-sm h-3/4 hover:bg-white/60 transition"></div>
                <div class="w-full bg-white/50 rounded-t-sm h-4/5 hover:bg-white/70 transition"></div>
                <div class="w-full bg-white/70 rounded-t-sm h-full hover:bg-white transition"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">XP Total Generada</h3>
                <span class="text-4xl font-black text-gray-900">48.5M</span>
            </div>
            <div class="mt-6">
                <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 70%"></div>
                </div>
                <p class="text-xs text-gray-400">70% del objetivo mensual</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Medallas Desbloqueadas</h3>
                <span class="text-4xl font-black text-gray-900">8,291</span>
            </div>
            <div class="mt-6">
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md flex items-center w-max gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +5.3% esta semana
                </span>
            </div>
        </div>

    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-[#6e00ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            <h2 class="text-lg font-bold text-gray-900">Mapa de Calor: Medallas más Ganadas</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <div class="aspect-square bg-[#8b3dff] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-xs font-semibold">Rápido</span>
            </div>
            <div class="aspect-square bg-[#7c2eff] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-xs font-semibold">Diario</span>
            </div>
            <div class="aspect-square bg-[#9b51e0] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                <span class="text-xs font-semibold">Social</span>
            </div>
            <div class="aspect-square bg-[#b87cff] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-xs font-semibold">Sabio</span>
            </div>
            <div class="aspect-square bg-[#c49aff] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-xs font-semibold">Verif.</span>
            </div>
            <div class="aspect-square bg-[#6366f1] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                <span class="text-xs font-semibold">Invitar</span>
            </div>
            
            <div class="aspect-square bg-[#d9baff] rounded-xl flex flex-col items-center justify-center text-purple-900 hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                <span class="text-xs font-semibold">VIP</span>
            </div>
            <div class="aspect-square bg-[#e9d5ff] rounded-xl flex flex-col items-center justify-center text-purple-900 hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="text-xs font-semibold">Rico</span>
            </div>
            <div class="aspect-square bg-[#93c5fd] rounded-xl flex flex-col items-center justify-center text-blue-900 hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                <span class="text-xs font-semibold">Beta</span>
            </div>
            <div class="aspect-square bg-[#d8b4fe] rounded-xl flex flex-col items-center justify-center text-purple-900 hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                <span class="text-xs font-semibold">Tester</span>
            </div>
            <div class="aspect-square bg-[#c4b5fd] rounded-xl flex flex-col items-center justify-center text-purple-900 hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                <span class="text-xs font-semibold">Editor</span>
            </div>
            <div class="aspect-square bg-[#3b82f6] rounded-xl flex flex-col items-center justify-center text-white hover:scale-105 transition cursor-pointer shadow-sm">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                <span class="text-xs font-semibold">Viral</span>
            </div>
        </div>

        <div class="mt-6 flex justify-between items-center text-xs font-semibold text-gray-400">
            <div class="flex items-center gap-3">
                <span>Menos común</span>
                <div class="w-32 h-2 rounded-full bg-gradient-to-r from-[#e9d5ff] via-[#9b51e0] to-[#3b82f6]"></div>
                <span>Más común</span>
            </div>
            <div>Total Tipos: 42</div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Progresión de Niveles (Embudo)</h2>
                <p class="text-xs text-gray-500 mt-1">Análisis de retención de usuarios a través de hitos de nivel RPG.</p>
            </div>
            <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1.5 rounded-full flex items-center gap-2 border border-red-100">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Drop-off crítico en Nivel 20
            </span>
        </div>

        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <div class="w-24 text-sm font-bold text-gray-700 text-right">Nivel 1-10</div>
                <div class="flex-1 bg-gray-50 rounded-r-full h-10 relative flex items-center">
                    <div class="bg-[#8b3dff] h-full flex items-center justify-end px-6 text-white text-xs font-bold transition-all duration-500" style="width: 100%; clip-path: polygon(0% 0%, 98% 0%, 100% 50%, 98% 100%, 0% 100%);">
                        100% (25k)
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="w-24"></div>
                <div class="flex-1 flex justify-center text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m0 0l-3-3m3 3l3-3"></path></svg>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-24 text-sm font-bold text-gray-700 text-right">Nivel 11-20</div>
                <div class="flex-1 bg-gray-50 rounded-r-full h-10 relative flex items-center">
                    <div class="bg-[#9b51e0] h-full flex items-center justify-end px-6 text-white text-xs font-bold transition-all duration-500" style="width: 85%; clip-path: polygon(0% 0%, 97% 0%, 100% 50%, 97% 100%, 0% 100%);">
                        85% (21.2k)
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="w-24"></div>
                <div class="flex-1 flex justify-center text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m0 0l-3-3m3 3l3-3"></path></svg>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-24 text-sm font-bold text-gray-700 text-right">Nivel 21-30</div>
                <div class="flex-1 bg-gray-50 rounded-r-full h-10 relative flex items-center">
                    <div class="bg-[#b87cff] h-full flex items-center justify-end px-6 text-white text-xs font-bold transition-all duration-500" style="width: 55%; clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%);">
                        55% (13.7k)
                    </div>
                    <div class="absolute left-[58%] text-[0.65rem] font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded border border-red-100">
                        -30% Drop-off
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="w-24"></div>
                <div class="flex-1 flex justify-center text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m0 0l-3-3m3 3l3-3"></path></svg>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-24 text-sm font-bold text-gray-700 text-right">Nivel 31-40</div>
                <div class="flex-1 bg-gray-50 rounded-r-full h-10 relative flex items-center">
                    <div class="bg-[#d8b4fe] h-full flex items-center justify-end px-6 text-purple-900 text-xs font-bold transition-all duration-500" style="width: 40%; clip-path: polygon(0% 0%, 93% 0%, 100% 50%, 93% 100%, 0% 100%);">
                        40% (10k)
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="w-24"></div>
                <div class="flex-1 flex justify-center text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m0 0l-3-3m3 3l3-3"></path></svg>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-24 text-sm font-bold text-gray-700 text-right">Elite (40+)</div>
                <div class="flex-1 bg-gray-50 rounded-r-full h-10 relative flex items-center">
                    <div class="bg-[#3b82f6] h-full flex items-center justify-end px-6 text-white text-xs font-bold transition-all duration-500" style="width: 25%; clip-path: polygon(0% 0%, 90% 0%, 100% 50%, 90% 100%, 0% 100%);">
                        25% (6.2k)
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection