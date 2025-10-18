@extends('layouts.app')
@section('title', 'Adopciones - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-1">Adopta una Mascota</h1>
            <p class="text-gray-600 text-sm">
                <span id="mascotas-count">{{ count($mascotas) }}</span> mascota(s) disponibles para adopción
            </p>
        </div>

        <!-- Alertas -->
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
            <div class="flex">
                <i class="fas fa-check-circle text-green-400 mt-1 mr-3"></i>
                <div>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
            <div class="flex">
                <i class="fas fa-exclamation-triangle text-red-400 mt-1 mr-3"></i>
                <div>
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Buscador y Filtros -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-1 w-full">
                    <input type="text" 
                           id="search-input"
                           placeholder="Buscar por nombre, raza o descripción..." 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                </div>
                <div class="flex gap-2 md:gap-4">
                    <select id="filter-species" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        <option value="">Todas las especies</option>
                        <option value="perro">Perro</option>
                        <option value="gato">Gato</option>
                        <option value="otro">Otros</option>
                    </select>
                    <button id="clear-filters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center text-sm">
                        <i class="fas fa-times mr-1"></i> Limpiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="mb-4">
            <p class="text-gray-600">
                <span id="mascotas-count">{{ count($mascotas) }}</span> mascota(s) encontrada(s)
            </p>
        </div>

        <!-- Lista de Mascotas -->
        <div id="mascotas-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($mascotas as $index => $mascota)
            <div class="mascota-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group"
                 data-name="{{ strtolower($mascota['name'] ?? '') }}"
                 data-species="{{ strtolower($mascota['species'] ?? '') }}"
                 data-breed="{{ strtolower($mascota['breed'] ?? '') }}"
                 data-description="{{ strtolower($mascota['description'] ?? '') }}">
                
                <!-- Imagen -->
                <div class="h-48 bg-gradient-to-br from-purple-100 to-pink-100 relative overflow-hidden">
                    @php
                        $localImages = ['adopcion4.jpg', 'adopcion3.jpg', 'adopcion1.jpg'];
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp
                    <img src="{{ asset('images/adopciones/' . $localImage) }}" 
                         alt="{{ $mascota['name'] ?? 'Mascota' }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                         onerror="this.src='{{ asset('images/default-pet.jpg') }}'">
                </div>

                <!-- Información -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $mascota['name'] ?? 'Sin nombre' }}</h3>
                    <p class="text-sm text-gray-600 mb-3">{{ $mascota['description'] ?? 'Sin descripción' }}</p>
                    <p class="text-sm text-gray-600 mb-3"><strong>Raza:</strong> {{ $mascota['breed'] ?? 'Desconocida' }}</p>
                    <p class="text-sm text-gray-600 mb-3"><strong>Especie:</strong> {{ ucfirst($mascota['species'] ?? 'Desconocida') }}</p>

                    <!-- Botón Solicitar Adopción -->
                    <div class="flex justify-center pt-4 border-t border-gray-100">
                        <form action="{{ route('adopciones.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="adoption_id" value="{{ $mascota['id'] }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                            <input type="hidden" name="priority" value="medium">
                            <input type="hidden" name="application_status" value="pending">
                            <input type="hidden" name="trainer_id" value="">
                            <button type="submit" 
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 text-sm font-semibold
                                           {{ ($mascota['adoption_status'] ?? 'pending') !== 'pending' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ ($mascota['adoption_status'] ?? 'pending') !== 'pending' ? 'disabled' : '' }}>
                                {{ ($mascota['adoption_status'] ?? 'pending') === 'pending' ? 'Solicitar Adopción' : 'No Disponible' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-paw text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay mascotas disponibles</h3>
                <p class="text-gray-500">Pronto tendremos nuevas mascotas buscando hogar.</p>
            </div>
            @endforelse
        </div>

        <!-- No resultados -->
        <div id="no-results" class="hidden text-center py-12">
            <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No se encontraron mascotas</h3>
            <p class="text-gray-500">Intenta ajustar los filtros de búsqueda.</p>
        </div>

        
    </div>
</div>

@push('scripts')
<script>
let allMascotas = [];

document.addEventListener('DOMContentLoaded', function() {
    allMascotas = Array.from(document.querySelectorAll('.mascota-card'));
    setupFilters();
});

function setupFilters() {
    const searchInput = document.getElementById('search-input');
    const filterSpecies = document.getElementById('filter-species');
    const clearFilters = document.getElementById('clear-filters');

    searchInput.addEventListener('input', applyFilters);
    filterSpecies.addEventListener('change', applyFilters);

    clearFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterSpecies.value = '';
        applyFilters();
    });
}

function applyFilters() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const speciesFilter = document.getElementById('filter-species').value.toLowerCase();

    let visibleCount = 0;

    allMascotas.forEach(card => {
        const name = card.dataset.name;
        const species = card.dataset.species;
        const breed = card.dataset.breed;
        const description = card.dataset.description;

        const matchesSpecies = !speciesFilter || species.includes(speciesFilter);
        const matchesSearch = !searchTerm || name.includes(searchTerm) || breed.includes(searchTerm) || description.includes(searchTerm);

        if(matchesSpecies && matchesSearch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('mascotas-count').textContent = visibleCount;

    const noResults = document.getElementById('no-results');
    const container = document.getElementById('mascotas-container');
    if(visibleCount === 0){
        noResults.classList.remove('hidden');
        container.classList.add('hidden');
    } else {
        noResults.classList.add('hidden');
        container.classList.remove('hidden');
    }
}
</script>
@endpush
@endsection
