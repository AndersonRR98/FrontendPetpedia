@extends('layouts.app')  <!-- vista las ordenes pedidos -->

@section('title', 'Mis Pedidos - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-cyan-50 to-sky-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Mejorado -->
        <div class="mb-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-box text-white text-3xl"></i>
            </div>
            <h1 class="text-5xl font-black bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-4">
                Mis Pedidos
            </h1>
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

        @if(count($orders) === 0)
            <!-- Sin pedidos mejorado -->
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-3xl shadow-2xl mb-6">
                    <i class="fas fa-box-open text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black text-gray-700 mb-3">No has realizado pedidos aún</h3>
                <p class="text-gray-500 text-lg mb-8">Realiza tu primera compra para ver tus pedidos aquí</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-4 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-lg font-bold">
                    <i class="fas fa-shopping-bag mr-3"></i>
                    Comenzar a Comprar
                </a>
            </div>
        @else
            <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-white/60">
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="p-6 bg-gradient-to-r from-white to-blue-50 rounded-2xl border border-blue-100/50 hover:shadow-lg transition-all duration-300">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-center space-x-6">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-cyan-200 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-receipt text-blue-500 text-2xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-black text-gray-900">Pedido #{{ $order['id'] }}</p>
                                        <p class="text-gray-600 text-lg">
                                            <i class="fas fa-calendar mr-2 text-blue-500"></i>
                                            {{ \Carbon\Carbon::parse($order['order_date'])->format('d/m/Y') }}
                                        </p>
                                        <div class="flex items-center mt-2">
                                            <span class="text-lg font-bold {{ 
                                                $order['status'] == 'pendiente' ? 'text-yellow-600 bg-yellow-100 px-3 py-1 rounded-2xl' : 
                                                ($order['status'] == 'completado' ? 'text-green-600 bg-green-100 px-3 py-1 rounded-2xl' : 
                                                'text-red-600 bg-red-100 px-3 py-1 rounded-2xl') 
                                            }}">
                                                <i class="fas fa-circle text-xs mr-2"></i>
                                                {{ ucfirst($order['status']) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-3xl font-black bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                                    ${{ number_format($order['total_amount'],2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection