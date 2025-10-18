@extends('layouts.app')

@section('title', 'Mi Perfil - PetPedia')

@section('content')
@php
    // Datos del usuario con su perfil anidado
    $user = session('user');
@endphp

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 border-b pb-2">
        Configuración del Perfil
    </h1>

    <div class="bg-white shadow-xl rounded-xl p-8">

        {{-- Mensajes --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
                <p class="font-bold">¡Éxito!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
                <p class="font-bold">Error:</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
                <p class="font-bold">Errores al guardar:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORMULARIO DE PERFIL --}}
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- DATOS DE CUENTA --}}
            <h2 class="text-xl font-semibold text-indigo-600 mb-4 border-b pb-1">Datos de Cuenta</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name"
                           value="{{ old('name', $user['name'] ?? '') }}"
                           class="mt-1 block w-full border rounded-md p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type="email" name="email"
                           value="{{ old('email', $user['email'] ?? '') }}"
                           class="mt-1 block w-full border rounded-md p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                           required>
                </div>
            </div>

            {{-- INFORMACIÓN ADICIONAL --}}
            <h2 class="text-xl font-semibold text-indigo-600 mt-8 mb-4 border-b pb-1">Información adicional</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $user['profile']['phone'] ?? '') }}"
                           class="mt-1 block w-full border rounded-md p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ingresa tu número de teléfono">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="address"
                           value="{{ old('address', $user['profile']['address'] ?? '') }}"
                           class="mt-1 block w-full border rounded-md p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ej: Calle 123 #45-67">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700">Biografía</label>
                <textarea name="biography" rows="4"
                          class="mt-1 block w-full border rounded-md p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Cuéntanos un poco sobre ti...">{{ old('biography', $user['profile']['biography'] ?? '') }}</textarea>
            </div>

            {{-- BOTÓN GUARDAR --}}
            <div class="mt-8 flex justify-end">
                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
