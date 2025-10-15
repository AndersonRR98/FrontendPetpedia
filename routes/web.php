<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('vistas_cliente.home'))->name('home');
Route::get('/compra', fn() => view('vistas_cliente.compra'))->name('compra');
Route::get('/veterinaria', fn() => view('vistas_cliente.veterinaria'))->name('veterinaria');
Route::get('/adopciones', fn() => view('vistas_cliente.adopciones'))->name('adopciones');
Route::get('/foro', fn() => view('vistas_cliente.foro'))->name('foro');
Route::get('/perfil', fn() => view('vistas_cliente.perfil'))->name('perfil');
Route::get('/configuracion', fn() => view('vistas_cliente.configuracion'))->name('configuracion');
