@extends('layouts.app')   <!-- vista detalles de los productos -->

@section('title', ($producto['name'] ?? 'Producto') . ' - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-sky-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb mejorado -->
        <nav class="flex mb-10" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-3 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-300 flex items-center">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </li>
                <li class="flex items-center text-gray-400">
                    <i class="fas fa-chevron-right mx-2"></i>
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-300">Productos</a>
                </li>
                <li class="flex items-center text-gray-400">
                    <i class="fas fa-chevron-right mx-2"></i>
                    <span class="text-gray-600 font-semibold truncate max-w-xs">{{ $producto['name'] ?? 'Producto' }}</span>
                </li>
            </ol>
        </nav>

        <!-- Mensajes -->
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

        <div class="bg-gradient-to-br from-white via-blue-50 to-cyan-100 rounded-3xl shadow-2xl overflow-hidden border border-white/60">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Imagen del Producto Mejorada -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-100 to-cyan-200 rounded-3xl overflow-hidden shadow-2xl">
                        @php
                            $localImages = ['producto1.jpg','producto2.jpg','producto3.jpeg','producto4.jpg','producto5.jpg','producto6.jpg'];
                            $imageIndex = ($producto['id'] ?? 0) % count($localImages);
                            $localImage = $localImages[$imageIndex];
                        @endphp
                        <img 
                            src="{{ asset('images/productos/' . $localImage) }}" 
                            alt="{{ $producto['name'] ?? 'Producto' }}"
                            class="w-full h-96 object-cover hover:scale-105 transition-transform duration-500"
                            onerror="this.src='{{ asset('images/default-product.jpg') }}'"
                        >
                    </div>
                    
                    <!-- Badge de precio -->
                    <div class="absolute top-6 left-6">
                        <span class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-6 py-3 rounded-2xl text-lg font-bold shadow-2xl backdrop-blur-sm">
                            ${{ number_format($producto['price'] ?? 0, 2) }}
                        </span>
                    </div>

                    <!-- Estado de stock -->
                    <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-sm rounded-2xl px-4 py-2 shadow-lg">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-800 font-bold">En Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Información del Producto Mejorada -->
                <div class="space-y-8">
                    <!-- Header -->
                    <div>
                        <h1 class="text-4xl font-black text-gray-900 mb-4">{{ $producto['name'] ?? 'Nombre no disponible' }}</h1>
                        <div class="flex items-center space-x-6">
                            <span class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                                ${{ number_format($producto['price'] ?? 0, 2) }}
                            </span>
                            @if(isset($producto['category']))
                            <span class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-4 py-2 rounded-2xl text-sm font-bold">
                                {{ $producto['category']['name'] }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="bg-white/70 backdrop-blur-lg rounded-2xl p-6 shadow-xl border border-white/50">
                        <h3 class="text-xl font-black text-gray-900 mb-4 flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-file-alt text-blue-500"></i>
                            </div>
                            Descripción
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{ $producto['description'] ?? 'Descripción no disponible' }}
                        </p>
                    </div>

                    <!-- Información Adicional Mejorada -->
                    <div class="space-y-4">
                        @if(isset($producto['veterinary']))
                        <div class="flex items-center p-4 bg-gradient-to-r from-white to-indigo-50 rounded-2xl border border-indigo-100/50">
                            <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-clinic-medical text-indigo-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Veterinaria</p>
                                <p class="text-sm text-gray-600">{{ $producto['veterinary']['clinic_name'] ?? 'No especificada' }}</p>
                            </div>
                        </div>
                        @endif

                        @if(isset($producto['category']))
                        <div class="flex items-center p-4 bg-gradient-to-r from-white to-purple-50 rounded-2xl border border-purple-100/50">
                            <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-tag text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Categoría</p>
                                <p class="text-sm text-gray-600">{{ $producto['category']['name'] ?? 'No especificada' }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center p-4 bg-gradient-to-r from-white to-green-50 rounded-2xl border border-green-100/50">
                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-shipping-fast text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Envío disponible</p>
                                <p class="text-sm text-gray-600">Entrega en 2-3 días hábiles</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-gradient-to-r from-white to-emerald-50 rounded-2xl border border-emerald-100/50">
                            <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Disponible</p>
                                <p class="text-sm text-gray-600">En stock - Listo para enviar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones Mejoradas -->
                    <div class="pt-6 border-t border-gray-200/60">
                        <form action="{{ route('products.addToCart') }}" method="POST" class="space-y-6" id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto['id'] ?? '' }}">
                            <input type="hidden" name="name" value="{{ $producto['name'] ?? '' }}">
                            <input type="hidden" name="price" value="{{ $producto['price'] ?? 0 }}">
                            
                            <!-- Selector de cantidad mejorado -->
                            <div class="flex items-center space-x-6">
                                <label for="quantity" class="text-lg font-bold text-gray-700 flex items-center">
                                    <i class="fas fa-cubes mr-2 text-blue-500"></i>
                                    Cantidad:
                                </label>
                                <select name="quantity" id="quantity" class="bg-white/70 border-0 rounded-2xl px-6 py-3 focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-lg transition-all duration-300 text-lg">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Botones de acción mejorados -->
                            <div class="flex space-x-4">
                                <button type="submit" 
                                        class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-4 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center justify-center text-lg add-to-cart-btn">
                                    <i class="fas fa-shopping-cart mr-3 text-xl"></i>
                                    <span class="button-text">Agregar al Carrito</span>
                                </button>
                                <button type="button" 
                                        class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl hover:from-pink-600 hover:to-rose-600 transition-all duration-300 transform hover:scale-105 shadow-xl flex items-center justify-center favorite-btn">
                                    <i class="far fa-heart text-xl"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Botones adicionales -->
                        <div class="flex space-x-4 mt-4">
                            <a href="{{ route('products.index') }}" 
                               class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center text-lg">
                                <i class="fas fa-arrow-left mr-3"></i>
                                Volver a Productos
                            </a>
                            <a href="{{ route('products.cart') }}" 
                               class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold flex items-center justify-center text-lg">
                                <i class="fas fa-shopping-cart mr-3"></i>
                                Ver Carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
        50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
    }
    
    .bg-gradient-to-r.from-blue-500.to-cyan-600 {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fa-spin {
        animation: spin 1s linear infinite;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addToCartForm = document.getElementById('add-to-cart-form');
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    const buttonText = document.querySelector('.button-text');
    const favoriteBtn = document.querySelector('.favorite-btn');

    // Animación al agregar al carrito
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function(e) {
            const originalText = buttonText.textContent;
            
            // Animación de carga
            addToCartBtn.disabled = true;
            buttonText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Agregando...';
            
            // Restaurar después de 3 segundos si hay error
            setTimeout(() => {
                if (addToCartBtn.disabled) {
                    buttonText.textContent = originalText;
                    addToCartBtn.disabled = false;
                }
            }, 3000);
        });
    }

    // Animación de favoritos
    if (favoriteBtn) {
        favoriteBtn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-red-500');
                this.classList.add('from-red-500', 'to-pink-600');
            } else {
                icon.classList.remove('fas', 'text-red-500');
                icon.classList.add('far');
                this.classList.remove('from-red-500', 'to-pink-600');
            }
        });
    }
});
</script>
@endpush
@endsection