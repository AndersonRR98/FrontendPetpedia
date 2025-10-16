<?php

use App\Http\Controllers\FrontAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VeterinaryController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ==========================================================
// RUTAS PÚBLICAS / INICIO Y AUTENTICACIÓN
// ==========================================================

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Autenticación
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [FrontAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [FrontAuthController::class, 'login']);
    Route::get('/register', [FrontAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [FrontAuthController::class, 'register']);
});

// ----------------------------------------------------------
// ➡️ PRODUCTOS PÚBLICOS (ACCESIBLES SIN LOGIN)
// ----------------------------------------------------------
Route::prefix('productos')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
});


// ==========================================================
// RUTAS PROTEGIDAS Y DE SESIÓN (Requieren middleware 'web')
// ==========================================================
// Aunque 'web' se aplica a todas las rutas, lo usamos aquí para agrupar las funcionalidades que dependen de la sesión.
Route::middleware(['web'])->group(function () { 
    
    // ----------------------------------------------------------
    // ➡️ CARRITO Y CHECKOUT
    // ----------------------------------------------------------
    
    // Carrito (Visualización y Acciones)
    Route::prefix('carrito')->group(function () {
        Route::get('/', [ProductController::class, 'cartIndex'])->name('cart.index');
        Route::post('/add', [ProductController::class, 'addToCart'])->name('cart.add'); 
        
        // Usando POST para simular PUT/DELETE en formularios HTML:
        // Eliminar Item
        Route::post('/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove'); 
        // Actualizar Cantidad
        Route::post('/update/{id}', [ProductController::class, 'updateCartItem'])->name('cart.update'); 
        
        // Vaciar todo el carrito (usando POST)
        Route::post('/clear', [ProductController::class, 'clearCart'])->name('cart.clear'); 
    });

    // Checkout (Proceso de Pago)
    Route::get('/checkout', [ProductController::class, 'checkoutIndex'])->name('checkout.index');
    Route::post('/checkout/process', [ProductController::class, 'processPayment'])->name('checkout.process');
    
    // ----------------------------------------------------------
    // ➡️ RUTAS DE USUARIO AUTENTICADO (Requieren middleware 'auth')
    // ----------------------------------------------------------
    Route::middleware(['auth'])->group(function () {
        
        // Dashboard principal
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Logout
        Route::post('/logout', [FrontAuthController::class, 'logout'])->name('logout');
        
        // Mi Perfil
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
        
        // Dashboards según Rol
        Route::view('/cliente/dashboard', 'roles.cliente')->name('cliente.dashboard');
        Route::get('/veterinario/dashboard', [VeterinaryController::class, 'dashboard'])->name('veterinario.dashboard');
        Route::view('/entrenador/dashboard', 'roles.entrenador')->name('entrenador.dashboard');
        Route::view('/refugio/dashboard', 'roles.refugio')->name('refugio.dashboard');
        
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

        // Adopciones
        Route::get('/adopciones', [AdoptionController::class, 'index'])->name('adopciones');
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
});
