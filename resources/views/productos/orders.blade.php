@extends('layouts.app')

@section('title', 'Mis Pedidos - PetPedia')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Mis Pedidos</h1>

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

        @if(count($orders) === 0)
            <p class="text-gray-600">No has realizado pedidos aún.</p>
        @else
            <div class="bg-white rounded-lg shadow p-6 space-y-4">
                @foreach($orders as $order)
                    <div class="border-b py-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">Pedido #{{ $order['id'] }}</p>
                                <p class="text-gray-500 text-sm">
                                    Fecha: {{ \Carbon\Carbon::parse($order['order_date'])->format('d/m/Y') }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    Estado: 
                                    <span class="{{ $order['status'] == 'pendiente' ? 'text-yellow-600' : ($order['status'] == 'completado' ? 'text-green-600' : 'text-red-600') }}">
                                        {{ ucfirst($order['status']) }}
                                    </span>
                                </p>
                            </div>
                            <p class="font-semibold text-lg">${{ number_format($order['total_amount'],2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
