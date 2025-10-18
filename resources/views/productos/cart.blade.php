@extends('layouts.app')

@section('title', 'Carrito - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Tu Carrito</h1>

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

        @if(count($cart) === 0)
            <p class="text-gray-600">Tu carrito está vacío</p>
        @else
            <form action="{{ route('products.storeCart') }}" method="POST">
                @csrf
                <div class="bg-white rounded-lg shadow p-6 space-y-4">
                    @foreach($cart as $item)
                        <div class="flex justify-between items-center border-b py-2">
                            <div>
                                <p class="font-semibold">{{ $item['name'] }}</p>
                                <p class="text-gray-500 text-sm">${{ number_format($item['price'],2) }} x {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-semibold">${{ number_format($item['price'] * $item['quantity'],2) }}</p>
                        </div>
                    @endforeach
                    <div class="flex justify-between items-center pt-4">
                        <p class="text-lg font-bold">Total:</p>
                        <p class="text-lg font-bold">${{ number_format($total,2) }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" 
                            class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-semibold">
                        Realizar Pedido
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
