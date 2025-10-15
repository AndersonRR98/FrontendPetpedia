@extends('layouts.app')

@section('title', 'Detalles - PetPedia')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('adopciones.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 mb-6">
        <i class="fas fa-arrow-left mr-2"></i>
        Volver
    </a>

    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $pet['name'] }}</h1>
        <p class="text-gray-600 mb-6">{{ $pet['description'] }}</p>
        
        <form action="{{ route('adopciones.adopt', $pet['id']) }}" method="POST">
            @csrf
            <textarea name="comment" rows="4" required
                      class="w-full px-4 py-2 border rounded-lg mb-4"
                      placeholder="¿Por qué quieres adoptar?"></textarea>
            
            <button type="submit" class="bg-pink-600 text-white px-6 py-3 rounded-lg hover:bg-pink-700">
                Solicitar Adopción
            </button>
        </form>
    </div>
</div>
@endsection