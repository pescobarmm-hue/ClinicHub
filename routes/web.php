<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redes sociales (solo una vez cada una)
// Autenticación con redes sociales
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('auth.callback');
// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/pacientes', fn() => view('pacientes.index'))->name('pacientes');
    Route::get('/citas', fn() => view('citas.index'))->name('citas');
    Route::get('/diagnosticos', fn() => view('diagnosticos.index'))->name('diagnosticos');
    Route::get('/tratamientos', fn() => view('tratamientos.index'))->name('tratamientos');
    Route::get('/medicamentos', fn() => view('medicamentos.index'))->name('medicamentos');
    Route::get('/medicos', fn() => view('medicos.index'))->name('medicos');
});

Route::get('/welcome', fn() => redirect()->route('home'));
