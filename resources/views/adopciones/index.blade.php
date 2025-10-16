@extends('layouts.app')

@section('title', 'Adopciones - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Adopta una Mascota</h1>
            <p class="text-gray-600">
                <span id="mascotas-count">{{ count($mascotas) }}</span> mascota(s) disponibles para adopción
            </p>
        </div>

        <!-- Alertas -->
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <i class="fas fa-check-circle text-green-400 mt-1 mr-3"></i>
                <div>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <i class="fas fa-exclamation-triangle text-red-400 mt-1 mr-3"></i>
                <div>
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Buscador y Filtros -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           id="search-input"
                           placeholder="Buscar por nombre, raza o descripción..." 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex gap-4">
                    <select id="filter-species" class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Todas las especies</option>
                        <option value="perro">Perro</option>
                        <option value="gato">Gato</option>
                        <option value="otro">Otros</option>
                    </select>
                    <button id="clear-filters" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Limpiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Lista de Mascotas para Adopción -->
        <div id="mascotas-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($mascotas as $index => $mascota)
            <div class="mascota-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group" 
                 data-species="{{ strtolower($mascota['species'] ?? '') }}"
                 data-name="{{ strtolower($mascota['name'] ?? '') }}"
                 data-breed="{{ strtolower($mascota['breed'] ?? '') }}"
                 data-description="{{ strtolower($mascota['description'] ?? '') }}">
                <!-- Imagen Local -->
                <div class="h-48 bg-gradient-to-br from-purple-100 to-pink-100 relative overflow-hidden">
                    @php
                        // Definir imágenes locales para las mascotas
                        $localImages = [
                            'adopcion1.jpg',
                            'adopcion4.jpg', 
                            'adopcion3.jpg'
                        ];
                        
                        // Usar imagen cíclica basada en el índice
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp

                    <img 
                        src="{{ asset('images/adopciones/' . $localImage) }}" 
                        alt="{{ $mascota['name'] ?? 'Mascota' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        onerror="this.src='{{ asset('images/default-pet.jpg') }}'"
                    >
                    
                    <!-- Badge de estado de adopción -->
                    <div class="absolute top-4 left-4">
                        @php
                            $statusColor = match($mascota['adoption_status'] ?? 'pending') {
                                'pending' => 'bg-yellow-600',
                                'approved' => 'bg-green-600',
                                'rejected' => 'bg-red-600',
                                default => 'bg-indigo-600'
                            };
                            
                            $statusText = match($mascota['adoption_status'] ?? 'pending') {
                                'pending' => 'En Espera',
                                'approved' => 'Aprobado',
                                'rejected' => 'Rechazado',
                                default => 'Disponible'
                            };
                        @endphp
                        <span class="{{ $statusColor }} text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            {{ $statusText }}
                        </span>
                    </div>
                    
                    <!-- Overlay en hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300"></div>
                </div>
                
                <!-- Información -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $mascota['name'] ?? 'Sin nombre' }}</h3>
                    
                    <div class="space-y-2 mb-4">
                        <!-- Especie y Raza -->
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-paw text-purple-500 mr-2 w-4"></i>
                            <span class="flex-1">
                                {{ ucfirst($mascota['species'] ?? 'Mascota') }} 
                                @if(isset($mascota['breed']))
                                 - {{ $mascota['breed'] }}
                                @endif
                            </span>
                        </div>

                        <!-- Edad -->
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-birthday-cake text-blue-500 mr-2 w-4"></i>
                            <span class="flex-1">
                                {{ $mascota['age'] ?? '?' }} años
                            </span>
                        </div>

                        <!-- Género -->
                        <div class="flex items-center text-sm text-gray-600">
                            @php
                                $gender = $mascota['gender'] ?? 'male';
                                $genderIcon = $gender == 'male' ? 'fa-mars text-blue-500' : 'fa-venus text-pink-500';
                                $genderText = $gender == 'male' ? 'Macho' : 'Hembra';
                            @endphp
                            <i class="fas {{ $genderIcon }} mr-2 w-4"></i>
                            <span class="flex-1 capitalize">
                                {{ $genderText }}
                            </span>
                        </div>

                        <!-- Tamaño -->
                        @if(isset($mascota['size']))
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-ruler-combined text-green-500 mr-2 w-4"></i>
                            <span class="flex-1 capitalize">
                                {{ $mascota['size'] }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Descripción -->
                    @if(isset($mascota['description']))
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ $mascota['description'] }}
                        </p>
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <button onclick="openAdoptionModal({{ $mascota['id'] }}, '{{ addslashes($mascota['name'] ?? 'Mascota') }}')"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 text-sm font-semibold flex items-center 
                                       {{ ($mascota['adoption_status'] ?? 'pending') !== 'pending' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ ($mascota['adoption_status'] ?? 'pending') !== 'pending' ? 'disabled' : '' }}>
                            <i class="fas fa-heart mr-2"></i>
                            {{ ($mascota['adoption_status'] ?? 'pending') === 'pending' ? 'Solicitar Adopción' : 'No Disponible' }}
                        </button>
                        <div class="flex space-x-2">
                            <button class="text-gray-400 hover:text-red-500 transition duration-200" 
                                    title="Agregar a favoritos">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="text-gray-400 hover:text-blue-500 transition duration-200"
                                    onclick="sharePet({{ $mascota['id'] }})"
                                    title="Compartir">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-paw text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay mascotas disponibles para adopción</h3>
                <p class="text-gray-500">Pronto tendremos nuevas mascotas buscando hogar.</p>
            </div>
            @endforelse
        </div>

        <!-- Estado cuando no hay resultados -->
        <div id="no-results" class="hidden text-center py-12">
            <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No se encontraron mascotas</h3>
            <p class="text-gray-500">Intenta ajustar los filtros de búsqueda.</p>
        </div>

        <!-- Información sobre las imágenes -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>💡 <strong>Nota:</strong> Las imágenes mostradas son de referencia local</p>
        </div>
    </div>
</div>

<!-- Modal de Formulario de Adopción -->
<div id="adoption-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-2xl font-bold text-gray-900">Solicitud de Adopción</h3>
            <button onclick="closeAdoptionModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <form id="adoption-form" action="{{ route('adopciones.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" id="pet_id" name="pet_id">
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-3 text-lg"></i>
                    <div>
                        <h4 class="font-semibold text-blue-800">Estás solicitando adoptar a: <span id="pet-name" class="font-bold"></span></h4>
                        <p class="text-blue-600 text-sm mt-1">Completa el formulario para enviar tu solicitud</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                    <input type="text" id="name" name="name" required 
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3"
                           placeholder="Tu nombre completo">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                    <input type="email" id="email" name="email" required 
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3"
                           placeholder="tu@email.com">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono *</label>
                    <input type="tel" id="phone" name="phone" required 
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3"
                           placeholder="+1 234 567 8900">
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Dirección *</label>
                    <input type="text" id="address" name="address" required 
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3"
                           placeholder="Tu dirección completa">
                </div>
            </div>

            <div>
                <label for="experience" class="block text-sm font-medium text-gray-700">
                    ¿Tienes experiencia previa con mascotas? *
                </label>
                <select id="experience" name="experience" required 
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3">
                    <option value="">Selecciona una opción</option>
                    <option value="si">Sí, tengo experiencia</option>
                    <option value="no">No, sería mi primera mascota</option>
                </select>
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">
                    ¿Por qué quieres adoptar esta mascota? *
                </label>
                <textarea id="comment" name="comment" rows="4" required 
                          class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4 py-3"
                          placeholder="Cuéntanos sobre tu situación familiar, tu hogar y por qué crees que serías un buen dueño..."></textarea>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex">
                    <i class="fas fa-exclamation-triangle text-yellow-400 mt-1 mr-3"></i>
                    <div>
                        <h4 class="text-sm font-medium text-yellow-800">Importante</h4>
                        <p class="text-sm text-yellow-700 mt-1">
                            La adopción es una responsabilidad de por vida. Asegúrate de estar preparado 
                            para brindar los cuidados necesarios, tiempo y recursos que tu nueva mascota necesitará.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <button type="button" onclick="closeAdoptionModal()" 
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 font-semibold">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Enviar Solicitud
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Variables globales
let allMascotas = [];

// Inicializar cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Guardar todas las mascotas
    allMascotas = Array.from(document.querySelectorAll('.mascota-card'));
    
    // Configurar event listeners
    setupFilters();
});

// Configurar filtros y búsqueda
function setupFilters() {
    const searchInput = document.getElementById('search-input');
    const filterSpecies = document.getElementById('filter-species');
    const clearFilters = document.getElementById('clear-filters');
    
    // Evento de búsqueda en tiempo real
    searchInput.addEventListener('input', applyFilters);
    
    // Evento para filtro de especie
    filterSpecies.addEventListener('change', applyFilters);
    
    // Limpiar filtros
    clearFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterSpecies.value = '';
        applyFilters();
    });
}

// Aplicar todos los filtros
function applyFilters() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const speciesFilter = document.getElementById('filter-species').value;
    
    let visibleCount = 0;
    
    allMascotas.forEach(mascota => {
        const species = mascota.dataset.species;
        const name = mascota.dataset.name;
        const breed = mascota.dataset.breed;
        const description = mascota.dataset.description;
        
        // Verificar filtro de especie
        const speciesMatch = !speciesFilter || species === speciesFilter;
        
        // Verificar búsqueda
        const searchMatch = !searchTerm || 
                           name.includes(searchTerm) || 
                           breed.includes(searchTerm) || 
                           description.includes(searchTerm);
        
        // Mostrar u ocultar según los filtros
        if (speciesMatch && searchMatch) {
            mascota.style.display = 'block';
            visibleCount++;
        } else {
            mascota.style.display = 'none';
        }
    });
    
    // Actualizar contador
    document.getElementById('mascotas-count').textContent = visibleCount;
    
    // Mostrar/ocultar mensaje de no resultados
    const noResults = document.getElementById('no-results');
    const mascotasContainer = document.getElementById('mascotas-container');
    
    if (visibleCount === 0) {
        noResults.classList.remove('hidden');
        mascotasContainer.classList.add('hidden');
    } else {
        noResults.classList.add('hidden');
        mascotasContainer.classList.remove('hidden');
    }
}

// Funciones del modal (existentes)
function openAdoptionModal(petId, petName) {
    document.getElementById('pet_id').value = petId;
    document.getElementById('pet-name').textContent = petName;
    document.getElementById('adoption-modal').classList.remove('hidden');
}

function closeAdoptionModal() {
    document.getElementById('adoption-modal').classList.add('hidden');
    document.getElementById('adoption-form').reset();
}

function sharePet(petId) {
    if (navigator.share) {
        navigator.share({
            title: 'Mascota en adopción - PetPedia',
            text: 'Mira esta mascota que necesita un hogar',
            url: window.location.href + '/' + petId
        });
    } else {
        alert('Comparte este enlace: ' + window.location.href + '/' + petId);
    }
}

// Cerrar modal al hacer clic fuera
document.getElementById('adoption-modal').addEventListener('click', function(e) {
    if (e.target.id === 'adoption-modal') {
        closeAdoptionModal();
    }
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.mascota-card {
    transition: all 0.3s ease;
}
</style>
@endpush