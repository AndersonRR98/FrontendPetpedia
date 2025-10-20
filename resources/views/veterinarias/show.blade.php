@extends('layouts.app')  <!-- vista de interfaz de veterinarias de detalles -->

@section('title', $veterinaria['clinic_name'] ?? 'Veterinaria - PetPedia')

@section('content')
@php
    // CORRECCIÓN: Función para formatear horarios consistentemente
    function formatearHorarioParaDetalle($horario) {
        if (is_string($horario)) {
            return $horario;
        }
        
        if (is_array($horario)) {
            if (count($horario) >= 2 && !empty($horario[0]) && !empty($horario[1])) {
                return $horario[0] . ' - ' . $horario[1];
            }
        }
        
        return 'Cerrado';
    }
@endphp

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-cyan-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb mejorado -->
        <nav class="flex mb-10" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-3 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-700 font-semibold transition-colors duration-300 flex items-center">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </li>
                <li class="flex items-center text-gray-400">
                    <i class="fas fa-chevron-right mx-2"></i>
                    <a href="{{ route('veterinarias.index') }}" class="text-purple-600 hover:text-purple-700 font-semibold transition-colors duration-300">Veterinarias</a>
                </li>
                <li class="flex items-center text-gray-400">
                    <i class="fas fa-chevron-right mx-2"></i>
                    <span class="text-gray-600 font-semibold">{{ $veterinaria['clinic_name'] ?? 'Detalle' }}</span>
                </li>
            </ol>
        </nav>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
        <div class="mb-8 p-6 bg-green-100 border border-green-200 rounded-2xl text-green-800 backdrop-blur-sm">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-8 p-6 bg-red-100 border border-red-200 rounded-2xl text-red-800 backdrop-blur-sm">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información Principal Mejorada -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Card Principal -->
                <div class="bg-gradient-to-br from-white via-purple-50 to-indigo-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
                    <!-- Header con gradient -->
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-8 py-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-clinic-medical text-white text-2xl"></i>
                            </div>
                            <h1 class="text-3xl font-black">{{ $veterinaria['clinic_name'] ?? 'Veterinaria' }}</h1>
                        </div>
                        <span class="bg-white/20 backdrop-blur-sm text-white px-6 py-2 rounded-2xl font-bold text-lg border border-white/30">
                            {{ $veterinaria['specialization'] ?? 'General' }}
                        </span>
                    </div>

                    <div class="p-8 space-y-8">
                        <!-- Imagen Principal Mejorada - CORREGIDA -->
                        <div class="text-center">
                            @php
                                // CORREGIDO: Usar el mismo algoritmo que en index
                                $localImages = ['veterinaria1.jpg','veterinaria2.jpg','veterinaria3.jpg','veterinaria4.jpg','veterinaria5.jpg','veterinaria6.jpg'];
                                $imageIndex = $veterinaria['id'] % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            <div class="relative inline-block">
                                <img src="{{ asset('images/veterinarias/' . $localImage) }}" 
                                     alt="{{ $veterinaria['clinic_name'] ?? 'Veterinaria' }}"
                                     class="w-full max-w-4xl h-96 object-cover rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:scale-105 border-4 border-white"
                                     onerror="this.src='{{ asset('images/default-veterinaria.jpg') }}'">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-3 flex items-center justify-center">
                                <i class="fas fa-image mr-2 text-purple-400"></i> Imagen de referencia
                            </p>
                        </div>

                        <!-- Información General Mejorada -->
                        <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300">
                            <h2 class="text-xl font-black text-gray-900 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle text-purple-500"></i>
                                </div>
                                Información General
                            </h2>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                    <span class="font-semibold text-gray-700">Especialización:</span>
                                    <span class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-3 py-1 rounded-full text-sm font-bold">{{ $veterinaria['specialization'] ?? 'No especificada' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                    <span class="font-semibold text-gray-700">Licencia:</span>
                                    <span class="text-gray-900 font-bold">{{ $veterinaria['veterinary_license'] ?? 'No disponible' }}</span>
                                </div>
                                @if(isset($veterinaria['user']))
                                <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                    <span class="font-semibold text-gray-700">Veterinario:</span>
                                    <span class="text-gray-900 font-bold">Dr. {{ $veterinaria['user']['name'] ?? 'No disponible' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                    <span class="font-semibold text-gray-700">Contacto:</span>
                                    <span class="text-gray-900 font-bold">{{ $veterinaria['user']['email'] ?? 'No disponible' }}</span>
                                </div>
                                @if(isset($veterinaria['user']['profile']))
                                <div class="flex justify-between items-center py-2 border-b border-gray-200/50">
                                    <span class="font-semibold text-gray-700">Teléfono:</span>
                                    <span class="text-gray-900 font-bold">{{ $veterinaria['user']['profile']['phone'] ?? 'No disponible' }}</span>
                                </div>
                                @endif
                                @endif
                                <div class="flex justify-between items-center py-2">
                                    <span class="font-semibold text-gray-700">Registrado:</span>
                                    <span class="text-gray-900 font-bold">{{ isset($veterinaria['created_at']) ? \Carbon\Carbon::parse($veterinaria['created_at'])->format('d/m/Y') : 'No disponible' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Horarios Mejorados - CORREGIDOS -->
                        <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50">
                            <h2 class="text-xl font-black text-gray-900 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-yellow-500"></i>
                                </div>
                                Horarios de Atención
                            </h2>
                            @if(isset($veterinaria['schedules']) && $veterinaria['schedules'])
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @php
                                    $schedules = is_string($veterinaria['schedules']) ? json_decode($veterinaria['schedules'], true) : $veterinaria['schedules'];
                                    // CORRECCIÓN: Usar días en español como en tu base de datos
                                    $days = [
                                        'lunes' => 'Lunes',
                                        'martes' => 'Martes', 
                                        'miercoles' => 'Miércoles',
                                        'jueves' => 'Jueves',
                                        'viernes' => 'Viernes',
                                        'sabado' => 'Sábado',
                                        'domingo' => 'Domingo'
                                    ];
                                @endphp
                                @foreach($days as $key => $day)
                                @php
                                    $horarioDia = $schedules[$key] ?? 'Cerrado';
                                    $horarioFormateado = formatearHorarioParaDetalle($horarioDia);
                                @endphp
                                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-4 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-gray-700">
                                    <p class="font-bold text-gray-900 mb-2 text-center">{{ $day }}</p>
                                    <p class="text-center text-sm font-semibold">
                                        @if($horarioFormateado !== 'Cerrado')
                                            <span class="text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $horarioFormateado }}</span>
                                        @else
                                            <span class="text-red-500 bg-red-50 px-3 py-1 rounded-full font-bold">Cerrado</span>
                                        @endif
                                    </p>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 text-yellow-800 flex items-center justify-center">
                                <i class="fas fa-info-circle text-yellow-500 text-xl mr-3"></i>
                                <span class="font-semibold">Horarios no disponibles</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Mejorado -->
            <div class="space-y-8">
                <!-- Solicitud de Cita Mejorada -->
                <div class="bg-gradient-to-br from-white via-purple-50 to-indigo-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-6 py-5 font-bold text-lg flex items-center">
                        <i class="fas fa-calendar-plus mr-3 text-xl"></i> Solicitar Cita
                    </div>
                    <div class="p-6">
                        <form action="{{ route('citas.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <input type="hidden" name="veterinary_id" value="{{ $veterinaria['id'] ?? '' }}">
                            
                            <div>
                                <label for="date" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-calendar-day mr-2 text-purple-500"></i> Fecha de la cita
                                </label>
                                <input type="date" id="date" name="date" min="{{ date('Y-m-d') }}" 
                                       class="w-full bg-white/70 border-0 rounded-2xl px-5 py-3 focus:outline-none focus:ring-4 focus:ring-purple-200 focus:bg-white shadow-lg transition-all duration-300 text-gray-700" required>
                            </div>
                            
                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-file-alt mr-2 text-purple-500"></i> Descripción
                                </label>
                                <textarea id="description" name="description" rows="4" 
                                          placeholder="Describe el motivo de tu cita..."
                                          class="w-full bg-white/70 border-0 rounded-2xl px-5 py-3 focus:outline-none focus:ring-4 focus:ring-purple-200 focus:bg-white shadow-lg transition-all duration-300 resize-none text-gray-700" required></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white py-4 px-6 rounded-2xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center justify-center text-lg">
                                <i class="fas fa-paper-plane mr-3"></i> Solicitar Cita
                            </button>
                        </form>

                        <!-- Mostrar errores de validación -->
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
                    </div>
                </div>

                <!-- Volver Mejorado -->
                <div class="bg-gradient-to-br from-white via-gray-50 to-gray-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
                    <a href="{{ route('veterinarias.index') }}" 
                       class="block bg-gradient-to-r from-gray-500 to-gray-600 text-white py-4 px-6 text-center rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 font-bold text-lg flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-3"></i> Volver a Veterinarias
                    </a>
                </div>

                <!-- Info adicional -->
                <div class="bg-gradient-to-br from-white via-blue-50 to-cyan-100 rounded-3xl shadow-2xl p-6 border border-white/60">
                    <h3 class="font-black text-gray-900 mb-4 flex items-center text-lg">
                        <i class="fas fa-star text-yellow-400 mr-2"></i> Información Adicional
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-blue-500 mr-3"></i>
                            <span>Profesionales certificados</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-ambulance text-red-500 mr-3"></i>
                            <span>Servicio de emergencia 24/7</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-paw text-purple-500 mr-3"></i>
                            <span>Atención para todas las mascotas</span>
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
        0%, 100% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.3); }
        50% { box-shadow: 0 0 30px rgba(139, 92, 246, 0.6); }
    }
    
    .bg-gradient-to-r.from-purple-500.to-indigo-600 {
        animation: pulse-glow 2s ease-in-out infinite;
    }
    
    /* Mejoras de scroll */
    textarea::-webkit-scrollbar {
        width: 6px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #8B5CF6, #6366F1);
        border-radius: 10px;
    }
</style>
@endsection