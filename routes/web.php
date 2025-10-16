<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // aquí irá tu página inicial con servicios
});


Route::get('/login', [FrontAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [FrontAuthController::class, 'login']);

Route::get('/register', [FrontAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [FrontAuthController::class, 'register']);

Route::get('/logout', [FrontAuthController::class, 'logout']);

// Dashboards según rol
Route::view('/cliente/dashboard', 'roles.cliente');
Route::view('/veterinario/dashboard', 'roles.veterinario');
Route::view('/entrenador/dashboard', 'roles.entrenador');
Route::view('/refugio/dashboard', 'roles.refugio');

// Autenticación (usando layout guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [FrontAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [FrontAuthController::class, 'login']);
    Route::get('/register', [FrontAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [FrontAuthController::class, 'register']);
});

// Rutas Protegidas (usando layout app)
Route::middleware(['web'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::post('/logout', [FrontAuthController::class, 'logout'])->name('logout');
    
    // Servicios
    Route::prefix('veterinarias')->group(function () {
        Route::get('/', [VeterinaryController::class, 'index'])->name('veterinarias.index');
        Route::get('/{id}', [VeterinaryController::class, 'show'])->name('veterinarias.show');
    });
    
    Route::prefix('entrenadores')->group(function () {
        Route::get('/', [TrainerController::class, 'index'])->name('entrenadores.index');
        Route::get('/{id}', [TrainerController::class, 'show'])->name('entrenadores.show');
    });
    
    Route::prefix('refugios')->group(function () {
        Route::get('/', [ShelterController::class, 'index'])->name('refugios.index');
        Route::get('/{id}', [ShelterController::class, 'show'])->name('refugios.show');
    });

    // Rutas de Citas - SIN el namespace duplicado
    Route::get('/citas', [AppointmentController::class, 'index'])->name('citas.index');
    Route::post('/citas', [AppointmentController::class, 'store'])->name('citas.store');
    Route::get('/citas/create', [AppointmentController::class, 'create'])->name('citas.create');
    Route::get('/citas/{id}', [AppointmentController::class, 'show'])->name('citas.show');
    Route::delete('/citas/{id}', [AppointmentController::class, 'destroy'])->name('citas.destroy');

    // Rutas de Adopciones
    Route::get('/adopciones', [AdoptionController::class, 'index'])->name('adopciones.index');
    Route::post('/adopciones', [AdoptionController::class, 'store'])->name('adopciones.store');

    // === AGREGAR AQUÍ LAS RUTAS DE PRODUCTOS ===
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::post('/carrito/agregar', [ProductController::class, 'addToCart'])->name('products.addToCart');
    });
      Route::prefix('perfil')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/actualizar', [ProfileController::class, 'update'])->name('profile.update');
    });
});
