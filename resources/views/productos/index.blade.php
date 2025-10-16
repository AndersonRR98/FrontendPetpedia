@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-4 border-indigo-600 pb-2">Nuestros Productos</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        
        {{-- Simulando productos para el front-end --}}
        @php
            // Este es un array de productos simulados. DEBES reemplazar esto con la lógica
            // que trae los productos reales de la base de datos o de tu API.
            $products = [
                ['id' => 1, 'name' => 'Comida Premium para Perros', 'price' => 45.99, 'image' => 'https://placehold.co/300x200/4f46e5/ffffff?text=Comida+Perro'],
                ['id' => 2, 'name' => 'Rascador de Gatos Alto', 'price' => 75.50, 'image' => 'https://placehold.co/300x200/10b981/ffffff?text=Rascador+Gato'],
                ['id' => 3, 'name' => 'Collar Ajustable de Lujo', 'price' => 12.00, 'image' => 'https://placehold.co/300x200/f59e0b/ffffff?text=Collar'],
                ['id' => 4, 'name' => 'Juguete Interactivo para Mascotas', 'price' => 22.99, 'image' => 'https://placehold.co/300x200/ef4444/ffffff?text=Juguete'],
            ];
        @endphp

        @forelse($products as $product)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
            
            {{-- Enlace a la página de detalle --}}
            <a href="{{ route('products.show', $product['id']) }}">
                <img src="{{ $product['image'] ?? 'https://via.placeholder.com/300' }}" 
                     alt="{{ $product['name'] }}" 
                     class="w-full h-48 object-cover object-center transform hover:scale-105 transition-transform duration-500">
            </a>

            <div class="p-4">
                <h3 class="font-semibold text-xl text-gray-800 mb-1 truncate">
                    <a href="{{ route('products.show', $product['id']) }}" class="hover:text-indigo-600 transition-colors">
                        {{ $product['name'] }}
                    </a>
                </h3>
                
                {{-- Precio --}}
                <p class="text-2xl font-extrabold text-indigo-600 mb-4">${{ number_format($product['price'], 2) }}</p>
                
                {{-- Formulario para Añadir al Carrito (El ParseError se resuelve aquí) --}}
                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col space-y-3">
                    @csrf
                    {{-- Datos ocultos esenciales para el controlador --}}
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                    <input type="hidden" name="image" value="{{ $product['image'] ?? '' }}">

                    {{-- Campo de Cantidad (opcional, pero mejora la UX) --}}
                    <input type="number" name="quantity" value="1" min="1" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-center" required>
                    
                    {{-- ✅ BOTÓN DE SUBMIT AÑADIDO Y FUNCIONAL ✅ --}}
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition-colors shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Añadir al Carrito
                    </button>
                </form>
            </div>
        </div>
        @empty
            <p class="col-span-4 text-center text-gray-500 text-xl py-10">No se encontraron productos en este momento.</p>
        @endforelse
    </div>
</div>
@endsection
