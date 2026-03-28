<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class DashboardController extends Controller
{
    public function index()
    {
        // Llamada única y eficiente al endpoint de analítica de FastAPI
        $response = ApiService::get('/analitica/dashboard');
        $stats = $response->successful() ? $response->json() : null;

        return view('dashboard.index', compact('stats'));
    }

    public function analitica()
    {
        $statsResponse   = ApiService::get('/analitica/dashboard');
        $medallaResponse = ApiService::get('/medallas/');

        $stats   = $statsResponse->successful()   ? $statsResponse->json()   : null;
        $medallas = $medallaResponse->successful() ? $medallaResponse->json() : [];

        return view('dashboard.analitica', compact('stats', 'medallas'));
    }

    public function exportar()
    {
        $statsResponse   = ApiService::get('/analitica/dashboard');
        $medallaResponse = ApiService::get('/medallas/');

        $stats    = $statsResponse->successful()   ? $statsResponse->json()   : null;
        $medallas = $medallaResponse->successful() ? $medallaResponse->json() : [];

        return view('dashboard.reporte_pdf', compact('stats', 'medallas'));
    }
}
