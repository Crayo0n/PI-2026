@extends('layout.app')

@section('title', 'Gestión de Usuarios - Priority Pulse')

@section('content')
<div class="flex h-full w-full bg-white overflow-hidden">
    
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto p-8">
        
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestión de Usuarios</h1>
            <p class="text-sm text-gray-500 mt-1">Administra la comunidad, revisa reportes y analiza el rendimiento.</p>
        </div>

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Exportar
                </button>
                
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Buscar por nombre, ID o email..." class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm w-72 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition">
                </div>
            </div>

            <div class="flex items-center gap-4 text-sm text-gray-600 font-medium">
                <div class="flex items-center gap-1 cursor-pointer hover:text-gray-900">Nivel: Todos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></div>
                <div class="flex items-center gap-1 cursor-pointer hover:text-gray-900">Estado: Activo <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></div>
                <div class="flex items-center gap-2 pl-4 border-l border-gray-200">
                    <div class="w-8 h-4 bg-gray-200 rounded-full relative"><div class="absolute left-0 top-0 w-4 h-4 bg-white border border-gray-300 rounded-full shadow-sm"></div></div>
                    Reportes pendientes
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#fcfaff] text-[0.75rem] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-200">
                        <th class="px-6 py-4">Usuario</th>
                        <th class="px-6 py-4">Nivel / XP</th>
                        <th class="px-6 py-4">Racha</th>
                        <th class="px-6 py-4">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?img=5" class="w-10 h-10 rounded-full object-cover border border-gray-200" alt="Sofia">
                                <div>
                                    <div class="font-bold text-gray-900">Sofia Martinez</div>
                                    <div class="text-xs text-gray-500">ID: 8492 • @sofiam_99</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-extrabold text-[#6e00ff]">Lvl 4</div>
                            <div class="text-xs font-bold text-[#6e00ff] bg-[#f3ebff] px-2 py-0.5 rounded-full inline-block mt-1">500 XP</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 bg-orange-50 text-orange-600 px-3 py-1 rounded-lg text-sm font-bold w-max border border-orange-100">
                                <span>🔥</span> 12 Días
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-700">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> En línea
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?img=11" class="w-10 h-10 rounded-full object-cover border border-gray-200" alt="Carlos">
                                <div>
                                    <div class="font-bold text-gray-900">Carlos Ruiz</div>
                                    <div class="text-xs text-gray-500">ID: 1120 • @carlos_dev</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-extrabold text-gray-600">Lvl 1</div>
                            <div class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full inline-block mt-1">200 XP</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 bg-gray-50 text-gray-500 px-3 py-1 rounded-lg text-sm font-bold w-max border border-gray-200">
                                <span>⏱</span> 0 Días
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-sm font-medium text-gray-400">
                                <span class="w-2 h-2 rounded-full bg-gray-300"></span> Ausente
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-6 text-sm text-gray-500 font-medium">
            <div>Mostrando <span class="font-bold text-gray-900">1-5</span> de 148 usuarios</div>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50">&lt;</button>
                <button class="w-8 h-8 flex items-center justify-center rounded bg-[#6e00ff] text-white font-bold">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50">&gt;</button>
            </div>
        </div>

    </div>

    <div class="w-80 border-l border-gray-200 bg-white flex flex-col overflow-y-auto hidden lg:flex">
        
        <div class="p-8 text-center border-b border-gray-100 relative">
            <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <div class="relative inline-block mb-4">
                <img src="https://i.pravatar.cc/150?img=5" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md mx-auto" alt="Sofia">
                <div class="w-4 h-4 bg-emerald-500 border-2 border-white rounded-full absolute bottom-1 right-1"></div>
            </div>
            
            <h2 class="text-xl font-extrabold text-gray-900">Sofia Martinez</h2>
            <p class="text-xs text-[#6e00ff] font-semibold mt-1">@sofiam_99 <span class="text-gray-400 font-normal"> • Unida Mar 2023</span></p>
            
            <div class="flex justify-center gap-2 mt-4">
                <button class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 transition shadow-sm">Mensaje</button>
                <button class="px-3 py-2 border border-gray-200 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-50 transition shadow-sm">•••</button>
            </div>
        </div>

        <div class="p-6 border-b border-gray-100">
            <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-4">Historial de Productividad</h3>
            
            <div class="h-24 flex items-end justify-between gap-2 mb-6 pt-4 border-b border-gray-100 pb-2">
                <div class="w-full bg-[#f3ebff] rounded-t-sm h-1/4"></div>
                <div class="w-full bg-[#e6d5ff] rounded-t-sm h-2/4"></div>
                <div class="w-full bg-[#f3ebff] rounded-t-sm h-1/3"></div>
                <div class="w-full bg-[#6e00ff] rounded-t-sm h-full shadow-md shadow-purple-200"></div>
                <div class="w-full bg-[#e6d5ff] rounded-t-sm h-3/4"></div>
                <div class="w-full bg-[#f3ebff] rounded-t-sm h-2/4"></div>
                <div class="w-full bg-[#9b51e0] rounded-t-sm h-5/6"></div>
            </div>

            <div class="flex gap-3">
                <div class="flex-1 bg-gray-50 border border-gray-100 rounded-xl p-3 text-center">
                    <div class="text-xs text-gray-500 font-medium mb-1">Racha Actual</div>
                    <div class="text-lg font-black text-orange-500">🔥 12</div>
                </div>
                <div class="flex-1 bg-gray-50 border border-gray-100 rounded-xl p-3 text-center">
                    <div class="text-xs text-gray-500 font-medium mb-1">Completados</div>
                    <div class="text-lg font-black text-emerald-500">✅ 143</div>
                </div>
            </div>
        </div>

        <div class="p-6 border-b border-gray-100">
            <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-4">Actividad Reciente</h3>
            
            <div class="relative pl-4 border-l-2 border-[#f3ebff] space-y-4">
                <div class="relative">
                    <div class="absolute -left-[21px] top-1 w-2.5 h-2.5 bg-white border-2 border-[#6e00ff] rounded-full"></div>
                    <p class="text-sm font-bold text-gray-900">Completó "Revisión Trimestral"</p>
                    <p class="text-xs text-gray-400 mt-0.5">Hace 2 horas</p>
                </div>
                <div class="relative">
                    <div class="absolute -left-[21px] top-1 w-2.5 h-2.5 bg-white border-2 border-gray-300 rounded-full"></div>
                    <p class="text-sm font-bold text-gray-700">Actualizó perfil</p>
                    <p class="text-xs text-gray-400 mt-0.5">Ayer, 4:30 PM</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50 flex-1">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Notas Admin</h3>
                <span class="text-[0.65rem] font-bold text-[#6e00ff] cursor-pointer hover:underline">Guardar Nota</span>
            </div>
            <textarea placeholder="Escribe una nota interna sobre este usuario..." class="w-full h-24 p-3 text-sm bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] resize-none"></textarea>
        </div>

    </div>
</div>
@endsection