<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Fetch All Users globally from FastAPI
        $response = ApiService::get('/usuarios');
        $usuarios = $response->successful() ? $response->json() : [];

        // Return View
        return view('dashboard.usuarios', compact('usuarios'));
    }
}
