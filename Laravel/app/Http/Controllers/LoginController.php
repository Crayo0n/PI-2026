<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        // Si ya hay sesión activa, redirigir al dashboard
        if (session('admin_user')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo'   => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        // Llamar al endpoint de login en FastAPI
        $response = ApiService::post('/usuarios/login', [
            'correo'   => $request->correo,
            'password' => $request->password,
        ]);

        if ($response->status() === 401) {
            return back()->with('error', 'Credenciales incorrectas. Verifica tu correo y contraseña.');
        }

        if ($response->status() === 403) {
            return back()->with('error', 'Acceso denegado. Esta cuenta no tiene privilegios de administrador.');
        }

        if (!$response->successful()) {
            return back()->with('error', 'Error de conexión con el servidor. Intenta de nuevo.');
        }

        // Guardar datos del admin en sesión
        $user = $response->json();
        session([
            'admin_user' => $user,
            'admin_id'   => $user['id'],
            'admin_nombre' => $user['nombre_usuario'],
            'admin_rol'  => $user['rol'],
        ]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
