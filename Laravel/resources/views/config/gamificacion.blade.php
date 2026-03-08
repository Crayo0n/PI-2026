@extends('layout.app')

@section('title', 'Parámetros de Gamificación - Priority Pulse')

@section('content')
<div class="flex-1 flex flex-col h-full overflow-hidden bg-white relative">
    
    <header class="flex flex-col gap-6 p-8 pb-6 border-b border-gray-100 bg-white z-10">
        <div class="flex flex-wrap justify-between items-end gap-4">
            <div class="flex flex-col gap-1">
                <h2 class="text-3xl font-black tracking-tight text-gray-900">Parámetros de Gamificación</h2>
                <p class="text-[#6e00ff] text-sm font-semibold">Ajusta el motor RPG del sistema, gestión de niveles y probabilidades de recompensas.</p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-bold hover:bg-gray-50 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">history</span>
                    Historial
                </button>
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-500 hover:bg-white hover:text-[#6e00ff] font-medium text-sm transition-colors" href="/notificaciones">
                        <span class="material-symbols-outlined text-[20px]">notifications</span>
                        Notificaciones Globales
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white border border-gray-200 shadow-sm text-[#6e00ff] font-bold text-sm" href="/gamificacion">
                        <span class="material-symbols-outlined text-[20px]">stadia_controller</span>
                        Parámetros de Gamificación
                    </a>
                </nav>
            </div>

            <div class="flex-1 space-y-6">
                
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-[#f3ebff] p-2.5 rounded-lg text-[#6e00ff]">
                            <span class="material-symbols-outlined">emoji_events</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Niveles de Usuario</h3>
                            <p class="text-sm text-gray-500">Define los umbrales de experiencia (XP) necesarios para alcanzar cada nivel.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center font-bold text-gray-500 text-sm flex-shrink-0">Lvl 1</div>
                            <div class="flex-1">
                                <h4 class="text-gray-900 font-bold text-sm">Novato</h4>
                                <p class="text-xs text-gray-500">Nivel inicial para nuevos usuarios.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="0" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                                <span class="text-sm text-gray-400 font-medium">a</span>
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="999" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors">
                            <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center font-bold text-blue-500 text-sm flex-shrink-0">Lvl 5</div>
                            <div class="flex-1">
                                <h4 class="text-gray-900 font-bold text-sm">Aprendiz</h4>
                                <p class="text-xs text-gray-500">Usuario activo con participación regular.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="1000" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                                <span class="text-sm text-gray-400 font-medium">a</span>
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="4999" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors">
                            <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center font-bold text-purple-600 text-sm flex-shrink-0">Lvl 10</div>
                            <div class="flex-1">
                                <h4 class="text-gray-900 font-bold text-sm">Experto</h4>
                                <p class="text-xs text-gray-500">Usuario avanzado con privilegios de moderación.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="5000" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                                <span class="text-sm text-gray-400 font-medium">a</span>
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="9999" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors">
                            <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center font-bold text-orange-500 text-sm flex-shrink-0">Lvl 20</div>
                            <div class="flex-1">
                                <h4 class="text-gray-900 font-bold text-sm">Maestro</h4>
                                <p class="text-xs text-gray-500">Nivel máximo, acceso a beta features.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="10000" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                </div>
                                <span class="text-sm text-gray-400 font-medium">a</span>
                                <div class="relative w-24">
                                    <span class="absolute left-3 top-2.5 text-xs font-bold text-gray-400">XP</span>
                                    <input type="text" value="∞" class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]" disabled>
                                </div>
                            </div>
                        </div>

                        <button class="w-full py-4 mt-2 border-2 border-dashed border-[#d9baff] rounded-xl text-[#6e00ff] font-bold text-sm hover:bg-[#f3ebff] transition flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Añadir Nuevo Nivel
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-orange-50 p-2.5 rounded-lg text-orange-500">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Dificultad de Racha</h3>
                            <p class="text-sm text-gray-500">Define cuántas tareas son necesarias para mantener la llama encendida.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 max-w-sm">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Mínimo Diario</label>
                        <div class="relative mb-2">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            </span>
                            <input type="number" value="3" class="w-full pl-12 pr-16 py-3 bg-white border border-gray-200 rounded-lg text-base font-bold text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                            <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-xs font-semibold text-gray-400">tareas</span>
                        </div>
                        <p class="text-[0.65rem] text-gray-500">Número de tareas para contar el día como activo.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="bg-[#f3ebff] p-2.5 rounded-lg text-[#6e00ff]">
                                <span class="material-symbols-outlined">verified</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Creador de Medallas</h3>
                                <p class="text-sm text-gray-500">Define los detonadores para desbloquear nuevas insignias.</p>
                            </div>
                        </div>
                        <button class="px-3 py-1.5 border border-[#d9baff] text-[#6e00ff] rounded-lg text-xs font-bold hover:bg-[#f3ebff] transition">
                            + Nueva Regla
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start justify-between p-4 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-gray-200 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined">wb_sunny</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm mb-0.5">Madrugador Productivo</h4>
                                    <p class="text-xs text-[#6e00ff] font-semibold mb-3">Medalla Rara</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-[0.65rem] font-medium text-gray-600">Trigger: Completar Tarea</span>
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-[0.65rem] font-medium text-gray-600">Condición: Cantidad > 10</span>
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-[0.65rem] font-medium text-gray-600">Límite: Antes de 9:00 AM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2 text-gray-400">
                                <button class="hover:text-gray-700 transition"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                <button class="hover:text-red-500 transition"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                            </div>
                        </div>

                        <div class="flex items-start justify-between p-4 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-gray-200 transition-colors">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined">bolt</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm mb-0.5">Imparable</h4>
                                    <p class="text-xs text-[#6e00ff] font-semibold mb-3">Medalla Épica</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-[0.65rem] font-medium text-gray-600">Trigger: Racha Diaria</span>
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-[0.65rem] font-medium text-gray-600">Condición: Días > 30</span>
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-[0.65rem] font-medium text-gray-600">Sin fallos</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2 text-gray-400">
                                <button class="hover:text-gray-700 transition"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                <button class="hover:text-red-500 transition"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
        
        <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-full flex flex-col overflow-hidden animate-fade-in-up">
            
            <div class="flex justify-between items-start p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="text-[#6e00ff]">
                        <span class="material-symbols-outlined text-[24px]">workspace_premium</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Nueva Insignia</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Configura los detalles y previsualiza cómo se verá en el perfil.</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="flex flex-col md:flex-row flex-1 overflow-y-auto">
                
                <div class="flex-1 p-6 md:p-8 space-y-8">
                    
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-[#6e00ff] text-[18px]">sort</span>
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Información Básica</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-1.5">Nombre de la Medalla</label>
                                <input type="text" value="Cazador de Bugs" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-1.5">Descripción</label>
                                <textarea class="w-full h-20 px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition resize-none">Reporta y verifica 5 errores críticos en el sistema.</textarea>
                                <p class="text-[0.65rem] text-gray-400 text-right mt-1">0/120 caracteres</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-1.5">Icono (Material Symbol)</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <span class="material-symbols-outlined text-[18px]">pest_control</span>
                                        </span>
                                        <input type="text" value="pest_control" class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] transition">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-900 mb-1.5">Categoría</label>
                                    <div class="relative">
                                        <select class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] appearance-none cursor-pointer">
                                            <option>General</option>
                                            <option selected>Técnico</option>
                                            <option>Social</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                            <span class="material-symbols-outlined text-[18px]">expand_more</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-[#6e00ff] text-[18px]">settings_ethernet</span>
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Lógica</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-1.5">Disparador (Trigger)</label>
                                <div class="relative">
                                    <select class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff] appearance-none cursor-pointer">
                                        <option selected>Acumulación de Acciones</option>
                                        <option>Logro Único</option>
                                        <option>Racha Sostenida</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <span class="material-symbols-outlined text-[18px]">expand_more</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl space-y-3">
                                <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                                    <span class="text-xs font-semibold text-gray-500">Acción Requerida:</span>
                                    <span class="text-sm font-bold text-gray-900">Reporte de Bug</span>
                                </div>
                                <div class="flex justify-between items-center pt-1">
                                    <span class="text-xs font-semibold text-gray-500">Cantidad:</span>
                                    <input type="number" value="5" class="w-20 px-3 py-1 bg-white border border-gray-200 rounded text-sm text-center focus:outline-none focus:border-[#6e00ff]">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-full md:w-[400px] bg-[#faf8fc] p-6 md:p-8 flex flex-col items-center justify-center border-l border-gray-100">
                    <h3 class="text-base font-bold text-gray-900 mb-1">Vista Previa</h3>
                    <p class="text-xs text-gray-500 mb-8">Así verá el usuario su nueva insignia</p>

                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-w-[280px] p-6 flex flex-col items-center text-center relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#d9baff] via-[#6e00ff] to-[#d9baff]"></div>

                        <div class="w-24 h-24 rounded-full bg-[#f3ebff] border-4 border-[#e9d5ff] flex items-center justify-center mb-4 mt-2">
                            <span class="material-symbols-outlined text-[#6e00ff] text-[40px]">pest_control</span>
                        </div>

                        <span class="px-2.5 py-0.5 bg-[#f3ebff] text-[#6e00ff] text-[0.6rem] font-black uppercase tracking-widest rounded-full mb-3">Épica</span>

                        <h4 class="text-lg font-black text-gray-900 mb-2 leading-tight">Cazador de Bugs</h4>
                        <p class="text-[0.7rem] text-gray-500 leading-relaxed px-2">Reporta y verifica 5 errores críticos en el sistema.</p>

                        <div class="mt-6 pt-4 border-t border-gray-50 w-full flex justify-center items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            <span class="text-xs font-bold text-emerald-600">+ 250 XP</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex justify-end items-center gap-3 p-6 border-t border-gray-100 bg-white">
                <button class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    Cancelar
                </button>
                <button class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Guardar Insignia
                </button>
            </div>
        </div>
    </div>



<div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
        
        <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-full flex flex-col overflow-hidden animate-fade-in-up">
            
            <div class="flex justify-between items-start p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="text-[#6e00ff]">
                        <span class="material-symbols-outlined text-[24px]">unfold_more</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Nuevo Nivel</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Define los requisitos y recompensas para el siguiente hito.</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="flex flex-col md:flex-row flex-1 overflow-y-auto">
                
                <div class="flex-1 p-6 md:p-8 space-y-6">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-[#6e00ff] text-[18px]">reorder</span>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Parámetros del Nivel</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-1.5">Número del Nivel</label>
                            <input type="text" value="Nvl 51" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-1.5">XP Requerida</label>
                            <div class="relative">
                                <input type="number" value="25000" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-300">XP</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-1.5">Título de Rango</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <span class="material-symbols-outlined text-[18px]">military_tech</span>
                            </span>
                            <input type="text" value="Maestro del Enfoque" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-900 focus:outline-none focus:border-[#6e00ff] focus:ring-1 focus:ring-[#6e00ff]">
                        </div>
                        <p class="text-[0.65rem] text-gray-400 mt-1.5 italic">Este título aparecerá debajo del nombre del usuario.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-1.5">Color del Nivel (Hex)</label>
                        <div class="flex gap-2">
                            <div class="w-10 h-10 rounded-lg bg-[#7f0df2] shadow-inner flex-shrink-0"></div>
                            <input type="text" value="#7F0DF2" class="flex-1 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm font-mono text-gray-900 focus:outline-none focus:border-[#6e00ff]">
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-[450px] bg-[#faf8fc] p-6 md:p-8 border-l border-gray-100">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-[#6e00ff] text-[18px]">card_giftcard</span>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Recompensa por Nivel</h3>
                    </div>

                    <p class="text-[0.7rem] text-gray-500 mb-4 leading-relaxed">Selecciona qué desbloquea el usuario al alcanzar este nivel.</p>

                    <div class="grid grid-cols-2 gap-3 mb-8">
                        <div class="p-4 bg-white border-2 border-[#6e00ff] rounded-xl flex flex-col items-center text-center relative cursor-pointer group">
                            <div class="absolute top-2 right-2 text-[#6e00ff]">
                                <span class="material-symbols-outlined text-[16px] fill-1">check_circle</span>
                            </div>
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center mb-2">
                                <span class="material-symbols-outlined text-[20px]">workspace_premium</span>
                            </div>
                            <span class="text-[0.75rem] font-black text-gray-900">Insignia Especial</span>
                            <span class="text-[0.6rem] text-gray-400 font-bold mt-1 uppercase tracking-tighter">Logro único</span>
                        </div>

                        <div class="p-4 bg-white border-2 border-transparent hover:border-gray-200 rounded-xl flex flex-col items-center text-center cursor-pointer transition-all">
                            <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-lg flex items-center justify-center mb-2">
                                <span class="material-symbols-outlined text-[20px]">local_fire_department</span>
                            </div>
                            <span class="text-[0.75rem] font-black text-gray-400 group-hover:text-gray-900">Icono de Racha</span>
                            <span class="text-[0.6rem] text-gray-400 font-bold mt-1 uppercase tracking-tighter">Personalización</span>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                        <div class="flex justify-between items-center text-[0.7rem] font-bold text-gray-400 uppercase tracking-widest mb-2">
                            <span>Seleccionar Insignia</span>
                        </div>
                        
                        <div class="flex justify-between gap-2">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg border-2 border-[#6e00ff] text-[#6e00ff] bg-[#f3ebff] cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">emoji_events</span>
                            </div>
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-100 text-gray-300 hover:border-gray-300 cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">star</span>
                            </div>
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-100 text-gray-300 hover:border-gray-300 cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">diamond</span>
                            </div>
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-100 text-gray-300 hover:border-gray-300 cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">king_bed</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[0.7rem] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Nombre de la Insignia</label>
                            <input type="text" value="Defensor del Reino" class="w-full px-3 py-2 bg-gray-50 border border-gray-100 rounded text-xs font-bold text-gray-700 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center gap-3 p-6 border-t border-gray-100 bg-white">
                <button class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    Cancelar
                </button>
                <button class="flex items-center gap-2 px-6 py-2.5 bg-[#6e00ff] text-white rounded-lg text-sm font-bold hover:bg-[#5a00d1] shadow-md transition-all">
                    Publicar Nivel
                </button>
            </div>
        </div>
    </div>

@endsection