<?php

use Illuminate\Support\Facades\Route;

// Ruta principal para la Landing Page de Bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Ruta de previsualización para tu Dashboard Ultra Profesional
Route::get('/welcome', function () {
    return view('welcome');
});