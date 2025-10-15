@extends('layouts.app')

@section('title', ($entrenador['user']['name'] ?? 'Entrenador') . ' - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-500">Dashboard</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <a href="{{ route('entrenadores.index') }}" class="text-green-600 hover:text-green-500">Entrenadores</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <span class="text-gray-500">{{ $entrenador['user']['name'] ?? 'Detalle' }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información Principal -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                    <!-- Header -->
                    <div class="bg-green-600 text-white px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <h1 class="text-2xl font-bold flex items-center">
                                <i class="fas fa-dumbbell mr-3"></i>
                                {{ $entrenador['user']['name'] ?? 'Entrenador' }}
                            </h1>
                            <span class="bg-white text-green-600 px-3 py-1 rounded-full text-sm font-semibold mt-2 sm:mt-0">
                                {{ $entrenador['specialty'] ?? 'Entrenador Profesional' }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="p-6">
                        <!-- Imagen -->
                        <div class="text-center mb-6">
                            @php
                                $localImages = [
                                    'entrenador1.jpg',
                                    'entrenador2.jpg', 
                                    'entrenador3.jpg',
                                    'entrenador4.jpg'
                                   
                                ];
                                
                                $imageIndex = ($entrenador['id'] ?? 0) % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            
                            <img 
                                src="{{ asset('images/entrenadores/' . $localImage) }}" 
                                alt="{{ $entrenador['user']['name'] ?? 'Entrenador' }}"
                                class="w-full max-w-2xl h-80 object-cover rounded-lg shadow-md mx-auto hover:shadow-lg transition duration-300"
                                onerror="this.src='{{ asset('images/default-entrenador.jpg') }}'"
                            >
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Imagen de referencia
                            </p>
                        </div>

                        <!-- Información General -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Información Profesional -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-info-circle text-green-500 mr-2"></i>
                                    Información Profesional
                                </h2>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-briefcase text-green-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Especialidad</p>
                                            <p class="text-gray-600">{{ $entrenador['specialty'] ?? 'No especificada' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-chart-line text-blue-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Experiencia</p>
                                            <p class="text-gray-600">{{ $entrenador['experience_years'] ?? 0 }} años</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-dollar-sign text-yellow-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Tarifa por Hora</p>
                                            <p class="text-gray-600">${{ number_format($entrenador['hourly_rate'] ?? 0, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Calificaciones y Rating -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                                    Calificaciones
                                </h2>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-star text-yellow-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Rating</p>
                                            <div class="flex items-center">
                                                <span class="text-gray-600 mr-2">{{ $entrenador['rating'] ?? '0.0' }}/5.0</span>
                                                <div class="flex">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= ($entrenador['rating'] ?? 0) ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-comment text-gray-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Reseñas</p>
                                            <p class="text-gray-600">{{ $entrenador['review_count'] ?? 0 }} reseñas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calificaciones y Certificaciones -->
                        @if(isset($entrenador['qualifications']) && !empty($entrenador['qualifications']))
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-certificate text-purple-500 mr-2"></i>
                                Certificaciones y Calificaciones
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $entrenador['qualifications'] }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Información de Contacto -->
                        @if(isset($entrenador['user']))
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                Información de Contacto
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start">
                                    <i class="fas fa-envelope text-blue-500 mt-1 mr-3 w-4"></i>
                                    <div>
                                        <p class="font-medium text-gray-900">Email</p>
                                        <p class="text-gray-600">{{ $entrenador['user']['email'] ?? 'No disponible' }}</p>
                                    </div>
                                </div>
                                @if(isset($entrenador['user']['profile']))
                                <div class="flex items-start">
                                    <i class="fas fa-phone text-green-500 mt-1 mr-3 w-4"></i>
                                    <div>
                                        <p class="font-medium text-gray-900">Teléfono</p>
                                        <p class="text-gray-600">{{ $entrenador['user']['profile']['phone'] ?? 'No disponible' }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Acciones Rápidas -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-green-600 text-white px-4 py-3">
                        <h3 class="font-semibold flex items-center">
                            <i class="fas fa-bolt mr-2"></i>
                            Contactar Entrenador
                        </h3>
                    </div>
                    <div class="p-4 space-y-3">
                        @if(isset($entrenador['user']['profile']['phone']))
                        <a href="tel:{{ $entrenador['user']['profile']['phone'] }}" 
                           class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Llamar Ahora
                        </a>
                        @endif
                        
                        @if(isset($entrenador['user']['email']))
                        <a href="mailto:{{ $entrenador['user']['email'] }}" 
                           class="w-full border border-green-600 text-green-600 py-3 px-4 rounded-lg hover:bg-green-50 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-envelope mr-2"></i>
                            Enviar Email
                        </a>
                        @endif
                        
                        <button class="w-full border border-yellow-600 text-yellow-600 py-3 px-4 rounded-lg hover:bg-yellow-50 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Solicitar Sesión
                        </button>
                    </div>
                </div>

                <!-- Volver a la lista -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-gray-600 text-white px-4 py-3">
                        <h3 class="font-semibold flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Navegación
                        </h3>
                    </div>
                    <div class="p-4">
                        <a href="{{ route('entrenadores.index') }}" 
                           class="w-full bg-gray-600 text-white py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>
                            Volver a Entrenadores
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection