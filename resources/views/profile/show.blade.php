@extends('layouts.app')

@section('title', 'Mi Perfil - PetPedia')

@section('content')
@php
    $user = session('user');
@endphp

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-violet-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-user-cog text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Mi Perfil
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Gestiona tu información personal y preferencias de cuenta
            </p>
        </div>

        <!-- Tarjeta Principal Mejorada -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-white/60">
            <!-- Mensajes Mejorados -->
            @if (session('success'))
                <div class="mb-8 p-6 bg-green-100 border border-green-200 rounded-2xl text-green-800 backdrop-blur-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-bold text-lg">¡Éxito!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-8 p-6 bg-red-100 border border-red-200 rounded-2xl text-red-800 backdrop-blur-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-bold text-lg">Error</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 p-6 bg-red-100 border border-red-200 rounded-2xl text-red-800 backdrop-blur-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <div>
                            <p class="font-bold text-lg">Errores al guardar:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- FORMULARIO DE PERFIL MEJORADO -->
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Sección: Datos de Cuenta -->
                <div class="mb-10">
                    <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        Datos de Cuenta
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-signature text-indigo-500 mr-2"></i>
                                Nombre Completo
                            </label>
                            <input type="text" name="name"
                                   value="{{ old('name', $user['name'] ?? '') }}"
                                   class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-indigo-200 focus:bg-white shadow-lg transition-all duration-300 text-lg"
                                   placeholder="Tu nombre completo"
                                   required>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-envelope text-purple-500 mr-2"></i>
                                Correo Electrónico
                            </label>
                            <input type="email" name="email"
                                   value="{{ old('email', $user['email'] ?? '') }}"
                                   class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-purple-200 focus:bg-white shadow-lg transition-all duration-300 text-lg"
                                   placeholder="tu@email.com"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Sección: Información de Contacto -->
                <div class="mb-10">
                    <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-address-card text-white text-xl"></i>
                        </div>
                        Información de Contacto
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-phone text-blue-500 mr-2"></i>
                                Teléfono
                            </label>
                            <input type="text" name="phone"
                                   value="{{ old('phone', $user['profile']['phone'] ?? '') }}"
                                   class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-200 focus:bg-white shadow-lg transition-all duration-300 text-lg"
                                   placeholder="+57 300 123 4567">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-map-marker-alt text-cyan-500 mr-2"></i>
                                Dirección
                            </label>
                            <input type="text" name="address"
                                   value="{{ old('address', $user['profile']['address'] ?? '') }}"
                                   class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-cyan-200 focus:bg-white shadow-lg transition-all duration-300 text-lg"
                                   placeholder="Calle 123 #45-67, Ciudad">
                        </div>
                    </div>
                </div>

                <!-- Sección: Biografía -->
                <div class="mb-10">
                    <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-heart text-white text-xl"></i>
                        </div>
                        Sobre Mí
                    </h2>

                    <div>
                        <label class="block text-lg font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-edit text-pink-500 mr-2"></i>
                            Biografía
                        </label>
                        <textarea name="biography" rows="5"
                                  class="w-full bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-pink-200 focus:bg-white shadow-lg transition-all duration-300 resize-none text-lg"
                                  placeholder="Cuéntanos sobre ti, tus mascotas, tus intereses...">{{ old('biography', $user['profile']['biography'] ?? '') }}</textarea>
                        <p class="text-sm text-gray-500 mt-2 flex items-center">
                            <i class="fas fa-info-circle text-pink-500 mr-1"></i>
                            Comparte información que otros dueños de mascotas puedan encontrar interesante
                        </p>
                    </div>
                </div>

                <!-- Botones de Acción Mejorados -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6 pt-8 border-t border-gray-200/60">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                        <span class="text-sm">Tu información está protegida y segura</span>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('dashboard') }}" 
                           class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center">
                            <i class="fas fa-arrow-left mr-3"></i>
                            Volver
                        </a>
                        
                        <button type="submit"
                                class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-10 py-4 rounded-2xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center text-lg">
                            <i class="fas fa-save mr-3"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Resto de la vista se mantiene igual -->
        <!-- Tarjeta de Estadísticas (Opcional) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-gradient-to-br from-white to-indigo-50 rounded-2xl shadow-xl p-6 border border-indigo-100/50 text-center">
                <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-check text-indigo-500 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">15</h3>
                <p class="text-gray-600 font-semibold">Citas Realizadas</p>
            </div>

            <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-xl p-6 border border-purple-100/50 text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-purple-500 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">8</h3>
                <p class="text-gray-600 font-semibold">Pedidos Completados</p>
            </div>

            <div class="bg-gradient-to-br from-white to-pink-50 rounded-2xl shadow-xl p-6 border border-pink-100/50 text-center">
                <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-comments text-pink-500 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">12</h3>
                <p class="text-gray-600 font-semibold">Posts en Foro</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animaciones personalizadas */
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
        50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.6); }
    }
    
    .bg-gradient-to-r.from-indigo-500.to-purple-600 {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    /* Efectos de entrada */
    .bg-white\\/80 {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mejoras de scroll para textareas */
    textarea::-webkit-scrollbar {
        width: 8px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #8b5cf6, #a855f7);
        border-radius: 10px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #7c3aed, #9333ea);
    }
</style>

<script>
    // Efectos de interacción para los inputs
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            // Efecto al focus
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });
            
            // Efecto al blur
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });

        // Validación en tiempo real para el teléfono
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                // Permitir solo números, espacios, + y -
                this.value = this.value.replace(/[^\d+\-\s]/g, '');
            });
        }
    });
</script>
@endsection