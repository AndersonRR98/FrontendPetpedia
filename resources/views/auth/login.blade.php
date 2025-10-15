@extends('layouts.tailwind')

@section('content')
<div class="min-h-screen bg-indigo-600 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <div class="flex items-center">
        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-12 w-auto">
        <span class="text-indigo-600 text-2xl font-bold ml-3">PetPedia</span>
      </div>
    </div>

    <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Iniciar sesión</h2>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">{{ $errors->first('login') }}</div>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="space-y-6">
      @csrf

      <div>
        <label class="block mb-2 font-semibold text-gray-700">Email</label>
        <input 
          type="email" 
          name="email" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          placeholder="tu@email.com"
          required
        >
      </div>

      <div>
        <label class="block mb-2 font-semibold text-gray-700">Contraseña</label>
        <input 
          type="password" 
          name="password" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          placeholder="••••••••"
          required
        >
      </div>

      <button 
        type="submit" 
        class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition duration-200 shadow-lg hover:shadow-xl"
      >
        Entrar
      </button>
    </form>

    <div class="mt-6 pt-6 border-t border-gray-200">
      <p class="text-center text-gray-600">
        ¿No tienes cuenta? 
        <a href="/register" class="text-indigo-600 font-semibold hover:text-indigo-500 hover:underline transition duration-200">
          Regístrate
        </a>
      </p>
    </div>
  </div>
</div>
@endsection