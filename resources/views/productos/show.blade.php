@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-6xl">
    
    {{-- Mensajes de Notificación --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white p-8 rounded-xl shadow-lg">
        
        {{-- Sección de Imagen --}}
        <div>
            <img src="{{ $product['image'] ?? 'https://via.placeholder.com/600/6366F1/FFFFFF?text=Producto' }}" 
                 alt="{{ $product['name'] }}" 
                 class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-100">
        </div>

        {{-- Sección de Información y Compra --}}
        <div class="space-y-6">
            <h1 class="text-4xl font-extrabold text-gray-900 border-b pb-3">{{ $product['name'] }}</h1>
            
            {{-- Precio --}}
            <div class="flex items-center space-x-4">
                <span class="text-4xl font-bold text-blue-600">${{ number_format($product['price'], 2) }}</span>
                {{-- Asumimos un campo 'stock' o similar en la API, si no existe, puedes quitar esta línea --}}
                <span class="text-sm font-semibold px-3 py-1 rounded-full 
                             @if(isset($product['stock']) && $product['stock'] > 0) bg-green-100 text-green-700 @else bg-red-100 text-red-700 @endif">
                    @if(isset($product['stock']) && $product['stock'] > 0) En Stock @else Agotado @endif
                </span>
            </div>

            {{-- Descripción (Usando tu campo 'description') --}}
            <div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Acerca del Producto</h3>
                <p class="text-gray-600 leading-relaxed">{{ $product['description'] }}</p>
            </div>
            
            {{-- Detalle Adicional (Veterinaria) --}}
            @if(isset($product['veterinary_id']))
            <div class="border-t pt-4">
                <p class="text-sm text-gray-500">
                    <i class="fas fa-clinic-medical mr-2"></i> 
                    Producto ofrecido por la veterinaria #{{ $product['veterinary_id'] }}
                </p>
            </div>
            @endif

            {{-- Formulario para Añadir al Carrito --}}
            @if(!isset($product['stock']) || $product['stock'] > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="pt-4 border-t">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                <input type="hidden" name="name" value="{{ $product['name'] }}">
                <input type="hidden" name="price" value="{{ $product['price'] }}">
                <input type="hidden" name="image" value="{{ $product['image'] ?? '' }}">
                
                {{-- Campo para cantidad (opcional, por defecto 1) --}}
                <div class="mb-4 flex items-center space-x-4">
                    <label for="quantity" class="text-lg font-medium text-gray-700">Cantidad:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center" required>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-bold hover:bg-blue-700 transition duration-300 shadow-md">
                    <i class="fas fa-cart-plus mr-2"></i> Añadir al Carrito
                </button>
            </form>
            @else
                <button disabled class="w-full bg-gray-400 text-white py-3 rounded-lg text-lg font-bold cursor-not-allowed">
                    Agotado Temporalmente
                </button>
            @endif
        </div>
    </div>
    
    {{-- Sección de Productos Relacionados (Opcional) --}}
    @if(isset($relatedProducts) && !empty($relatedProducts))
    <hr class="my-10">
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Productos Relacionados</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($relatedProducts as $related)
            <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition duration-300 overflow-hidden">
                <a href="{{ route('products.show', $related['id']) }}">
                    <img src="{{ $related['image'] ?? 'https://via.placeholder.com/200' }}" alt="{{ $related['name'] }}" class="w-full h-32 object-cover">
                    <div class="p-3">
                        <h3 class="font-semibold text-sm truncate">{{ $related['name'] }}</h3>
                        <p class="text-md font-bold text-blue-500 mt-1">${{ number_format($related['price'], 2) }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection