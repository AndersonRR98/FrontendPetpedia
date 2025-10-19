@extends('layouts.app')

@section('title', 'Adopciones - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-rose-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-paw text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Adopta una Mascota
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Encuentra a tu nuevo mejor amigo y dale el hogar que se merece
            </p>
        </div>

        <!-- Alertas Mejoradas -->
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

        <!-- Buscador y Filtros Mejorados -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 mb-12 border border-white/60">
            <div class="flex flex-col lg:flex-row gap-6 items-center">
                <div class="flex-1 relative w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-pink-400 text-lg"></i>
                    <input type="text" 
                           id="search-input"
                           placeholder="Buscar por nombre, raza, descripción..." 
                           class="w-full bg-white/70 border-0 rounded-2xl px-12 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-pink-200 focus:bg-white shadow-lg transition-all duration-300 text-lg">
                </div>
                
                <select id="filter-species" class="bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 focus:outline-none focus:ring-4 focus:ring-purple-200 focus:bg-white shadow-lg transition-all duration-300 text-lg w-full lg:w-auto">
                    <option value="">Todas las especies</option>
                    <option value="perro">🐕 Perro</option>
                    <option value="gato">🐱 Gato</option>
                    <option value="otro">🐾 Otros</option>
                </select>

                <button id="clear-filters" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center text-lg">
                    <i class="fas fa-eraser mr-3"></i> Limpiar
                </button>
            </div>
        </div>

        <!-- Contador de resultados mejorado -->
        <div class="mb-8">
            <div class="inline-flex items-center bg-white/80 backdrop-blur-lg rounded-2xl px-6 py-3 shadow-lg border border-white/60">
                <i class="fas fa-paw text-pink-500 text-xl mr-3"></i>
                <span class="text-gray-700 font-bold text-lg">
                    <span id="mascotas-count" class="text-pink-600">{{ count($mascotas) }}</span> mascota(s) disponible(s)
                </span>
            </div>
        </div>

        <!-- Lista de Mascotas Mejorada -->
        <div id="mascotas-container" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($mascotas as $index => $mascota)
            <div class="mascota-card group relative bg-gradient-to-br from-white via-pink-50 to-purple-100 rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-white/50"
                 data-name="{{ strtolower($mascota['name'] ?? '') }}"
                 data-species="{{ strtolower($mascota['species'] ?? '') }}"
                 data-breed="{{ strtolower($mascota['breed'] ?? '') }}"
                 data-description="{{ strtolower($mascota['description'] ?? '') }}">
                
                <!-- Efecto de brillo al hover -->
                <div class="absolute inset-0 bg-gradient-to-r from-pink-400/10 to-purple-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>

                <!-- Imagen Mejorada -->
                <div class="h-64 relative overflow-hidden rounded-t-3xl">
                    @php
                        $localImages = ['adopcion4.jpg', 'adopcion3.jpg', 'adopcion1.jpg'];
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp
                    <img src="{{ asset('images/adopciones/' . $localImage) }}" 
                         alt="{{ $mascota['name'] ?? 'Mascota' }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         onerror="this.src='{{ asset('images/default-pet.jpg') }}'">
                    
                    <!-- Gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    
                    <!-- Badge de especie mejorado -->
                    <span class="absolute top-5 left-5 bg-gradient-to-r from-pink-500 to-purple-600 text-white px-5 py-2 rounded-2xl text-sm font-bold shadow-xl backdrop-blur-sm">
                        {{ ucfirst($mascota['species'] ?? 'Mascota') }}
                    </span>

                    <!-- Estado de adopción -->
                    <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-sm rounded-2xl px-3 py-2 shadow-lg">
                        <div class="flex items-center space-x-1">
                            @if(($mascota['adoption_status'] ?? 'pending') === 'pending')
                                <i class="fas fa-heart text-pink-500 text-sm"></i>
                                <span class="text-gray-800 font-bold text-sm">Disponible</span>
                            @else
                                <i class="fas fa-heart-broken text-gray-400 text-sm"></i>
                                <span class="text-gray-600 font-bold text-sm">Adoptado</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Información Mejorada -->
                <div class="p-7 relative z-10">
                    <h3 class="text-2xl font-black text-gray-900 mb-4 truncate group-hover:text-pink-600 transition-colors duration-300">
                        {{ $mascota['name'] ?? 'Sin nombre' }}
                    </h3>
                    
                    <div class="space-y-3 mb-6 text-gray-600">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-dna text-blue-500 text-sm"></i>
                            </div>
                            <span class="font-semibold">{{ $mascota['breed'] ?? 'Raza mixta' }}</span>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3 mt-0.5">
                                <i class="fas fa-info-circle text-purple-500 text-sm"></i>
                            </div>
                            <p class="font-medium text-gray-700 leading-relaxed">
                                {{ $mascota['description'] ?? 'Un compañero leal esperando por ti.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Botón Solicitar Adopción Mejorado -->
                    <div class="flex justify-center pt-5 border-t border-gray-200/60">
                        <form action="{{ route('adopciones.store') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="adoption_id" value="{{ $mascota['id'] }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                            <input type="hidden" name="priority" value="medium">
                            <input type="hidden" name="application_status" value="pending">
                            <input type="hidden" name="trainer_id" value="">
                            
                            @if(($mascota['adoption_status'] ?? 'pending') === 'pending')
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white py-4 px-6 rounded-2xl hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center group/btn">
                                <i class="fas fa-heart mr-2 group-hover/btn:scale-110 transition-transform duration-300"></i> 
                                Solicitar Adopción
                            </button>
                            @else
                            <button type="button" 
                                    class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white py-4 px-6 rounded-2xl cursor-not-allowed shadow-lg font-bold flex items-center justify-center opacity-70">
                                <i class="fas fa-heart-broken mr-2"></i> 
                                Ya Adoptado
                            </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <!-- Estado vacío mejorado -->
            <div class="col-span-3 text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-3xl shadow-2xl mb-6">
                    <i class="fas fa-paw text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black text-gray-700 mb-3">No hay mascotas disponibles</h3>
                <p class="text-gray-500 text-lg mb-8">Pronto tendremos nuevas mascotas buscando hogar.</p>
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-pink-500 to-purple-600 text-white px-8 py-4 rounded-2xl hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Volver al Dashboard
                </a>
            </div>
            @endforelse
        </div>

        <!-- No resultados mejorado -->
        <div id="no-results" class="hidden text-center py-20">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-pink-300 to-purple-400 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-search text-white text-3xl"></i>
            </div>
            <h3 class="text-3xl font-black text-gray-700 mb-3">No se encontraron mascotas</h3>
            <p class="text-gray-500 text-lg">Intenta ajustar los filtros de búsqueda.</p>
        </div>
    </div>
</div>

<style>
    /* Animaciones personalizadas */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .mascota-card:hover {
        animation: float 3s ease-in-out infinite;
    }
</style>

@push('scripts')
<script>
let allMascotas = [];

document.addEventListener('DOMContentLoaded', function() {
    allMascotas = Array.from(document.querySelectorAll('.mascota-card'));
    setupFilters();
    
    // Efectos de entrada para las tarjetas
    const cards = document.querySelectorAll('.mascota-card');
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