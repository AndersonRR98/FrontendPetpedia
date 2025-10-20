@extends('layouts.tailwind')  <!-- vista de inicio de sesion-->

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
  <!-- Background Animation -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
  </div>

  <div class="w-full max-w-md bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 relative z-10 border border-white/20">
    <!-- Logo Mejorado -->
    <div class="flex justify-center mb-8">
      <div class="flex items-center group">
        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
        <span class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent ml-4">PetPedia</span>
      </div>
    </div>

    <h2 class="text-4xl font-black text-center text-gray-900 mb-2">Bienvenido de nuevo</h2>
    <p class="text-gray-600 text-center mb-8">Ingresa a tu cuenta para continuar</p>

    @if($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl mb-6 text-sm font-medium shadow-sm">
        <div class="flex items-center">
          <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
          <span>{{ $errors->first('login') }}</span>
        </div>
      </div>
    @endif

    {{-- ⭐⭐ AGREGAR: Mostrar mensaje de éxito después del registro ⭐⭐ --}}
    @if(session('success'))
      <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-2xl mb-6 text-sm font-medium shadow-sm">
        <div class="flex items-center">
          <i class="fas fa-check-circle mr-3 text-green-500"></i>
          <span>{{ session('success') }}</span>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ url('/login') }}" class="space-y-6">
      @csrf

      <!-- Email Field -->
      <div class="group">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Email</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-envelope text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="email" 
            name="email" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="tu@email.com"
            required
          >
        </div>
      </div>

      <!-- Password Field -->
      <div class="group">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Contraseña</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-lock text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="password" 
            name="password" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="••••••••"
            required
          >
        </div>
      </div>

      <!-- Remember Me -->
      <div class="flex items-center">
        <label class="flex items-center">
          <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
          <span class="ml-2 text-gray-600 font-medium">Recordarme</span>
        </label>
      </div>

      <!-- Submit Button -->
      <button 
        type="submit" 
        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-lg group"
      >
        <i class="fas fa-sign-in-alt mr-2 group-hover:scale-110 transition-transform duration-300"></i>
        Iniciar Sesión
      </button>
    </form>

    <!-- Register Link -->
    <div class="mt-8 pt-6 border-t border-gray-200">
      <p class="text-center text-gray-600 font-medium">
        ¿No tienes cuenta? 
        <a href="/register" class="text-indigo-600 font-bold hover:text-indigo-500 hover:underline transition-all duration-200 ml-1 group">
          Regístrate ahora
          <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform duration-200"></i>
        </a>
      </p>
    </div>
  </div>
</div>

<style>
  .backdrop-blur-lg {
    backdrop-filter: blur(16px);
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Efecto de entrada para el formulario
    const form = document.querySelector('form');
    form.style.opacity = '0';
    form.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
      form.style.transition = 'all 0.6s ease-out';
      form.style.opacity = '1';
      form.style.transform = 'translateY(0)';
    }, 300);
  });
</script>
@endsection