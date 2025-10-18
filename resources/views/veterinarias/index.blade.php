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
                           id="search-input"
                           placeholder="Buscar por nombre de clínica, especialidad..." 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex gap-4">
                    <select id="filter-specialization" class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Todas las especialidades</option>
                        <option value="Medicina General">Medicina General</option>
                        <option value="Cirugía">Cirugía</option>
                        <option value="Dermatología">Dermatología</option>
                        <option value="Cardiología">Cardiología</option>
                        <option value="Oftalmología">Oftalmología</option>
                        <option value="Odontología">Odontología</option>
                        <option value="Neurología">Neurología</option>
                        <option value="Oncología">Oncología</option>
                    </select>
                    <button id="clear-filters" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="mb-4">
            <p class="text-gray-600">
                <span id="veterinarias-count">{{ count($veterinarias) }}</span> veterinaria(s) encontrada(s)
            </p>
        </div>

        <!-- Lista de Veterinarias -->
        <div id="veterinarias-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($veterinarias as $index => $veterinaria)
            <div class="veterinaria-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group"
                 data-name="{{ strtolower($veterinaria['clinic_name'] ?? '') }}"
                 data-specialization="{{ strtolower($veterinaria['specialization'] ?? '') }}"
                 data-address="{{ strtolower($veterinaria['user']['profile']['address'] ?? '') }}"
                 data-license="{{ strtolower($veterinaria['veterinary_license'] ?? '') }}">
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

        <!-- Estado cuando no hay resultados -->
        <div id="no-results" class="hidden text-center py-12">
            <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No se encontraron veterinarias</h3>
            <p class="text-gray-500">Intenta ajustar los filtros de búsqueda.</p>
        </div>

      
    </div>
</div>

@push('scripts')
<script>
// Variables globales
let allVeterinarias = [];

// Inicializar cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Guardar todas las veterinarias
    allVeterinarias = Array.from(document.querySelectorAll('.veterinaria-card'));
    
    // Configurar event listeners
    setupFilters();
});

// Configurar filtros y búsqueda
function setupFilters() {
    const searchInput = document.getElementById('search-input');
    const filterSpecialization = document.getElementById('filter-specialization');
    const clearFilters = document.getElementById('clear-filters');
    
    // Evento de búsqueda en tiempo real
    searchInput.addEventListener('input', applyFilters);
    
    // Evento para filtro de especialización
    filterSpecialization.addEventListener('change', applyFilters);
    
    // Limpiar filtros
    clearFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterSpecialization.value = '';
        applyFilters();
    });
}

// Aplicar todos los filtros
function applyFilters() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const specializationFilter = document.getElementById('filter-specialization').value.toLowerCase();
    
    let visibleCount = 0;
    
    allVeterinarias.forEach(veterinaria => {
        const name = veterinaria.dataset.name;
        const specialization = veterinaria.dataset.specialization;
        const address = veterinaria.dataset.address;
        const license = veterinaria.dataset.license;
        
        // Verificar filtro de especialización
        const specializationMatch = !specializationFilter || 
                                   specialization.includes(specializationFilter);
        
        // Verificar búsqueda
        const searchMatch = !searchTerm || 
                           name.includes(searchTerm) || 
                           specialization.includes(searchTerm) || 
                           address.includes(searchTerm) || 
                           license.includes(searchTerm);
        
        // Mostrar u ocultar según los filtros
        if (specializationMatch && searchMatch) {
            veterinaria.style.display = 'block';
            visibleCount++;
        } else {
            veterinaria.style.display = 'none';
        }
    });
    
    // Actualizar contador
    document.getElementById('veterinarias-count').textContent = visibleCount;
    
    // Mostrar/ocultar mensaje de no resultados
    const noResults = document.getElementById('no-results');
    const veterinariasContainer = document.getElementById('veterinarias-container');
    
    if (visibleCount === 0) {
        noResults.classList.remove('hidden');
        veterinariasContainer.classList.add('hidden');
    } else {
        noResults.classList.add('hidden');
        veterinariasContainer.classList.remove('hidden');
    }
}
</script>

<style>
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.veterinaria-card {
    transition: all 0.3s ease;
}
</style>
@endpush
@endsection