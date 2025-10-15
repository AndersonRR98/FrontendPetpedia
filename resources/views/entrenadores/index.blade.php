@extends('layouts.app')

@section('title', 'Entrenadores - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center">
                <i class="fas fa-dumbbell text-green-600 mr-3"></i>
                Entrenadores
            </h1>
            <p class="text-gray-600">Profesionales en adiestramiento canino para tu mascota</p>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg border border-red-200">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Grid de Entrenadores -->
        @if(isset($entrenadores) && count($entrenadores) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($entrenadores as $entrenador)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Imagen del Entrenador -->
                        <div class="relative h-48 bg-gray-200">
                            @php
                                // Imágenes locales para entrenadores
                                $localImages = [
                                    'entrenador1.jpg',
                                    'entrenador2.jpg',
                                    'entrenador3.jpg',
                                    'entrenador4.jpg'
                                ];
                                
                                // Usar el ID del entrenador para seleccionar imagen cíclica
                                $imageIndex = ($entrenador['id'] ?? 0) % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            
                            <img 
                                src="{{ asset('images/entrenadores/' . $localImage) }}" 
                                alt="{{ $entrenador['user']['name'] ?? $entrenador['name'] ?? 'Entrenador' }}"
                                class="w-full h-full object-cover"
                                onerror="this.src='{{ asset('images/default-entrenador.jpg') }}'"
                            >
                            <!-- Rating -->
                            <div class="absolute top-4 right-4 bg-white bg-opacity-90 rounded-full px-3 py-1">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    <span class="text-gray-800 font-semibold text-sm">
                                        {{ $entrenador['rating'] ?? '0.0' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Información del Entrenador -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        {{-- Manejar diferentes estructuras de datos --}}
                                        @if(isset($entrenador['user']['name']))
                                            {{ $entrenador['user']['name'] }}
                                        @elseif(isset($entrenador['name']))
                                            {{ $entrenador['name'] }}
                                        @elseif(isset($entrenador['user']))
                                            {{ is_array($entrenador['user']) ? ($entrenador['user']['name'] ?? 'Entrenador') : 'Entrenador' }}
                                        @else
                                            Entrenador Profesional
                                        @endif
                                    </h3>
                                    <p class="text-green-600 font-semibold">{{ $entrenador['specialty'] ?? 'Entrenador Canino' }}</p>
                                </div>
                            </div>

                            <!-- Especialidad y Experiencia -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-briefcase text-gray-400 mr-2 w-4"></i>
                                    <span>{{ $entrenador['experience_years'] ?? 0 }} años de experiencia</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-dollar-sign text-gray-400 mr-2 w-4"></i>
                                    <span>${{ number_format($entrenador['hourly_rate'] ?? 0, 2) }}/hora</span>
                                </div>
                                @if(isset($entrenador['review_count']) && $entrenador['review_count'] > 0)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-comment text-gray-400 mr-2 w-4"></i>
                                    <span>{{ $entrenador['review_count'] }} reseñas</span>
                                </div>
                                @endif
                            </div>

                            <!-- Calificaciones -->
                            @if(isset($entrenador['qualifications']) && !empty($entrenador['qualifications']))
                                <div class="mb-4">
                                    <p class="text-sm text-gray-700 line-clamp-2">
                                        {{ $entrenador['qualifications'] }}
                                    </p>
                                </div>
                            @endif

                            <!-- Información de contacto si está disponible -->
                            @if(isset($entrenador['user']['profile']['phone']) || isset($entrenador['user']['email']))
                                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-600">
                                        @if(isset($entrenador['user']['profile']['phone']))
                                            <i class="fas fa-phone mr-1"></i>{{ $entrenador['user']['profile']['phone'] }}
                                        @endif
                                        @if(isset($entrenador['user']['email']))
                                            <br><i class="fas fa-envelope mr-1"></i>{{ $entrenador['user']['email'] }}
                                        @endif
                                    </p>
                                </div>
                            @endif

                            <!-- Botón Ver Perfil -->
                            <a href="{{ route('entrenadores.show', $entrenador['id']) }}" 
                               class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 font-semibold flex items-center justify-center">
                                <i class="fas fa-user mr-2"></i>
                                Ver Perfil Completo
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado vacío -->
            <div class="text-center py-12">
                <i class="fas fa-dumbbell text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay entrenadores disponibles</h3>
                <p class="text-gray-600 mb-6">Pronto tendremos profesionales disponibles para el adiestramiento de tu mascota.</p>
                <a href="{{ route('dashboard') }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-200 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al Dashboard
                </a>
            </div>
        @endif

        <!-- Debug temporal (quitar en producción) -->
        @if(isset($entrenadores) && count($entrenadores) > 0)
            <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                <details>
                    <summary class="cursor-pointer font-semibold text-blue-800">Debug: Estructura de datos (quitar en producción)</summary>
                    <pre class="mt-2 text-xs bg-white p-4 rounded border">{{ json_encode($entrenadores[0] ?? [], JSON_PRETTY_PRINT) }}</pre>
                </details>
            </div>
        @endif
    </div>
</div>
@endsection