<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\ChatbotController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

// Autenticación
Route::get('/auth/social/email', [AuthController::class, 'showEmailForm'])->name('social.email.form');
Route::post('/auth/social/email', [AuthController::class, 'storeEmail'])->name('social.email.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redes sociales
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('auth.callback');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Dentro del grupo auth:
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========== RECURSOS CRUD COMPLETOS ==========
    // Pacientes
    Route::resource('pacientes', PacienteController::class);

    // Médicos
    Route::resource('medicos', MedicoController::class);

    // Citas
    Route::resource('citas', CitaController::class);

    // Diagnósticos
    Route::resource('diagnosticos', DiagnosticoController::class);

    // Tratamientos
    Route::resource('tratamientos', TratamientoController::class);

    // Medicamentos
    Route::resource('medicamentos', MedicamentoController::class);

});

Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
