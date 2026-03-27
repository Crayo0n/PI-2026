<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Analítica — Priority Pulse</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #fff;
            color: #1a1a2e;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ---- Pantalla: botón de imprimir ---- */
        .print-toolbar {
            background: #6e00ff;
            color: white;
            padding: 12px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .print-toolbar h1 { font-size: 15px; font-weight: 700; }
        .btn-print {
            background: white;
            color: #6e00ff;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn-print:hover { background: #f3ebff; }

        /* ---- Contenido del reporte ---- */
        .report { max-width: 900px; margin: 32px auto; padding: 0 24px 48px; }

        /* Encabezado */
        .report-header {
            border-bottom: 3px solid #6e00ff;
            padding-bottom: 16px;
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .report-header .brand { font-size: 22px; font-weight: 900; color: #6e00ff; letter-spacing: -1px; }
        .report-header .meta { font-size: 11px; color: #888; text-align: right; }

        /* Secciones */
        h2.section-title {
            font-size: 14px;
            font-weight: 800;
            color: #6e00ff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 28px 0 12px;
            padding-bottom: 6px;
            border-bottom: 1px solid #ede0ff;
        }

        /* Grilla de KPIs */
        .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 8px; }
        .kpi-card {
            background: #faf8ff;
            border: 1px solid #ede0ff;
            border-radius: 10px;
            padding: 14px;
            text-align: center;
        }
        .kpi-card .val { font-size: 22px; font-weight: 900; color: #6e00ff; }
        .kpi-card .lbl { font-size: 10px; color: #888; font-weight: 600; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.3px; }

        /* Tabla de análisis */
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        thead th {
            background: #6e00ff;
            color: white;
            padding: 8px 12px;
            text-align: left;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
        }
        tbody tr:nth-child(even) { background: #faf8ff; }
        tbody td { padding: 8px 12px; border-bottom: 1px solid #f0e8ff; }
        tbody td.num { text-align: right; font-weight: 700; color: #6e00ff; }

        /* Barra horizontal */
        .bar-row { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
        .bar-label { width: 80px; font-size: 11px; font-weight: 700; text-align: right; flex-shrink: 0; color: #555; }
        .bar-track { flex: 1; background: #f0e8ff; border-radius: 4px; height: 18px; }
        .bar-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, #6e00ff, #9b51e0); display: flex; align-items: center; justify-content: flex-end; padding-right: 6px; }
        .bar-fill span { font-size: 10px; font-weight: 800; color: white; }
        .bar-num { width: 36px; font-size: 11px; font-weight: 700; color: #444; }

        /* Alertas */
        .alert-box {
            background: #fff8f0;
            border-left: 4px solid #f97316;
            padding: 10px 14px;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .alert-box .alert-title { font-weight: 800; color: #c2410c; font-size: 12px; }

        /* Footer */
        .report-footer {
            margin-top: 40px;
            border-top: 1px solid #ede0ff;
            padding-top: 12px;
            font-size: 10px;
            color: #aaa;
            display: flex;
            justify-content: space-between;
        }

        /* Print overrides */
        @media print {
            .print-toolbar { display: none !important; }
            .report { margin: 0; max-width: 100%; }
            body { font-size: 12px; }
            .kpi-grid { grid-template-columns: repeat(4, 1fr); }
            @page { margin: 16mm 14mm; }
        }
    </style>
</head>
<body>

<!-- Barra solo visible en pantalla -->
<div class="print-toolbar">
    <h1>📊 Reporte de Analítica — Priority Pulse</h1>
    <button class="btn-print" onclick="window.print()">⬇ Descargar / Imprimir PDF</button>
</div>

<div class="report">

    <!-- Encabezado -->
    <div class="report-header">
        <div>
            <div class="brand">Priority Pulse</div>
            <div style="font-size:12px;color:#555;margin-top:2px;">Panel Administrativo — Reporte de Analítica</div>
        </div>
        <div class="meta">
            Generado el: {{ now()->format('d/m/Y H:i') }}<br>
            Administrador: {{ session('admin_nombre', 'Admin') }}<br>
            Período: Acumulado histórico
        </div>
    </div>

    <!-- ====== 1. KPIs GLOBALES ====== -->
    <h2 class="section-title">1. Indicadores Clave de Desempeño (KPIs)</h2>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="val">{{ $stats ? number_format($stats['total_usuarios']) : '—' }}</div>
            <div class="lbl">Usuarios Totales</div>
        </div>
        <div class="kpi-card">
            <div class="val">{{ $stats ? number_format($stats['total_tareas']) : '—' }}</div>
            <div class="lbl">Tareas Totales</div>
        </div>
        <div class="kpi-card">
            <div class="val">{{ $stats ? number_format($stats['xp_total_generada']) : '—' }}</div>
            <div class="lbl">XP Total Generada</div>
        </div>
        <div class="kpi-card">
            <div class="val">{{ $stats ? $stats['racha_promedio'] : '—' }} d</div>
            <div class="lbl">Racha Promedio</div>
        </div>
        <div class="kpi-card">
            <div class="val">{{ $stats ? number_format($stats['tareas_creadas_hoy']) : '—' }}</div>
            <div class="lbl">Tareas Hoy</div>
        </div>
        <div class="kpi-card">
            <div class="val">{{ $stats ? number_format($stats['medallas_desbloqueadas']) : '—' }}</div>
            <div class="lbl">Medallas Desbloqueadas</div>
        </div>
        <div class="kpi-card">
            <div class="val">{{ $stats ? number_format($stats['total_medallas_catalogo']) : '—' }}</div>
            <div class="lbl">Tipos de Medalla</div>
        </div>
        <div class="kpi-card">
            @php
                $xpPorUsuario = ($stats && $stats['total_usuarios'] > 0)
                    ? round($stats['xp_total_generada'] / $stats['total_usuarios'])
                    : 0;
            @endphp
            <div class="val">{{ number_format($xpPorUsuario) }}</div>
            <div class="lbl">XP por Usuario</div>
        </div>
    </div>

    <!-- ====== 2. ANÁLISIS DE DISTRIBUCIÓN POR NIVEL ====== -->
    <h2 class="section-title">2. Distribución y Retención por Nivel</h2>

    @if($stats && count($stats['niveles_funnel']) > 0)
        @php $base = $stats['niveles_funnel'][0]['total_usuarios'] ?? 1; @endphp

        @foreach($stats['niveles_funnel'] as $i => $nivel)
        @php
            $ancho = $base > 0 ? round($nivel['total_usuarios'] / $base * 100) : 0;
            $ancho = max($ancho, 2);
        @endphp
        <div class="bar-row">
            <div class="bar-label">{{ $nivel['rango'] }}</div>
            <div class="bar-track">
                <div class="bar-fill" style="width: {{ $ancho }}%">
                    @if($ancho > 15)<span>{{ $nivel['porcentaje'] }}%</span>@endif
                </div>
            </div>
            <div class="bar-num">{{ number_format($nivel['total_usuarios']) }}</div>
        </div>
        @endforeach

        <table style="margin-top:16px;">
            <thead>
                <tr>
                    <th>Rango de Nivel</th>
                    <th>Usuarios</th>
                    <th>% del Total</th>
                    <th>Drop-off vs. Anterior</th>
                    <th>Análisis</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['niveles_funnel'] as $i => $nivel)
                @php
                    $drop = '';
                    $analisis = 'Retención normal';
                    if ($i > 0 && isset($stats['niveles_funnel'][$i-1])) {
                        $prev = $stats['niveles_funnel'][$i-1]['total_usuarios'] ?? 0;
                        if ($prev > 0) {
                            $dropVal = round(($prev - $nivel['total_usuarios']) / $prev * 100);
                            $drop = $dropVal . '%';
                            if ($dropVal > 30) $analisis = '⚠ Drop-off alto — revisar dificultad';
                            elseif ($dropVal > 15) $analisis = 'Drop-off moderado';
                            else $analisis = 'Retención saludable';
                        }
                    } else {
                        $drop = '—';
                        $analisis = 'Nivel base (referencia)';
                    }
                @endphp
                <tr>
                    <td><strong>{{ $nivel['rango'] }}</strong></td>
                    <td class="num">{{ number_format($nivel['total_usuarios']) }}</td>
                    <td class="num">{{ $nivel['porcentaje'] }}%</td>
                    <td class="num">{{ $drop }}</td>
                    <td>{{ $analisis }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color:#aaa;font-style:italic;padding:16px 0;">Sin datos de niveles disponibles.</p>
    @endif

    <!-- ====== 3. ANÁLISIS DE GAMIFICACIÓN ====== -->
    <h2 class="section-title">3. Análisis de Gamificación</h2>

    <table>
        <thead>
            <tr>
                <th>Métrica</th>
                <th>Valor</th>
                <th>Interpretación</th>
            </tr>
        </thead>
        <tbody>
            @php
                $xpPorTarea = ($stats && $stats['total_tareas'] > 0)
                    ? round($stats['xp_total_generada'] / $stats['total_tareas'], 1)
                    : 0;
                $medallasPorUsuario = ($stats && $stats['total_usuarios'] > 0)
                    ? round($stats['medallas_desbloqueadas'] / $stats['total_usuarios'], 2)
                    : 0;
                $tasaEngagement = ($stats && $stats['total_medallas_catalogo'] > 0)
                    ? round($stats['medallas_desbloqueadas'] / ($stats['total_medallas_catalogo'] * max($stats['total_usuarios'],1)) * 100, 1)
                    : 0;
            @endphp
            <tr>
                <td>Racha promedio del sistema</td>
                <td class="num">{{ $stats['racha_promedio'] ?? '—' }} días</td>
                <td>{{ ($stats['racha_promedio'] ?? 0) >= 5 ? '✅ Engagement positivo (>5 días)' : '⚠ Bajo — revisar incentivos de racha' }}</td>
            </tr>
            <tr>
                <td>XP promedio por tarea completada</td>
                <td class="num">{{ $xpPorTarea }} XP</td>
                <td>{{ $xpPorTarea >= 10 ? '✅ Recompensa adecuada' : 'Revisar valor de recompensa por tarea' }}</td>
            </tr>
            <tr>
                <td>Medallas por usuario</td>
                <td class="num">{{ $medallasPorUsuario }}</td>
                <td>{{ $medallasPorUsuario >= 1 ? '✅ Usuarios progresando activamente' : '⚠ Baja tasa de desbloqueo' }}</td>
            </tr>
            <tr>
                <td>Tasa de engagement con medallas</td>
                <td class="num">{{ $tasaEngagement }}%</td>
                <td>{{ $tasaEngagement >= 20 ? '✅ Buena diversidad de logros' : '⚠ Gran parte del catálogo sin descubrir' }}</td>
            </tr>
            <tr>
                <td>Tareas creadas hoy</td>
                <td class="num">{{ number_format($stats['tareas_creadas_hoy'] ?? 0) }}</td>
                <td>Actividad del día — monitorear tendencias diarias</td>
            </tr>
        </tbody>
    </table>

    <!-- ====== 4. ALERTAS Y RECOMENDACIONES ====== -->
    <h2 class="section-title">4. Alertas y Recomendaciones</h2>

    @php $alertas = 0; @endphp

    @if(($stats['racha_promedio'] ?? 0) < 3)
    @php $alertas++ @endphp
    <div class="alert-box">
        <div class="alert-title">⚠ Racha promedio baja ({{ $stats['racha_promedio'] ?? 0 }} días)</div>
        <div>Los usuarios no están regresando con consistencia. Considera agregar notificaciones de "racha en peligro" o recompensas de fidelidad diaria.</div>
    </div>
    @endif

    @foreach(($stats['niveles_funnel'] ?? []) as $i => $nivel)
        @if($i > 0)
        @php
            $prev = $stats['niveles_funnel'][$i-1]['total_usuarios'] ?? 0;
            $dropVal = $prev > 0 ? round(($prev - $nivel['total_usuarios']) / $prev * 100) : 0;
        @endphp
        @if($dropVal > 30)
        @php $alertas++ @endphp
        <div class="alert-box">
            <div class="alert-title">⚠ Drop-off crítico en {{ $nivel['rango'] }} (−{{ $dropVal }}%)</div>
            <div>El {{ $dropVal }}% de usuarios no pasan de {{ $stats['niveles_funnel'][$i-1]['rango'] }} a {{ $nivel['rango'] }}. Revisar si existe una barrera de dificultad o falta de incentivos en ese tramo.</div>
        </div>
        @endif
        @endif
    @endforeach

    @if($alertas === 0)
    <div style="background:#f0fdf4;border-left:4px solid #22c55e;padding:10px 14px;border-radius:4px;font-size:12px;">
        <strong style="color:#15803d;">✅ Sistema en estado saludable.</strong> No se detectaron alertas críticas en este período.
    </div>
    @endif

    <!-- Footer -->
    <div class="report-footer">
        <span>Priority Pulse Admin — Reporte Automático</span>
        <span>Generado: {{ now()->format('d/m/Y H:i:s') }} · © {{ date('Y') }}</span>
    </div>

</div>

<script>
    // Auto-abrir diálogo de impresión al cargar la página
    window.addEventListener('load', () => {
        setTimeout(() => window.print(), 600);
    });
</script>
</body>
</html>
