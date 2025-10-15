@extends('layouts.tailwind')

@section('content')
<div class="min-h-screen bg-indigo-600 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <div class="flex items-center">
        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-12 w-auto">
        <span class="text-indigo-600 text-2xl font-bold ml-3">PetPedia</span>
      </div>
    </div>

    <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Crear cuenta</h2>

    @if($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ url('/register') }}" class="space-y-6">
      @csrf

      {{-- Rol --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Rol</label>
        <select name="role_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" required>
          <option value="">Selecciona un rol...</option>
          @foreach($roles as $role)
            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
          @endforeach
        </select>
      </div>

      {{-- Nombre --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Nombre completo</label>
        <input 
          type="text" 
          name="name" 
          value="{{ old('name') }}" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          required
        >
      </div>

      {{-- Correo --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Correo electrónico</label>
        <input 
          type="email" 
          name="email" 
          value="{{ old('email') }}" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          required
        >
      </div>

      {{-- Teléfono --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Teléfono</label>
        <input 
          type="text" 
          name="phone" 
          value="{{ old('phone') }}" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          required
        >
      </div>

      {{-- Dirección --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Dirección</label>
        <input 
          type="text" 
          name="address" 
          value="{{ old('address') }}" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          required
        >
      </div>

      {{-- Biografía --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Biografía</label>
        <textarea 
          name="biography" 
          rows="3" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          placeholder="Escribe una breve biografía..."
        >{{ old('biography') }}</textarea>
      </div>

      {{-- Contraseña --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Contraseña</label>
        <input 
          type="password" 
          name="password" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          required
        >
      </div>

      {{-- Confirmar contraseña --}}
      <div>
        <label class="block mb-2 font-semibold text-gray-700">Confirmar contraseña</label>
        <input 
          type="password" 
          name="password_confirmation" 
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition duration-200" 
          required
        >
      </div>

      <button 
        type="submit" 
        class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition duration-200 shadow-lg hover:shadow-xl"
      >
        Registrarse
      </button>
    </form>

    <div class="mt-6 pt-6 border-t border-gray-200">
      <p class="text-center text-gray-600">
        ¿Ya tienes cuenta? 
        <a href="/login" class="text-indigo-600 font-semibold hover:text-indigo-500 hover:underline transition duration-200">
          Inicia sesión
        </a>
      </p>
    </div>
  </div>
</div>
@endsection