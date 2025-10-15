@extends('layouts.app')

@section('title', 'Veterinarias - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Veterinarias</h1>
            <p class="text-gray-600">Encuentra la mejor atención médica para tu mascota</p>
        </div>

        <!-- Buscador y Filtros -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Buscar veterinarias..." 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex gap-4">
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Filtrar por especialidad</option>
                        <option>Medicina General</option>
                        <option>Cirugía</option>
                        <option>Dermatología</option>
                        <option>Cardiología</option>
                        <option>Oftalmología</option>
                    </select>
                    <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Lista de Veterinarias -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($veterinarias as $index => $veterinaria)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group">
                <!-- Imagen Local -->
                <div class="h-48 bg-gradient-to-br from-indigo-100 to-purple-100 relative overflow-hidden">
                    @php
                        // Definir imágenes locales para las veterinarias
                        $localImages = [
                            'veterinaria1.jpg',
                            'veterinaria2.jpg', 
                            'veterinaria3.jpg',
                            'veterinaria4.jpg',
                            'veterinaria5.jpg',
                            'veterinaria6.jpg'
                        ];
                        
                        // Usar imagen cíclica basada en el índice
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp

                    <img 
                        src="{{ asset('images/veterinarias/' . $localImage) }}" 
                        alt="{{ $veterinaria['clinic_name'] }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        onerror="this.src='{{ asset('images/default-veterinaria.jpg') }}'"
                    >
                    
                    <!-- Badge de especialización -->
                    <div class="absolute top-4 left-4">
                        <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            {{ $veterinaria['specialization'] ?? 'Veterinaria' }}
                        </span>
                    </div>
                    
                    <!-- Overlay en hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300"></div>
                </div>
                
                <!-- Información -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $veterinaria['clinic_name'] }}</h3>
                    
                    <div class="space-y-2 mb-4">
                        <!-- Licencia -->
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-certificate text-green-500 mr-2 w-4"></i>
                            <span class="flex-1">Lic. {{ $veterinaria['veterinary_license'] ?? 'En trámite' }}</span>
                        </div>

                        <!-- Horarios -->
                        @if($veterinaria['schedules'])
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-clock text-yellow-500 mr-2 w-4 mt-0.5"></i>
                            <span class="flex-1">
                                @php
                                    $schedules = is_string($veterinaria['schedules']) ? 
                                               json_decode($veterinaria['schedules'], true) : 
                                               $veterinaria['schedules'];
                                    $today = strtolower(now()->englishDayOfWeek);
                                    $todaySchedule = $schedules[$today] ?? 'Cerrado';
                                @endphp
                                <strong>Hoy:</strong> 
                                {{ is_array($todaySchedule) ? implode(', ', $todaySchedule) : $todaySchedule }}
                            </span>
                        </div>
                        @endif

                        <!-- Ubicación si está disponible -->
                        @if(isset($veterinaria['user']['profile']['address']))
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2 w-4"></i>
                            <span class="flex-1 truncate">{{ $veterinaria['user']['profile']['address'] }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Acciones -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <a href="{{ route('veterinarias.show', $veterinaria['id']) }}" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 text-sm font-semibold flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Ver Detalles
                        </a>
                        <div class="flex space-x-2">
                            <button class="text-gray-400 hover:text-red-500 transition duration-200" 
                                    title="Agregar a favoritos">
                                <i class="far fa-heart"></i>
                            </button>
                            @if(isset($veterinaria['user']['profile']['phone']))
                            <a href="tel:{{ $veterinaria['user']['profile']['phone'] }}" 
                               class="text-gray-400 hover:text-green-500 transition duration-200"
                               title="Llamar">
                                <i class="fas fa-phone"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-clinic-medical text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay veterinarias disponibles</h3>
                <p class="text-gray-500">Pronto tendremos veterinarias para ti.</p>
            </div>
            @endforelse
        </div>

        <!-- Información sobre las imágenes -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>💡 <strong>Nota:</strong> Las imágenes mostradas son de referencia local</p>
        </div>
    </div>
</div>

@push('styles')
<style>
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush
@endsection