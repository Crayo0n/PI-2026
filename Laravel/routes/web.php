<?php

use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/usuarios', function () {
    return view('dashboard.usuarios');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/analitica', function () {
    return view('dashboard.analitica');
});

Route::get('/configuracion', function () {
    return view('config.configuracion');
});

Route::get('/seguridad', function () {
    return view('config.seguridad');
});

Route::get('/notificaciones', function () {
    return view('config.notificaciones');
});

Route::get('/gamificacion', function () {
    return view('config.gamificacion');
});

