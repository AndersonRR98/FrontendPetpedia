<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckApiSession;


// Página principal
Route::get('/', function () {
    return view('home');
});

// Login y registro
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [FrontAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [FrontAuthController::class, 'login']);
    Route::get('/register', [FrontAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [FrontAuthController::class, 'register']);
});

// Logout
Route::post('/logout', [FrontAuthController::class, 'logout'])->name('logout');


Route::view('/cliente/dashboard', 'roles.cliente');
Route::view('/veterinario/dashboard', 'roles.veterinario');
Route::view('/entrenador/dashboard', 'roles.entrenador');
Route::view('/refugio/dashboard', 'roles.refugio');


Route::middleware([CheckApiSession::class])->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    // Citas
    Route::get('/citas', [AppointmentController::class, 'index'])->name('citas.index');
    Route::post('/citas', [AppointmentController::class, 'store'])->name('citas.store');
    Route::post('/citas-trainer', [AppointmentController::class, 'storeTrainer'])->name('citas.storeTrainer');

    // Adopciones
    Route::get('/adopciones', [AdoptionController::class, 'index'])->name('adopciones.index');
    Route::post('/adopciones', [AdoptionController::class, 'store'])->name('adopciones.store');

    // Productos y carrito
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::post('/carrito/agregar', [ProductController::class, 'addToCart'])->name('products.addToCart');
    });

    Route::get('/carrito', [ProductController::class, 'cart'])->name('products.cart');
    Route::post('/carrito/guardar', [ProductController::class, 'storeCart'])->name('products.storeCart');

    // Pedidos
       Route::get('/pedidos', [ProductController::class, 'myOrders'])->name('products.myOrders');

    // Perfil
    Route::prefix('perfil')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/actualizar', [ProfileController::class, 'update'])->name('profile.update');
    });
});
