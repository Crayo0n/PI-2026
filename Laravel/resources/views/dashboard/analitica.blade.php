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
            
            <a href="{{ route('analitica.exportar') }}" target="_blank"
               class="flex items-center gap-2 px-5 py-2.5 bg-[#6e00ff] rounded-lg text-sm font-bold text-white hover:bg-[#5a00d1] transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Exportar Reporte
            </a>
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
                    <span class="text-5xl font-black">{{ $stats ? $stats['racha_promedio'] : '—' }}</span>
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
                <span class="text-4xl font-black text-gray-900">{{ $stats ? number_format($stats['xp_total_generada']) . ' XP' : '—' }}</span>
            </div>
            <div class="mt-6">
                @php
                    $xpTotal = $stats['xp_total_generada'] ?? 0;
                    $objetivo = max($stats['total_usuarios'] ?? 1, 1) * 500;
                    $pctXp = min(round($xpTotal / $objetivo * 100), 100);
                @endphp
                <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $pctXp }}%"></div>
                </div>
                <p class="text-xs text-gray-400">{{ $pctXp }}% del objetivo ({{ number_format($objetivo) }} XP meta)</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Medallas Desbloqueadas</h3>
                <span class="text-4xl font-black text-gray-900">{{ $stats ? number_format($stats['medallas_desbloqueadas']) : '—' }}</span>
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
            @php
                $coloresHeatmap = [
                    '#8b3dff','#7c2eff','#9b51e0','#b87cff',
                    '#c49aff','#6366f1','#d9baff','#e9d5ff',
                    '#93c5fd','#d8b4fe','#c4b5fd','#3b82f6',
                ];
                $iconosBase = 'M13 10V3L4 14h7v7l9-11h-7z';
            @endphp

            @if(isset($medallas) && count($medallas) > 0)
                @foreach($medallas as $i => $medalla)
                @php $color = $coloresHeatmap[$i % count($coloresHeatmap)]; @endphp
                <div class="aspect-square rounded-xl flex flex-col items-center justify-center hover:scale-105 transition cursor-pointer shadow-sm"
                     style="background-color: {{ $color }}" title="{{ $medalla['descripcion'] ?? '' }}">
                    <svg class="w-6 h-6 mb-2 {{ ($i < 8) ? 'text-white' : 'text-purple-900' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <span class="text-xs font-semibold {{ ($i < 8) ? 'text-white' : 'text-purple-900' }} text-center px-1 leading-tight">
                        {{ mb_strimwidth($medalla['nombre'], 0, 10, '..') }}
                    </span>
                </div>
                @endforeach
            @else
                <div class="col-span-6 text-center py-12 text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138"></path></svg>
                    <p class="text-sm font-semibold">No hay medallas en el catálogo todavía.</p>
                </div>
            @endif
        </div>

        <div class="mt-6 flex justify-between items-center text-xs font-semibold text-gray-400">
            <div class="flex items-center gap-3">
                <span>Menos común</span>
                <div class="w-32 h-2 rounded-full bg-gradient-to-r from-[#e9d5ff] via-[#9b51e0] to-[#3b82f6]"></div>
                <span>Más común</span>
            </div>
            <div>Total Tipos: {{ $stats['total_medallas_catalogo'] ?? 0 }}</div>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Progresión de Niveles (Embudo)</h2>
                <p class="text-xs text-gray-500 mt-1">Análisis de retención de usuarios a través de hitos de nivel.</p>
            </div>
            <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1.5 rounded-full flex items-center gap-2 border border-red-100">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Drop-off crítico en Nivel 20
            </span>
        </div>

        <div class="space-y-4">
            @php
                $funnel = $stats['niveles_funnel'] ?? [];
                $coloresFunnel = ['#8b3dff','#9b51e0','#b87cff','#d8b4fe','#3b82f6'];
                $primeraFila = $funnel[0]['total_usuarios'] ?? 1;
            @endphp

            @if(count($funnel) > 0)
                @foreach($funnel as $i => $nivel)
                    @php
                        $color = $coloresFunnel[$i] ?? '#6e00ff';
                        $textColor = ($i >= 3) ? 'text-purple-900' : 'text-white';
                        $anchoPct = $primeraFila > 0 ? round($nivel['total_usuarios'] / $primeraFila * 100) : 0;
                        $anchoPct = max($anchoPct, 8);
                        $dropoff = '';
                        if ($i > 0 && isset($funnel[$i-1])) {
                            $prevTotal = $funnel[$i-1]['total_usuarios'] ?? 0;
                            if ($prevTotal > 0) {
                                $drop = round(($prevTotal - $nivel['total_usuarios']) / $prevTotal * 100);
                                if ($drop > 0) $dropoff = '-' . $drop . '% Drop-off';
                            }
                        }
                    @endphp

                    <div class="flex items-center gap-4">
                        <div class="w-24 text-sm font-bold text-gray-700 text-right flex-shrink-0">{{ $nivel['rango'] }}</div>
                        <div class="flex-1 bg-gray-50 rounded-r-full h-10 relative flex items-center">
                            <div class="h-full flex items-center justify-end px-6 {{ $textColor }} text-xs font-bold transition-all duration-500 rounded-r-full"
                                 style="width: {{ $anchoPct }}%; background-color: {{ $color }}; clip-path: polygon(0% 0%, {{ max($anchoPct - 3, 0) }}% 0%, 100% 50%, {{ max($anchoPct - 3, 0) }}% 100%, 0% 100%)">
                                {{ $nivel['porcentaje'] }}% ({{ number_format($nivel['total_usuarios']) }})
                            </div>
                            @if($dropoff)
                                <div class="absolute ml-2 text-[0.65rem] font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded border border-red-100" style="left: {{ $anchoPct + 1 }}%">
                                    {{ $dropoff }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!$loop->last)
                    <div class="flex">
                        <div class="w-24"></div>
                        <div class="flex-1 flex justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m0 0l-3-3m3 3l3-3"></path></svg>
                        </div>
                    </div>
                    @endif
                @endforeach
            @else
                <div class="text-center py-10 text-gray-400 text-sm">No hay datos de progresión disponibles.</div>
            @endif
        </div>
    </div>

</div>
@endsection