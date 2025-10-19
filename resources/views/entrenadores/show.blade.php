@extends('layouts.app')

@section('title', ($entrenador['user']['name'] ?? 'Entrenador') . ' - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb mejorado -->
        <nav class="flex mb-10" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-3 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-700 font-semibold transition-colors duration-300 flex items-center">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </li>
                <li class="flex items-center text-gray-400">
                    <i class="fas fa-chevron-right mx-2"></i>
                    <a href="{{ route('entrenadores.index') }}" class="text-green-600 hover:text-green-700 font-semibold transition-colors duration-300">Entrenadores</a>
                </li>
                <li class="flex items-center text-gray-400">
                    <i class="fas fa-chevron-right mx-2"></i>
                    <span class="text-gray-600 font-semibold">{{ $entrenador['user']['name'] ?? 'Detalle' }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información Principal Mejorada -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Card Principal -->
                <div class="bg-gradient-to-br from-white via-green-50 to-emerald-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
                    <!-- Header con gradient -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-dumbbell text-white text-2xl"></i>
                            </div>
                            <h1 class="text-3xl font-black">{{ $entrenador['user']['name'] ?? 'Entrenador' }}</h1>
                        </div>
                        <span class="bg-white/20 backdrop-blur-sm text-white px-6 py-2 rounded-2xl font-bold text-lg border border-white/30">
                            {{ $entrenador['specialty'] ?? 'Entrenador Profesional' }}
                        </span>
                    </div>

                    <div class="p-8 space-y-8">
                        <!-- Imagen Principal Mejorada -->
                        <div class="text-center">
                            @php
                                $localImages = ['entrenador1.jpg','entrenador2.jpg','entrenador3.jpg','entrenador4.jpg'];
                                $imageIndex = ($entrenador['id'] ?? 0) % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            <div class="relative inline-block">
                                <img 
                                    src="{{ asset('images/entrenadores/' . $localImage) }}" 
                                    alt="{{ $entrenador['user']['name'] ?? 'Entrenador' }}"
                                    class="w-full max-w-4xl h-96 object-cover rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:scale-105 border-4 border-white"
                                    onerror="this.src='{{ asset('images/default-entrenador.jpg') }}'"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-3 flex items-center justify-center">
                                <i class="fas fa-image mr-2 text-green-400"></i> Imagen de referencia
                            </p>
                        </div>

                        <!-- Grid de Información Mejorado -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Información Profesional -->
                            <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                                <h2 class="text-xl font-black text-gray-900 mb-4 flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                                        <i class="fas fa-info-circle text-green-500"></i>
                                    </div>
                                    Información Profesional
                                </h2>
                                <div class="space-y-3 text-gray-700">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                        <span class="font-semibold">Especialidad:</span>
                                        <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-full text-sm font-bold">{{ $entrenador['specialty'] ?? 'No especificada' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                        <span class="font-semibold">Experiencia:</span>
                                        <span class="text-gray-900 font-bold">{{ $entrenador['experience_years'] ?? 0 }} años</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="font-semibold">Tarifa por Hora:</span>
                                        <span class="text-gray-900 font-bold">${{ number_format($entrenador['hourly_rate'] ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Calificaciones Mejoradas -->
                            <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                                <h2 class="text-xl font-black text-gray-900 mb-4 flex items-center">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                                        <i class="fas fa-star text-yellow-500"></i>
                                    </div>
                                    Calificaciones
                                </h2>
                                <div class="space-y-4 text-gray-700">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">Rating:</span>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-gray-900 font-bold text-lg">{{ $entrenador['rating'] ?? '0.0' }}/5.0</span>
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= ($entrenador['rating'] ?? 0) ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">Reseñas:</span>
                                        <span class="text-gray-900 font-bold">{{ $entrenador['review_count'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificaciones Mejoradas -->
                        @if(!empty($entrenador['qualifications']))
                        <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50">
                            <h2 class="text-xl font-black text-gray-900 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-certificate text-purple-500"></i>
                                </div>
                                Certificaciones y Calificaciones
                            </h2>
                            <div class="bg-gradient-to-r from-white to-green-50 rounded-2xl p-5 border border-green-100/50">
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed font-medium">{{ $entrenador['qualifications'] }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Información de Contacto Mejorada -->
                        @if(isset($entrenador['user']))
                        <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50">
                            <h2 class="text-xl font-black text-gray-900 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-500"></i>
                                </div>
                                Información de Contacto
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center p-3 bg-gradient-to-r from-white to-blue-50 rounded-2xl border border-blue-100/50">
                                    <i class="fas fa-envelope text-blue-500 mr-3 text-lg"></i>
                                    <div>
                                        <p class="font-semibold text-gray-900">Email</p>
                                        <p class="text-gray-600 text-sm">{{ $entrenador['user']['email'] ?? 'No disponible' }}</p>
                                    </div>
                                </div>
                                @if(isset($entrenador['user']['profile']))
                                <div class="flex items-center p-3 bg-gradient-to-r from-white to-green-50 rounded-2xl border border-green-100/50">
                                    <i class="fas fa-phone text-green-500 mr-3 text-lg"></i>
                                    <div>
                                        <p class="font-semibold text-gray-900">Teléfono</p>
                                        <p class="text-gray-600 text-sm">{{ $entrenador['user']['profile']['phone'] ?? 'No disponible' }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Mejorado -->
            <div class="space-y-8">
                <!-- Formulario de Solicitud de Sesión Mejorado -->
                <div class="bg-gradient-to-br from-white via-green-50 to-emerald-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-5 font-bold text-lg flex items-center">
                        <i class="fas fa-calendar-plus mr-3 text-xl"></i> Solicitar Sesión
                    </div>
                    <div class="p-6">
                        <form action="{{ route('citas.storeTrainer') }}" method="POST" class="space-y-5">
                            @csrf
                            <input type="hidden" name="trainer_id" value="{{ $entrenador['id'] ?? '' }}">
                            
                            <!-- Fecha Mejorada -->
                            <div>
                                <label for="date" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-calendar-day mr-2 text-green-500"></i> Fecha de la sesión
                                </label>
                                <input 
                                    type="date" 
                                    id="date" 
                                    name="date"
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full bg-white/70 border-0 rounded-2xl px-5 py-3 focus:outline-none focus:ring-4 focus:ring-green-200 focus:bg-white shadow-lg transition-all duration-300 text-gray-700"
                                    required
                                >
                            </div>
                            
                            <!-- Descripción Mejorada -->
                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-file-alt mr-2 text-green-500"></i> Descripción
                                </label>
                                <textarea 
                                    id="description" 
                                    name="description"
                                    rows="4"
                                    placeholder="Ejemplo: entrenamiento básico para mi perro, corrección de conducta, socialización, etc."
                                    class="w-full bg-white/70 border-0 rounded-2xl px-5 py-3 focus:outline-none focus:ring-4 focus:ring-green-200 focus:bg-white shadow-lg transition-all duration-300 resize-none text-gray-700"
                                    required
                                ></textarea>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-1 text-green-500"></i>
                                    Describe brevemente qué esperas lograr en la sesión
                                </p>
                            </div>
                            
                            <!-- Botón de envío mejorado -->
                            <button 
                                type="submit"
                                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-4 px-6 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center justify-center text-lg"
                            >
                                <i class="fas fa-paper-plane mr-3"></i>
                                Solicitar Sesión
                            </button>
                        </form>

                        <!-- Mensajes de error y éxito mejorados -->
                        @if($errors->any())
                            <div class="mt-4 p-4 bg-red-100 border border-red-200 rounded-2xl text-red-800">
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                    <span class="font-semibold">Por favor corrige los siguientes errores:</span>
                                </div>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="mt-4 p-4 bg-green-100 border border-green-200 rounded-2xl text-green-800">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                    <span class="font-semibold">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Volver Mejorado -->
                <div class="bg-gradient-to-br from-white via-gray-50 to-gray-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
                    <a href="{{ route('entrenadores.index') }}" 
                       class="block bg-gradient-to-r from-gray-500 to-gray-600 text-white py-4 px-6 text-center rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 font-bold text-lg flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-3"></i> Volver a Entrenadores
                    </a>
                </div>

                <!-- Info adicional mejorada -->
                <div class="bg-gradient-to-br from-white via-emerald-50 to-teal-100 rounded-3xl shadow-2xl p-6 border border-white/60">
                    <h3 class="font-black text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-star text-yellow-400 mr-2"></i> Beneficios
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-green-500 mr-3"></i>
                            <span>Profesionales certificados</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap text-blue-500 mr-3"></i>
                            <span>Métodos comprobados</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-heart text-red-500 mr-3"></i>
                            <span>Enfoque en positivo</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-purple-500 mr-3"></i>
                            <span>Sesiones flexibles</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animaciones adicionales */
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
        50% { box-shadow: 0 0 30px rgba(16, 185, 129, 0.6); }
    }
    
    .bg-gradient-to-r.from-green-500.to-emerald-600 {
        animation: pulse-glow 2s ease-in-out infinite;
    }
</style>
@endsection