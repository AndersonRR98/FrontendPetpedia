@extends('layouts.app')

@section('title', $veterinaria['clinic_name'] ?? 'Veterinaria - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-500">Dashboard</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <a href="{{ route('veterinarias.index') }}" class="text-indigo-600 hover:text-indigo-500">Veterinarias</a>
                </li>
                <li class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                    <span class="text-gray-500">{{ $veterinaria['clinic_name'] ?? 'Detalle' }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información Principal -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                    <!-- Header -->
                    <div class="bg-indigo-600 text-white px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <h1 class="text-2xl font-bold flex items-center">
                                <i class="fas fa-clinic-medical mr-3"></i>
                                {{ $veterinaria['clinic_name'] ?? 'Veterinaria' }}
                            </h1>
                            <span class="bg-white text-indigo-600 px-3 py-1 rounded-full text-sm font-semibold mt-2 sm:mt-0">
                                {{ $veterinaria['specialization'] ?? 'General' }}
                            </span>
                        </div>
                    </div>

                    <!-- Contenido -->
                    <div class="p-6">
                        <!-- Imagen -->
                        <div class="text-center mb-6">
                            @php
                                $localImages = [
                                    'veterinaria1.jpg',
                                    'veterinaria2.jpg', 
                                    'veterinaria3.jpg',
                                    'veterinaria4.jpg',
                                    'veterinaria5.jpg',
                                    'veterinaria6.jpg'
                                ];
                                
                                $imageIndex = ($veterinaria['id'] ?? 0) % count($localImages);
                                $localImage = $localImages[$imageIndex];
                            @endphp
                            
                            <img 
                                src="{{ asset('images/veterinarias/' . $localImage) }}" 
                                alt="{{ $veterinaria['clinic_name'] ?? 'Veterinaria' }}"
                                class="w-full max-w-2xl h-80 object-cover rounded-lg shadow-md mx-auto hover:shadow-lg transition duration-300"
                                onerror="this.src='{{ asset('images/default-veterinaria.jpg') }}'"
                            >
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-image mr-1"></i>
                                Imagen de referencia
                            </p>
                        </div>

                        <!-- Información General -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Información de la Clínica -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-info-circle text-indigo-500 mr-2"></i>
                                    Información General
                                </h2>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-stethoscope text-indigo-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Especialización</p>
                                            <p class="text-gray-600">{{ $veterinaria['specialization'] ?? 'No especificada' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-certificate text-green-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Licencia Veterinaria</p>
                                            <p class="text-gray-600">{{ $veterinaria['veterinary_license'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-calendar-alt text-purple-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Registrado</p>
                                            <p class="text-gray-600">
                                                @if(isset($veterinaria['created_at']))
                                                    {{ \Carbon\Carbon::parse($veterinaria['created_at'])->format('d/m/Y') }}
                                                @else
                                                    Fecha no disponible
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información del Veterinario -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-user-md text-green-500 mr-2"></i>
                                    Información del Veterinario
                                </h2>
                                @if(isset($veterinaria['user']))
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <i class="fas fa-user text-gray-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Nombre</p>
                                            <p class="text-gray-600">Dr. {{ $veterinaria['user']['name'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-envelope text-blue-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Email</p>
                                            <p class="text-gray-600">{{ $veterinaria['user']['email'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    @if(isset($veterinaria['user']['profile']))
                                    <div class="flex items-start">
                                        <i class="fas fa-phone text-green-500 mt-1 mr-3 w-4"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Teléfono</p>
                                            <p class="text-gray-600">{{ $veterinaria['user']['profile']['phone'] ?? 'No disponible' }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <p class="text-gray-500 italic">Información del veterinario no disponible.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Horarios -->
                        @if(isset($veterinaria['schedules']) && $veterinaria['schedules'])
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-clock text-yellow-500 mr-2"></i>
                                Horarios de Atención
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @php
                                        $schedules = is_string($veterinaria['schedules']) ? 
                                                   json_decode($veterinaria['schedules'], true) : 
                                                   $veterinaria['schedules'];
                                        $days = [
                                            'monday' => 'Lunes',
                                            'tuesday' => 'Martes', 
                                            'wednesday' => 'Miércoles',
                                            'thursday' => 'Jueves',
                                            'friday' => 'Viernes',
                                            'saturday' => 'Sábado',
                                            'sunday' => 'Domingo'
                                        ];
                                    @endphp
                                    @foreach($days as $key => $day)
                                    <div class="bg-white rounded-lg p-3 shadow-sm border border-gray-200">
                                        <p class="font-semibold text-gray-900 mb-1">{{ $day }}</p>
                                        <p class="text-sm text-gray-600">
                                            @if(isset($schedules[$key]) && $schedules[$key] !== 'Cerrado')
                                                @if(is_array($schedules[$key]))
                                                    {{ implode(', ', $schedules[$key]) }}
                                                @else
                                                    {{ $schedules[$key] }}
                                                @endif
                                            @else
                                                <span class="text-red-500 font-medium">Cerrado</span>
                                            @endif
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-yellow-800 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Horarios no disponibles
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Formulario de Solicitud de Cita -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-indigo-600 text-white px-4 py-3">
                        <h3 class="font-semibold flex items-center">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Solicitar Cita
                        </h3>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('citas.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="veterinary_id" value="{{ $veterinaria['id'] ?? '' }}">
                            
                            <!-- Fecha -->
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-calendar-day mr-1"></i>
                                    Fecha de la cita
                                </label>
                                <input 
                                    type="date" 
                                    id="date" 
                                    name="date"
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200"
                                    required
                                >
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-file-alt mr-1"></i>
                                    Descripción / Motivo
                                </label>
                                <textarea 
                                    id="description" 
                                    name="description"
                                    rows="4"
                                    placeholder="Describe el motivo de tu cita, síntomas de tu mascota, etc."
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200 resize-none"
                                    required
                                ></textarea>
                                <p class="text-xs text-gray-500 mt-1">Proporciona detalles sobre la consulta</p>
                            </div>

                            <!-- Botón de envío -->
                            <button 
                                type="submit"
                                class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold flex items-center justify-center"
                            >
                                <i class="fas fa-paper-plane mr-2"></i>
                                Solicitar Cita
                            </button>
                        </form>

                        @if($errors->any())
                            <div class="mt-4 p-3 bg-red-100 text-red-800 rounded-lg">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="mt-4 p-3 bg-green-100 text-green-800 rounded-lg">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif
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
                        <a href="{{ route('veterinarias.index') }}" 
                           class="w-full bg-gray-600 text-white py-3 px-4 rounded-lg hover:bg-gray-700 transition duration-200 font-semibold flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>
                            Volver a Veterinarias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection