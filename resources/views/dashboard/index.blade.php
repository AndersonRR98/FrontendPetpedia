@extends('layouts.app')

@section('title', 'Dashboard - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">¡Bienvenido, {{ $user['name'] }}!</h1>
                <p class="text-xl text-indigo-100">Encuentra los mejores servicios para tu mascota</p>
            </div>
        </div>
    </div>

    <!-- Quick Access Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Veterinarias Card -->
            <a href="{{ route('veterinarias.index') }}" 
               class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition duration-300 border-t-4 border-indigo-500">
                <div class="bg-indigo-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clinic-medical text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Veterinarias</h3>
                <p class="text-gray-600 mb-6">Atención médica profesional para tu mascota</p>
                <span class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                    Explorar Veterinarias
                </span>
            </a>

            <!-- Entrenadores Card -->
            <a href="{{ route('entrenadores.index') }}" 
               class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition duration-300 border-t-4 border-green-500">
                <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-dumbbell text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Entrenadores</h3>
                <p class="text-gray-600 mb-6">Adiestramiento y comportamiento canino</p>
                <span class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-200">
                    Explorar Entrenadores
                </span>
            </a>

            <!-- Adopciones Card -->
            <a href="{{ route('adopciones.index') }}" 
               class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition duration-300 border-t-4 border-purple-500">
                <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-paw text-purple-600 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Adopciones</h3>
                <p class="text-gray-600 mb-6">Encuentra un compañero peludo para tu familia</p>
                <span class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-200">
                    Ver Mascotas
                </span>
            </a>
        </div>

       
        </div>
    </div>
</div>
@endsection