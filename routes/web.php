<?php
use App\Http\Controllers\FrontAuthController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', fn() => redirect('/login'));

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
