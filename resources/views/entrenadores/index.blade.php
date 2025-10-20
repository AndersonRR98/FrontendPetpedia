@extends('layouts.app')  <!-- vista de entrenadores disponibles -->

@section('title', 'Entrenadores - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-dumbbell text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-4">
                Entrenadores
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Profesionales especializados en el adiestramiento y bienestar de tu mascota
            </p>
        </div>

        @if(session('error'))
            <div class="mb-8 p-6 bg-red-100 border border-red-200 rounded-2xl text-red-800 backdrop-blur-sm">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Grid de Entrenadores Mejorado -->
        @if(isset($entrenadores) && count($entrenadores) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($entrenadores as $entrenador)
                    <div class="entrenador-card group relative bg-gradient-to-br from-white via-green-50 to-emerald-100 rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-white/50"
                         data-name="{{ strtolower($entrenador['user']['name'] ?? $entrenador['name'] ?? '') }}"
                         data-specialty="{{ strtolower($entrenador['specialty'] ?? '') }}"
                         data-experience="{{ $entrenador['experience_years'] ?? 0 }}">

                        <!-- Efecto de brillo al hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-green-400/10 to-emerald-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>

                        <!-- Imagen del Entrenador Mejorada -->
                        <div class="h-64 relative overflow-hidden rounded-t-3xl">
                            @php
                                $localImages = ['entrenador1.jpg','entrenador2.jpg','entrenador3.jpg','entrenador4.jpg'];
                                $imageIndex = ($entrenador['id'] ?? 0) % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            
                            <img 
                                src="{{ asset('images/entrenadores/' . $localImage) }}" 
                                alt="{{ $entrenador['user']['name'] ?? $entrenador['name'] ?? 'Entrenador' }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                onerror="this.src='{{ asset('images/default-entrenador.jpg') }}'"
                            >
                            
                            <!-- Gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                            
                            <!-- Badge de especialidad mejorado -->
                            <span class="absolute top-5 left-5 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2 rounded-2xl text-sm font-bold shadow-xl backdrop-blur-sm">
                                {{ $entrenador['specialty'] ?? 'Entrenador Canino' }}
                            </span>

                            <!-- Rating stars mejorado -->
                            <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-sm rounded-2xl px-3 py-2 shadow-lg">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    <span class="text-gray-800 font-bold text-sm">{{ $entrenador['rating'] ?? '0.0' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Información del Entrenador Mejorada -->
                        <div class="p-7 relative z-10">
                            <h3 class="text-2xl font-black text-gray-900 mb-4 truncate group-hover:text-green-600 transition-colors duration-300">
                                @if(isset($entrenador['user']['name']))
                                    {{ $entrenador['user']['name'] }}
                                @elseif(isset($entrenador['name']))
                                    {{ $entrenador['name'] }}
                                @else
                                    Entrenador Profesional
                                @endif
                            </h3>
                            
                            <!-- Estadísticas Mejoradas -->
                            <div class="space-y-3 mb-6 text-gray-600">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-briefcase text-blue-500 text-sm"></i>
                                    </div>
                                    <span class="font-semibold">{{ $entrenador['experience_years'] ?? 0 }} años de experiencia</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-dollar-sign text-yellow-500 text-sm"></i>
                                    </div>
                                    <span class="font-semibold">${{ number_format($entrenador['hourly_rate'] ?? 0, 2) }}/hora</span>
                                </div>
                                
                                @if(isset($entrenador['review_count']) && $entrenador['review_count'] > 0)
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-comment text-purple-500 text-sm"></i>
                                    </div>
                                    <span class="font-semibold">{{ $entrenador['review_count'] }} reseñas</span>
                                </div>
                                @endif
                            </div>

                            <!-- Calificaciones -->
                            @if(isset($entrenador['qualifications']) && !empty($entrenador['qualifications']))
                                <div class="mb-6 p-4 bg-white/50 backdrop-blur-sm rounded-2xl border border-white/70">
                                    <p class="text-sm text-gray-700 line-clamp-3 font-medium">
                                        {{ $entrenador['qualifications'] }}
                                    </p>
                                </div>
                            @endif

                            <!-- Información de contacto mejorada -->
                            @if(isset($entrenador['user']['profile']['phone']) || isset($entrenador['user']['email']))
                                <div class="mb-6 p-4 bg-gradient-to-r from-white to-green-50 rounded-2xl border border-green-100/50">
                                    <div class="space-y-2">
                                        @if(isset($entrenador['user']['profile']['phone']))
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-phone text-green-500 mr-2"></i>
                                            <span class="font-medium">{{ $entrenador['user']['profile']['phone'] }}</span>
                                        </div>
                                        @endif
                                        @if(isset($entrenador['user']['email']))
                                        <div class="flex items-center text-sm">
                                            <i class="fas fa-envelope text-green-500 mr-2"></i>
                                            <span class="font-medium">{{ $entrenador['user']['email'] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Botón Ver Perfil Mejorado -->
                            <a href="{{ route('entrenadores.show', $entrenador['id']) }}" 
                               class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-4 px-6 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center group/btn">
                                <i class="fas fa-user mr-2 group-hover/btn:scale-110 transition-transform duration-300"></i> 
                                Ver Perfil Completo
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado vacío mejorado -->
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-3xl shadow-2xl mb-6">
                    <i class="fas fa-dumbbell text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black text-gray-700 mb-3">No hay entrenadores disponibles</h3>
                <p class="text-gray-500 text-lg mb-8">Pronto tendremos profesionales disponibles para el adiestramiento de tu mascota.</p>
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Volver al Dashboard
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* Animaciones personalizadas */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .entrenador-card:hover {
        animation: float 3s ease-in-out infinite;
    }
</style>

<script>
    // Efectos de entrada para las tarjetas
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.entrenador-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endsection