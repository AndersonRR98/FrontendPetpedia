@extends('layouts.app')

@section('title', 'Productos - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-sky-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-shopping-bag text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-4">
                Productos para Mascotas
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Descubre los mejores productos para el cuidado y diversión de tu compañero
            </p>
        </div>

        <!-- Botones de acción mejorados -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-12">
            <a href="{{ route('products.cart') }}" 
               class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-4 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center">
                <i class="fas fa-shopping-cart mr-3 text-xl"></i>
                Ver Carrito
                <span class="bg-white text-blue-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold ml-3" id="cart-count">
                    {{ count(session('cart', [])) }}
                </span>
            </a>
            
            <a href="{{ route('products.myOrders') }}" 
               class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center">
                <i class="fas fa-box mr-3 text-xl"></i>
                Mis Pedidos
            </a>
        </div>

        <!-- Mensajes mejorados -->
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
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400 text-lg"></i>
                    <input type="text" 
                           id="search-input"
                           placeholder="Buscar productos por nombre, descripción..." 
                           class="w-full bg-white/70 border-0 rounded-2xl px-12 py-4 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-200 focus:bg-white shadow-lg transition-all duration-300 text-lg">
                </div>
                
                <select id="filter-sort" class="bg-white/70 border-0 rounded-2xl px-6 py-4 text-gray-700 focus:outline-none focus:ring-4 focus:ring-cyan-200 focus:bg-white shadow-lg transition-all duration-300 text-lg w-full lg:w-auto">
                    <option value="">Ordenar por</option>
                    <option value="price_asc">💰 Precio: Menor a Mayor</option>
                    <option value="price_desc">💰 Precio: Mayor a Menor</option>
                    <option value="name_asc">🔤 Nombre A-Z</option>
                    <option value="name_desc">🔤 Nombre Z-A</option>
                </select>

                <button id="clear-filters" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold flex items-center text-lg">
                    <i class="fas fa-eraser mr-3"></i> Limpiar
                </button>
            </div>
        </div>

        <!-- Contador de resultados mejorado -->
        <div class="mb-8">
            <div class="inline-flex items-center bg-white/80 backdrop-blur-lg rounded-2xl px-6 py-3 shadow-lg border border-white/60">
                <i class="fas fa-cube text-blue-500 text-xl mr-3"></i>
                <span class="text-gray-700 font-bold text-lg">
                    <span id="productos-count" class="text-blue-600">{{ count($productos) }}</span> producto(s) disponible(s)
                </span>
            </div>
        </div>

        <!-- Lista de Productos Mejorada -->
        <div id="productos-container" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($productos as $index => $producto)
            <div class="producto-card group relative bg-gradient-to-br from-white via-blue-50 to-cyan-100 rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-white/50"
                 data-name="{{ strtolower($producto['name'] ?? '') }}"
                 data-description="{{ strtolower($producto['description'] ?? '') }}"
                 data-price="{{ $producto['price'] ?? 0 }}"
                 data-veterinary="{{ strtolower($producto['veterinary']['clinic_name'] ?? '') }}">

                <!-- Efecto de brillo al hover -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400/10 to-cyan-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>

                <!-- Imagen del Producto Mejorada -->
                <div class="h-64 relative overflow-hidden rounded-t-3xl">
                    @php
                        $localImages = ['producto1.jpg','producto2.jpg','producto3.jpeg','producto4.jpg','producto5.jpg','producto6.jpg'];
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp

                    <img 
                        src="{{ asset('images/productos/' . $localImage) }}" 
                        alt="{{ $producto['name'] ?? 'Producto' }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                        onerror="this.src='{{ asset('images/default-product.jpg') }}'"
                    >
                    
                    <!-- Gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    
                    <!-- Badge de precio mejorado -->
                    <span class="absolute top-5 left-5 bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-5 py-2 rounded-2xl text-sm font-bold shadow-xl backdrop-blur-sm">
                        ${{ number_format($producto['price'] ?? 0, 2) }}
                    </span>

                    <!-- Estado de disponibilidad -->
                    <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-sm rounded-2xl px-3 py-2 shadow-lg">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-check-circle text-green-500 text-sm"></i>
                            <span class="text-gray-800 font-bold text-sm">Stock</span>
                        </div>
                    </div>
                </div>
                
                <!-- Información del Producto Mejorada -->
                <div class="p-7 relative z-10">
                    <h3 class="text-2xl font-black text-gray-900 mb-4 truncate group-hover:text-blue-600 transition-colors duration-300">
                        {{ $producto['name'] ?? 'Nombre no disponible' }}
                    </h3>
                    
                    <p class="text-gray-600 mb-6 leading-relaxed line-clamp-2">
                        {{ $producto['description'] ?? 'Descripción no disponible' }}
                    </p>
                    
                    <div class="space-y-3 mb-6">
                        <!-- Categoría -->
                        @if(isset($producto['category_id']) || isset($producto['category']))
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tag text-purple-500 text-sm"></i>
                            </div>
                            <span class="font-semibold text-gray-700">
                                @if(isset($producto['category']['name']))
                                    {{ $producto['category']['name'] }}
                                @else
                                    Categoría #{{ $producto['category_id'] ?? 'N/A' }}
                                @endif
                            </span>
                        </div>
                        @endif

                        <!-- Veterinaria -->
                        @if(isset($producto['veterinary_id']) || isset($producto['veterinary']))
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-clinic-medical text-indigo-500 text-sm"></i>
                            </div>
                            <span class="font-semibold text-gray-700 truncate">
                                @if(isset($producto['veterinary']['clinic_name']))
                                    {{ $producto['veterinary']['clinic_name'] }}
                                @else
                                    Veterinaria #{{ $producto['veterinary_id'] ?? 'N/A' }}
                                @endif
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Acciones Mejoradas -->
                    <div class="flex justify-between items-center pt-5 border-t border-gray-200/60">
                        <form action="{{ route('products.addToCart') }}" method="POST" class="flex-1 mr-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto['id'] }}">
                            <input type="hidden" name="name" value="{{ $producto['name'] }}">
                            <input type="hidden" name="price" value="{{ $producto['price'] }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-500 to-cyan-600 text-white py-4 px-6 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center group/btn">
                                <i class="fas fa-shopping-cart mr-2 group-hover/btn:scale-110 transition-transform duration-300"></i> 
                                Agregar
                            </button>
                        </form>

                        <div class="flex space-x-3">
                            <a href="{{ route('products.show', $producto['id'] ?? '') }}" 
                               class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 transform hover:scale-110 shadow-lg"
                               title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="w-12 h-12 bg-pink-100 rounded-2xl flex items-center justify-center text-pink-500 hover:bg-pink-500 hover:text-white transition-all duration-300 transform hover:scale-110 shadow-lg" 
                                    title="Agregar a favoritos">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Estado vacío mejorado -->
            <div class="col-span-3 text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-3xl shadow-2xl mb-6">
                    <i class="fas fa-shopping-bag text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black text-gray-700 mb-3">No hay productos disponibles</h3>
                <p class="text-gray-500 text-lg mb-8">No se pudieron cargar los productos desde la API.</p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 max-w-md mx-auto">
                    <p class="text-sm text-yellow-800 flex items-center">
                        <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
                        <strong>Nota:</strong> Esto puede ser porque la API no tiene productos o hay un error de conexión.
                    </p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- No resultados mejorado -->
        <div id="no-results" class="hidden text-center py-20">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-300 to-cyan-400 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-search text-white text-3xl"></i>
            </div>
            <h3 class="text-3xl font-black text-gray-700 mb-3">No se encontraron productos</h3>
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
    
    .producto-card:hover {
        animation: float 3s ease-in-out infinite;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@push('scripts')
<script>
let allProductos = [];

document.addEventListener('DOMContentLoaded', function() {
    allProductos = Array.from(document.querySelectorAll('.producto-card'));
    setupFilters();
    
    // Efectos de entrada para las tarjetas
    const cards = document.querySelectorAll('.producto-card');
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

// ... (el resto del JavaScript se mantiene igual)
</script>
@endpush
@endsection