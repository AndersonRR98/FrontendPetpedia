@extends('layouts.app')

@section('title', 'Productos - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header con botón de carrito -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Productos para Mascotas</h1>
                <p class="text-gray-600">Encuentra los mejores productos para el cuidado de tu mascota</p>
            </div>
            <!-- Botón del carrito -->
            <a href="#" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i>
                Ver Carrito
                <span class="bg-white text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold ml-2">
                    {{ count($productos) > 0 ? count($productos) : 0 }}
                </span>
            </a>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
        @endif

        <!-- Buscador y Filtros -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Buscar productos..." 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex gap-4">
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Todas las categorías</option>
                        <option>Alimentos</option>
                        <option>Juguetes</option>
                        <option>Medicamentos</option>
                        <option>Accesorios</option>
                        <option>Higiene</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Ordenar por</option>
                        <option>Precio: Menor a Mayor</option>
                        <option>Precio: Mayor a Menor</option>
                        <option>Nombre A-Z</option>
                        <option>Nombre Z-A</option>
                    </select>
                    <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Lista de Productos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($productos as $index => $producto)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 group">
                <!-- Imagen del Producto -->
                <div class="h-48 bg-gradient-to-br from-gray-100 to-blue-100 relative overflow-hidden">
                    @php
                        // Definir imágenes locales para los productos
                        $localImages = [
                            'producto1.jpg',
                            'producto2.jpg', 
                            'producto3.jpeg',
                            'producto4.jpg',
                            'producto5.jpg',
                            'producto6.jpg'
                        ];
                        
                        // Usar imagen cíclica basada en el índice
                        $imageIndex = $index % count($localImages);
                        $localImage = $localImages[$imageIndex];
                    @endphp

                    <img 
                        src="{{ asset('images/productos/' . $localImage) }}" 
                        alt="{{ $producto['name'] ?? 'Producto' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        onerror="this.src='{{ asset('images/default-product.jpg') }}'"
                    >
                    
                    <!-- Badge de precio -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            ${{ number_format($producto['price'] ?? 0, 2) }}
                        </span>
                    </div>
                    
                    <!-- Overlay en hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300"></div>
                </div>
                
                <!-- Información del Producto -->
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2 truncate">
                        {{ $producto['name'] ?? 'Nombre no disponible' }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $producto['description'] ?? 'Descripción no disponible' }}
                    </p>
                    
                    <div class="space-y-2 mb-4">
                        <!-- Categoría -->
                        @if(isset($producto['category_id']) || isset($producto['category']))
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-tag text-blue-500 mr-2 w-4"></i>
                            <span class="flex-1">
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
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clinic-medical text-purple-500 mr-2 w-4"></i>
                            <span class="flex-1 truncate">
                                @if(isset($producto['veterinary']['clinic_name']))
                                    {{ $producto['veterinary']['clinic_name'] }}
                                @else
                                    Veterinaria #{{ $producto['veterinary_id'] ?? 'N/A' }}
                                @endif
                            </span>
                        </div>
                        @endif

                        <!-- Disponibilidad -->
                        <div class="flex items-center text-sm text-green-600">
                            <i class="fas fa-check-circle mr-2 w-4"></i>
                            <span class="flex-1">Disponible</span>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <form action="{{ route('products.addToCart') }}" method="POST" class="flex-1 mr-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto['id'] ?? '' }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" 
                                    class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 text-sm font-semibold flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Agregar al Carrito
                            </button>
                        </form>
                        <div class="flex space-x-2">
                            <a href="{{ route('products.show', $producto['id'] ?? '') }}" 
                               class="text-gray-400 hover:text-indigo-500 transition duration-200 p-2"
                               title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="text-gray-400 hover:text-red-500 transition duration-200 p-2" 
                                    title="Agregar a favoritos">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-12">
                <i class="fas fa-shopping-bag text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No hay productos disponibles</h3>
                <p class="text-gray-500">No se pudieron cargar los productos desde la API.</p>
                <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4 max-w-md mx-auto">
                    <p class="text-sm text-yellow-800">
                        <strong>Nota:</strong> Esto puede ser porque la API no tiene productos o hay un error de conexión.
                    </p>
                </div>
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
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection