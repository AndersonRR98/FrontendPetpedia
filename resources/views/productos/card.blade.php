@extends('layouts.app') {{-- Extiende tu layout principal --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">🛒 Carrito de Compras</h1>
    
    @if(count($cart) > 0)
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Producto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cantidad
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th class="px-6 py-3">
                            {{-- Acciones --}}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($cart as $id => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item['name'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${{ number_format($item['price'], 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item['quantity'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                {{-- Aquí puedes agregar un botón para eliminar --}}
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <div class="text-xl font-semibold">
                Subtotal: <span class="text-2xl text-green-600">${{ number_format($subtotal, 2) }}</span>
            </div>
        </div>

        <div class="mt-4 flex justify-end space-x-4">
            <a href="{{ url('/productos') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Seguir Comprando
            </a>
            <a href="#" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                Finalizar Compra
            </a>
        </div>
    @else
        <div class="p-4 text-center bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg" role="alert">
            ¡Tu carrito de compras está vacío!
        </div>
        <div class="mt-4 text-center">
             <a href="{{ url('/productos') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Ver Productos</a>
        </div>
    @endif
</div>
@endsection