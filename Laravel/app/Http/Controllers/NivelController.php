<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index()
    {
        // Fetch niveles from the FastAPI backend
        $response = ApiService::get('/niveles');
        $niveles = $response->successful() ? $response->json() : [];

        // Return view with data
        return view('niveles.index', compact('niveles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_nivel' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'xp_requerida' => 'required|integer',
            'color_hex' => 'required|string|max:7',
        ]);

        $response = ApiService::post('/niveles', $request->all());

        if ($response->successful()) {
            return redirect()->route('niveles.index')->with('success', 'Nivel añadido satisfactoriamente desde la API.');
        }

        return back()->with('error', 'Error reportado por FastAPI al crear el nivel.');
    }
}
