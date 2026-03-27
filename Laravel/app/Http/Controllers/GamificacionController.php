<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class GamificacionController extends Controller
{
    public function index()
    {
        $nivelesResp  = ApiService::get('/niveles/');
        $medallaResp  = ApiService::get('/medallas/');

        $niveles  = $nivelesResp->successful()  ? $nivelesResp->json()  : [];
        $medallas = $medallaResp->successful()  ? $medallaResp->json()  : [];

        return view('config.gamificacion', compact('niveles', 'medallas'));
    }

    /** Proxy JSON: crear nivel → FastAPI POST /niveles/ */
    public function storeNivel(Request $request)
    {
        $data = $request->validate([
            'numero_nivel'  => 'required|integer|min:1',
            'nombre'        => 'required|string|max:100',
            'xp_requerida'  => 'required|integer|min:0',
            'color_hex'     => 'nullable|string|max:7',
        ]);

        $response = ApiService::post('/niveles/', $data);

        return response()->json(
            $response->successful()
                ? ['ok' => true,  'data' => $response->json()]
                : ['ok' => false, 'error' => $response->json()],
            $response->status()
        );
    }

    /** Proxy JSON: crear medalla → FastAPI POST /medallas/ */
    public function storeMedalla(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'icono'       => 'nullable|string|max:100',
        ]);

        $response = ApiService::post('/medallas/', $data);

        return response()->json(
            $response->successful()
                ? ['ok' => true,  'data' => $response->json()]
                : ['ok' => false, 'error' => $response->json()],
            $response->status()
        );
    }

    /** Proxy JSON: eliminar nivel → FastAPI DELETE /niveles/{id} */
    public function destroyNivel(int $id)
    {
        $response = ApiService::delete('/niveles/' . $id);
        return response()->json(
            ['ok' => $response->successful()],
            $response->successful() ? 200 : $response->status()
        );
    }

    /** Proxy JSON: eliminar medalla → FastAPI DELETE /medallas/{id} */
    public function destroyMedalla(int $id)
    {
        $response = ApiService::delete('/medallas/' . $id);
        return response()->json(
            ['ok' => $response->successful()],
            $response->successful() ? 200 : $response->status()
        );
    }
}
