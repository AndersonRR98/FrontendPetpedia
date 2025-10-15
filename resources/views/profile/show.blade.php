@extends('layouts.app') {{-- Asegúrate de usar el nombre correcto de tu layout --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 border-b pb-2">Configuración del Perfil</h1>

    <div class="bg-white shadow-xl rounded-xl p-8">
        
        {{-- ==================== MENSAJES DE ESTADO ==================== --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">¡Éxito!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">¡Error al Guardar!</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- ============================================================= --}}
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            {{-- Necesario para que Laravel interprete la solicitud POST como PUT/PATCH --}}
            @method('PUT') 

            {{-- 1. DATOS BÁSICOS --}}
            <h2 class="text-xl font-semibold text-indigo-600 mb-4 border-b pb-1">Datos de Cuenta</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- CAMPO NOMBRE --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $user['name'] ?? '') }}"
                           required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- CAMPO EMAIL --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $user['email'] ?? '') }}"
                           required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- 2. DATOS DE PERFIL (Condicionales, pero mostrados por defecto si existen en DB) --}}
            @php
                // Se asume que si el usuario tiene un role_id, el campo existe, 
                // pero si el rol NO es Cliente (ID 3, según tu migración), mostramos más campos.
                $roleId = $user['role_id'] ?? 3;
                $showProfileFields = ($roleId != 3); 
            @endphp
            
            {{-- Puedes quitar la condición ($showProfileFields) si quieres que todos los campos sean visibles para todos los roles --}}
            @if ($showProfileFields)
            
                <h2 class="text-xl font-semibold text-indigo-600 mt-8 mb-4 border-b pb-1">Información Profesional</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- CAMPO TELÉFONO --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" id="phone" name="phone" 
                               value="{{ old('phone', $user['phone'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('phone') border-red-500 @enderror">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- CAMPO DIRECCIÓN --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" id="address" name="address" 
                               value="{{ old('address', $user['address'] ?? '') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror">
                        @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- CAMPO BIOGRAFÍA (Ocupa todo el ancho) --}}
                <div class="mt-6">
                    <label for="biography" class="block text-sm font-medium text-gray-700">Biografía/Descripción</label>
                    <textarea id="biography" name="biography" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2.5 focus:border-indigo-500 focus:ring-indigo-500 @error('biography') border-red-500 @enderror">{{ old('biography', $user['biography'] ?? '') }}</textarea>
                    @error('biography') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            @endif
            
            {{-- 3. BOTÓN DE ENVÍO --}}
            <div class="mt-8 flex justify-end">
                <button type="submit"
                        class="px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection