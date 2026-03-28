<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GamificacionController;

Route::get('/', fn() => redirect('/dashboard'));

// ─── Rutas Públicas
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ─── Rutas Protegidas
Route::middleware('admin.auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analitica', [DashboardController::class, 'analitica'])->name('analitica');
    Route::get('/analitica/exportar', [DashboardController::class, 'exportar'])->name('analitica.exportar');

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

    Route::get('/niveles', [NivelController::class, 'index'])->name('niveles.index');
    Route::post('/niveles', [NivelController::class, 'store'])->name('niveles.store');

    Route::get('/configuracion', fn() => view('config.configuracion'))->name('configuracion');
    Route::get('/seguridad', fn() => view('config.seguridad'))->name('seguridad');
    Route::get('/notificaciones', fn() => view('config.notificaciones'))->name('notificaciones');
    Route::get('/gamificacion', [GamificacionController::class, 'index'])->name('gamificacion');

    // Proxy JSON: crear nivel
    Route::post('/api/gamificacion/nivel', [GamificacionController::class, 'storeNivel'])->name('gamificacion.nivel');

    // Proxy JSON: crear medalla
    Route::post('/api/gamificacion/medalla', [GamificacionController::class, 'storeMedalla'])->name('gamificacion.medalla');

    // Proxy JSON: eliminar nivel
    Route::delete('/api/gamificacion/nivel/{id}', [GamificacionController::class, 'destroyNivel'])->name('gamificacion.nivel.destroy');

    // Proxy JSON: eliminar medalla
    Route::delete('/api/gamificacion/medalla/{id}', [GamificacionController::class, 'destroyMedalla'])->name('gamificacion.medalla.destroy');

    // Proxy JSON: stats para sidebar de configuración
    Route::get('/api/config/stats', function () {
        $res = \App\Services\ApiService::get('/analitica/dashboard');
        return $res->successful()
            ? response()->json($res->json())
            : response()->json([], 503);
    })->name('config.stats');

    // Proxy JSON: logs (últimas notificaciones)
    Route::get('/api/config/logs', function () {
        $res = \App\Services\ApiService::get('/notificaciones/', ['limit' => 20]);
        return $res->successful()
            ? response()->json($res->json())
            : response()->json([], 503);
    })->name('config.logs');

    // Proxy JSON: usuarios recientes para seguridad
    Route::get('/api/config/usuarios-recientes', function () {
        $res = \App\Services\ApiService::get('/usuarios/');
        return $res->successful()
            ? response()->json($res->json())
            : response()->json([], 503);
    })->name('config.usuarios');

    // Proxy: enviar alerta del sistema a FastAPI
    Route::post('/api/alerta', function (\Illuminate\Http\Request $request) {
        $response = \App\Services\ApiService::post('/notificaciones/', [
            'usuario_id' => $request->input('usuario_id', 1),
            'mensaje'    => $request->input('mensaje'),
        ]);
        return response()->json(['ok' => $response->successful()], $response->status());
    })->name('api.alerta');
});
