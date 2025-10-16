@extends('layouts.app')

<<<<<<< HEAD
@section('title', $producto['name'] . ' - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Navegación -->
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-500 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a productos
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Imagen del Producto -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-gray-100 to-blue-100 rounded-lg overflow-hidden">
                        <img 
                            src="{{ asset('images/productos/producto1.jpg') }}" 
                            alt="{{ $producto['name'] }}"
                            class="w-full h-96 object-cover"
                            onerror="this.src='{{ asset('images/default-product.jpg') }}'"
                        >
                    </div>
                </div>

                <!-- Información del Producto -->
                <div class="space-y-6">
                    <!-- Header -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $producto['name'] }}</h1>
                        <div class="flex items-center space-x-4">
                            <span class="text-2xl font-bold text-green-600">${{ number_format($producto['price'], 2) }}</span>
                            @if(isset($producto['category']))
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $producto['category']['name'] }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Descripción</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $producto['description'] }}</p>
                    </div>

                    <!-- Información Adicional -->
                    <div class="space-y-4">
                        @if(isset($producto['veterinary']))
                        <div class="flex items-center">
                            <i class="fas fa-clinic-medical text-purple-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Veterinaria</p>
                                <p class="text-sm text-gray-600">{{ $producto['veterinary']['clinic_name'] }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center">
                            <i class="fas fa-shipping-fast text-green-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Envío disponible</p>
                                <p class="text-sm text-gray-600">Entrega en 2-3 días hábiles</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3 w-5"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Disponible</p>
                                <p class="text-sm text-gray-600">En stock</p>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="pt-6 border-t border-gray-200">
                        <form action="{{ route('products.addToCart') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto['id'] }}">
                            
                            <!-- Selector de cantidad -->
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-sm font-medium text-gray-700">Cantidad:</label>
                                <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex space-x-4">
                                <button type="submit" 
                                        class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold flex items-center justify-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Agregar al Carrito
                                </button>
                                <button type="button" 
                                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200 text-gray-700">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Relacionados -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Productos Relacionados</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Aquí podrías mostrar productos relacionados -->
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-paw text-4xl mb-4"></i>
                    <p>Productos relacionados</p>
                </div>
            </div>
        </div>
    </div>
