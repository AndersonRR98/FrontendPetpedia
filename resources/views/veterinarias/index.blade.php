@extends('layouts.app')

@section('title', 'Veterinarias - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-cyan-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-paw text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Veterinarias
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Encuentra la mejor atención médica para tu compañero de cuatro patas
            </p>
        </div>

        <!-- Buscador y Filtros Mejorados -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 mb-12 border border-white/60">
            <div class="flex flex-col lg:flex-row gap-6 items-center">
                <div class="flex-1 relative w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400 text-lg"></i>
                    <input type="text" id="search-input"
                           placeholder="Buscar veterinaria, especialidad, ubicación..."
                           class="w-full bg-white/70 border-0 rounded-2xl px-12 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-purple-200 focus:bg-white shadow-lg transition-all duration-300 text-lg">
                </div>
                
                <select id="filter-specialization" class="bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 focus:bg-white shadow-lg transition-all duration-300 text-lg w-full lg:w-auto">
                    <option value="">Todas las especialidades</option>
                    <option value="medicina general">🏥 Medicina General</option>
                    <option value="cirugía">🔪 Cirugía</option>
                    <option value="dermatología">🔬 Dermatología</option>
                    <option value="cardiología">❤️ Cardiología</option>
                    <option value="oftalmología">👁️ Oftalmología</option>
                    <option value="odontología">🦷 Odontología</option>
                    <option value="neurología">🧠 Neurología</option>
                    <option value="oncología">🎗️ Oncología</option>
                </select>

                <button id="clear-filters" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center text-lg">
                    <i class="fas fa-eraser mr-3"></i> Limpiar
                </button>
            </div>
        </div>

        <!-- Contador de resultados mejorado -->
        <div class="mb-8">
            <div class="inline-flex items-center bg-white/80 backdrop-blur-lg rounded-2xl px-6 py-3 shadow-lg border border-white/60">
                <i class="fas fa-clinic-medical text-purple-500 text-xl mr-3"></i>
                <span class="text-gray-700 font-bold text-lg">
                    <span id="veterinarias-count" class="text-purple-600">{{ count($veterinarias) }}</span> veterinaria(s) encontrada(s)
                </span>
            </div>
        </div>

        <!-- Lista de Veterinarias Mejorada -->
        <div id="veterinarias-container" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($veterinarias as $veterinaria)
            @php
                // CORREGIDO: Usar el ID de la veterinaria para consistencia entre vistas
                $localImages = ['veterinaria1.jpg','veterinaria2.jpg','veterinaria3.jpg','veterinaria4.jpg','veterinaria5.jpg','veterinaria6.jpg'];
                $imageIndex = $veterinaria['id'] % count($localImages); // Usar ID en lugar de índice
                $localImage = $localImages[$imageIndex];
            @endphp
            
            <div class="veterinaria-card group relative bg-gradient-to-br from-white via-purple-50 to-indigo-100 rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-white/50"
                 data-name="{{ strtolower($veterinaria['clinic_name'] ?? '') }}"
                 data-specialization="{{ strtolower($veterinaria['specialization'] ?? '') }}"
                 data-address="{{ strtolower($veterinaria['user']['profile']['address'] ?? '') }}"
                 data-license="{{ strtolower($veterinaria['veterinary_license'] ?? '') }}">
                 
                <!-- Efecto de brillo al hover -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400/10 to-indigo-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>

                <!-- Imagen Local Mejorada -->
                <div class="h-64 relative overflow-hidden rounded-t-3xl">
                    <img src="{{ asset('images/veterinarias/' . $localImage) }}" 
                         alt="{{ $veterinaria['clinic_name'] }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         onerror="this.src='{{ asset('images/default-veterinaria.jpg') }}'">
                    
                    <!-- Gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    
                    <!-- Badge de especialización mejorado -->
                    <span class="absolute top-5 left-5 bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-5 py-2 rounded-2xl text-sm font-bold shadow-xl backdrop-blur-sm">
                        {{ $veterinaria['specialization'] ?? 'Veterinaria' }}
                    </span>

                    <!-- Rating stars -->
                    <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-sm rounded-2xl px-3 py-1 shadow-lg">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="text-gray-800 font-bold text-sm">4.8</span>
                        </div>
                    </div>
                </div>

                <!-- Información Mejorada -->
                <div class="p-7 relative z-10">
                    <h3 class="text-2xl font-black text-gray-900 mb-4 truncate group-hover:text-purple-600 transition-colors duration-300">
                        {{ $veterinaria['clinic_name'] }}
                    </h3>
                    
                    <div class="space-y-3 mb-6 text-gray-600">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-certificate text-green-500 text-sm"></i>
                            </div>
                            <span class="font-semibold">Lic. {{ $veterinaria['veterinary_license'] ?? 'En trámite' }}</span>
                        </div>
                        
@if($veterinaria['schedules'])
<div class="flex items-start">
    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 mt-0.5">
        <i class="fas fa-clock text-yellow-500 text-sm"></i>
    </div>
    <span class="font-medium">
        @php
            // CORRECCIÓN: Usar días en español como en la base de datos
            $schedules = is_string($veterinaria['schedules']) ? json_decode($veterinaria['schedules'], true) : $veterinaria['schedules'];
            $diasSemana = [
                'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'
            ];
            $hoy = $diasSemana[date('N') - 1]; // date('N') devuelve 1(lunes) a 7(domingo)
            $horarioHoy = $schedules[$hoy] ?? 'Cerrado';
            
            // CORRECCIÓN: Convertir array a string si es necesario
            if (is_array($horarioHoy)) {
                // Si es un array con horario de apertura y cierre
                if (count($horarioHoy) >= 2) {
                    $horarioHoy = $horarioHoy[0] . ' - ' . $horarioHoy[1];
                } else {
                    $horarioHoy = implode(' - ', $horarioHoy);
                }
            }
        @endphp
        <span class="text-gray-900">Hoy:</span> 
        @if($horarioHoy !== 'Cerrado' && $horarioHoy !== '')
            <span class="text-green-600 font-semibold">{{ $horarioHoy }}</span>
        @else
            <span class="text-red-500 font-semibold">Cerrado</span>
        @endif
    </span>
</div>
@endif
                        
                        @if(isset($veterinaria['user']['profile']['address']))
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-red-500 text-sm"></i>
                            </div>
                            <span class="font-medium">{{ $veterinaria['user']['profile']['address'] }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Botones mejorados -->
                    <div class="flex justify-between items-center pt-5 border-t border-gray-200/60">
                        <a href="{{ route('veterinarias.show', $veterinaria['id']) }}" 
                           class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-6 py-3 rounded-2xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center group/btn">
                            <i class="fas fa-eye mr-2 group-hover/btn:scale-110 transition-transform duration-300"></i> 
                            Ver Detalles
                        </a>
                        <div class="flex space-x-4">
                            <!-- Botón de favoritos solo visual -->
                            <button class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center text-pink-500 hover:bg-pink-500 hover:text-white transition-all duration-300 transform hover:scale-110 shadow-lg favorite-btn"
                                    title="Agregar a favoritos"
                                    data-veterinary-id="{{ $veterinaria['id'] }}">
                                <i class="far fa-heart"></i>
                            </button>
                            @if(isset($veterinaria['user']['profile']['phone']))
                            <a href="tel:{{ $veterinaria['user']['profile']['phone'] }}" class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-green-500 hover:bg-green-500 hover:text-white transition-all duration-300 transform hover:scale-110 shadow-lg" title="Llamar">
                                <i class="fas fa-phone"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-3xl shadow-2xl mb-6">
                    <i class="fas fa-clinic-medical text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black text-gray-700 mb-3">No hay veterinarias disponibles</h3>
                <p class="text-gray-500 text-lg">Pronto tendremos las mejores veterinarias para ti.</p>
            </div>
            @endforelse
        </div>

        <!-- No results mejorado -->
        <div id="no-results" class="hidden text-center py-20">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-purple-300 to-indigo-400 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-search text-white text-3xl"></i>
            </div>
            <h3 class="text-3xl font-black text-gray-700 mb-3">No se encontraron veterinarias</h3>
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
    
    .veterinaria-card:hover {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Scroll personalizado */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #8B5CF6, #6366F1);
        border-radius: 10px;
    }

    /* Animación para el corazón */
    .favorite-btn.animate-heart {
        animation: heartBeat 0.6s ease-in-out;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        25% { transform: scale(1.3); }
        50% { transform: scale(1.1); }
        75% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    /* Estado activo del corazón */
    .favorite-btn.active {
        background: linear-gradient(135deg, #ec4899, #db2777) !important;
    }
    
    .favorite-btn.active i {
        color: white !important;
    }

    /* Clase para ocultar elementos */
    .hidden-element {
        display: none !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const filterSpecialization = document.getElementById('filter-specialization');
    const clearFiltersBtn = document.getElementById('clear-filters');
    const veterinariasContainer = document.getElementById('veterinarias-container');
    const noResults = document.getElementById('no-results');
    const veterinariasCount = document.getElementById('veterinarias-count');
    const cards = document.querySelectorAll('.veterinaria-card');

    // Efectos de entrada para las tarjetas
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Función para filtrar veterinarias
    function filterVeterinarias() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const specializationFilter = filterSpecialization.value.toLowerCase();
        
        let visibleCount = 0;
        let hasVisibleCards = false;

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const specialization = card.getAttribute('data-specialization');
            const address = card.getAttribute('data-address');
            const license = card.getAttribute('data-license');
            
            let matchesSearch = false;
            let matchesSpecialization = false;

            // Verificar búsqueda
            if (searchTerm === '') {
                matchesSearch = true;
            } else {
                matchesSearch = name.includes(searchTerm) || 
                              specialization.includes(searchTerm) || 
                              address.includes(searchTerm) || 
                              license.includes(searchTerm);
            }

            // Verificar especialización
            if (specializationFilter === '') {
                matchesSpecialization = true;
            } else {
                matchesSpecialization = specialization.includes(specializationFilter);
            }

            // Mostrar/ocultar tarjeta
            if (matchesSearch && matchesSpecialization) {
                card.classList.remove('hidden-element');
                card.style.display = 'block';
                visibleCount++;
                hasVisibleCards = true;
                
                // Re-animar la aparición
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.4s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 50);
            } else {
                card.classList.add('hidden-element');
                card.style.display = 'none';
            }
        });

        // Mostrar/ocultar mensaje de no resultados
        if (hasVisibleCards) {
            noResults.classList.add('hidden');
            veterinariasContainer.classList.remove('hidden');
        } else {
            noResults.classList.remove('hidden');
            veterinariasContainer.classList.add('hidden');
        }

        // Actualizar contador
        veterinariasCount.textContent = visibleCount;
    }

    // Event listeners para filtros
    searchInput.addEventListener('input', filterVeterinarias);
    filterSpecialization.addEventListener('change', filterVeterinarias);

    // Limpiar filtros
    clearFiltersBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterSpecialization.value = '';
        filterVeterinarias();
        
        // Efecto visual al limpiar
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);
    });

    // Manejar el clic en el corazón (solo visual)
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const icon = this.querySelector('i');
            
            // Animación del corazón
            this.classList.add('animate-heart');
            
            // Alternar entre corazón vacío y lleno
            if (icon.classList.contains('far')) {
                // Cambiar a corazón lleno
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-red-500');
                this.classList.add('active');
            } else {
                // Cambiar a corazón vacío
                icon.classList.remove('fas', 'text-red-500');
                icon.classList.add('far');
                this.classList.remove('active');
            }
            
            // Remover la clase de animación después de que termine
            setTimeout(() => {
                this.classList.remove('animate-heart');
            }, 600);
        });
    });

    // Permitir buscar con Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            filterVeterinarias();
        }
    });
});
</script>
@endsection