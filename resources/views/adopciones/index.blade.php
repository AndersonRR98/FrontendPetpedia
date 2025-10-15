@extends('layouts.app')

@section('title', 'Adopciones - PetPedia')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">
        <i class="fas fa-heart text-pink-600 mr-3"></i>
        Adopta una Mascota
    </h1>

    @if(isset($pets) && count($pets) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pets as $pet)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
            <div class="relative h-64 bg-gradient-to-br from-pink-100 to-purple-100">
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fas fa-paw text-6xl text-pink-300"></i>
                </div>
                
                @if($pet['urgent'])
                <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    Urgente
                </div>
                @endif
            </div>

            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $pet['name'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $pet['description'] }}</p>
                <a href="{{ route('adopciones.show', $pet['id']) }}" 
                   class="block bg-pink-600 text-white text-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                    Ver detalles
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <i class="fas fa-paw text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-2xl font-semibold text-gray-700 mb-2">No hay mascotas disponibles</h3>
    </div>
    @endif
</div>
@endsection