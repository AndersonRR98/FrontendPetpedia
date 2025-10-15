<?php

use App\Http\Controllers\FrontAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VeterinaryController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ProfileController; // ⬅️ Controlador de Perfil general
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Autenticación (usando layout guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [FrontAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [FrontAuthController::class, 'login']);
    Route::get('/register', [FrontAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [FrontAuthController::class, 'register']);
});

// Rutas Protegidas (usando layout app)
// Asegúrate de que tu middleware 'web' o el que uses para rutas protegidas
// incluye el control de autenticación y la gestión de la sesión.
Route::middleware(['web'])->group(function () {
    
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Logout
    Route::post('/logout', [FrontAuthController::class, 'logout'])->name('logout');
    
    // ==========================================================
    // ➡️ APARTADO MI PERFIL (Rutas genéricas para cualquier usuario)
    // ==========================================================
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // ✅ CORRECCIÓN: Se cambió de Route::post a Route::put para coincidir con el formulario
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
    
    // ==========================================================
    // ➡️ DASHBOARDS SEGÚN ROL (Solo para vistas o lógica específica)
    // ==========================================================
    Route::view('/cliente/dashboard', 'roles.cliente')->name('cliente.dashboard');
    Route::get('/veterinario/dashboard', [VeterinaryController::class, 'dashboard'])->name('veterinario.dashboard');
    // Las rutas de perfil de veterinario están centralizadas en /profile
    
    Route::view('/entrenador/dashboard', 'roles.entrenador')->name('entrenador.dashboard');
    Route::view('/refugio/dashboard', 'roles.refugio')->name('refugio.dashboard');
    
    // ==========================================================
    // ➡️ OTRAS RUTAS DE LA APLICACIÓN
    // ==========================================================
    
    // Veterinarias
    Route::prefix('veterinarias')->group(function () {
        Route::get('/', [VeterinaryController::class, 'index'])->name('veterinarias.index');
        Route::get('/{id}', [VeterinaryController::class, 'show'])->name('veterinarias.show');
    });
    
    // Entrenadores
    Route::prefix('entrenadores')->group(function () {
        Route::get('/', [TrainerController::class, 'index'])->name('entrenadores.index');
        Route::get('/{id}', [TrainerController::class, 'show'])->name('entrenadores.show');
    });
    
    // Refugios
    Route::prefix('refugios')->group(function () {
        Route::get('/', [ShelterController::class, 'index'])->name('refugios.index');
        Route::get('/{id}', [ShelterController::class, 'show'])->name('refugios.show');
    });

    // Adopciones - Ruta principal con alias 'adopciones'
    Route::get('/adopciones', [AdoptionController::class, 'index'])->name('adopciones');
    
    // Adopciones - Rutas adicionales
    Route::prefix('adopciones')->group(function () {
        Route::get('/mis-solicitudes', [AdoptionController::class, 'myAdoptions'])->name('adopciones.mis-solicitudes');
        Route::get('/{id}', [AdoptionController::class, 'show'])->name('adopciones.show');
        Route::post('/{id}/adopt', [AdoptionController::class, 'adopt'])->name('adopciones.adopt');
    });

    // Citas
    Route::prefix('citas')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->name('citas.index');
        Route::get('/create', [AppointmentController::class, 'create'])->name('citas.create');
        Route::post('/', [AppointmentController::class, 'store'])->name('citas.store');
        Route::get('/{id}', [AppointmentController::class, 'show'])->name('citas.show');
        Route::delete('/{id}', [AppointmentController::class, 'destroy'])->name('citas.destroy');
    });
});