@extends('layouts.tailwind')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
  <!-- Background Animation -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
  </div>

  <div class="w-full max-w-2xl bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl p-8 relative z-10 border border-white/20">
    <div class="flex justify-center mb-8">
      <div class="flex items-center group">
        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-12 w-auto group-hover:scale-110 transition-transform duration-300">
        <span class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent ml-4">PetPedia</span>
      </div>
    </div>

    <h2 class="text-4xl font-black text-center text-gray-900 mb-2">Únete a nuestra comunidad</h2>
    <p class="text-gray-600 text-center mb-8">Crea tu cuenta y comienza a disfrutar de todos nuestros servicios</p>

    @if($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl mb-6 text-sm font-medium shadow-sm">
        <div class="flex items-center">
          <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ url('/register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6" id="registerForm">
      @csrf

      <!-- Rol -->
      <div class="group md:col-span-2">
        <label class="block mb-3 font-bold text-gray-700 text-lg">¿Qué te describe mejor?</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-user-tag text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <select name="role_id" id="role_id" class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm appearance-none" required onchange="toggleRoleFields()">
            <option value="">Selecciona tu rol...</option>
            @foreach($roles as $role)
              <option value="{{ $role['id'] }}" {{ old('role_id') == $role['id'] ? 'selected' : '' }}>{{ $role['name'] }}</option>
            @endforeach
          </select>
          <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
            <i class="fas fa-chevron-down text-gray-400"></i>
          </div>
        </div>
      </div>

      <!-- Nombre -->
      <div class="group">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Nombre completo</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-user text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="text" 
            name="name" 
            value="{{ old('name') }}" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="Tu nombre completo"
            required
          >
        </div>
      </div>

      <!-- Correo -->
      <div class="group">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Correo electrónico</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-envelope text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="email" 
            name="email" 
            value="{{ old('email') }}" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="tu@email.com"
            required
          >
        </div>
      </div>

      <!-- Teléfono -->
      <div class="group">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Teléfono</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-phone text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="text" 
            name="phone" 
            value="{{ old('phone') }}" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="+51 999 999 999"
            required
          >
        </div>
      </div>

      <!-- Dirección -->
      <div class="group md:col-span-2">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Dirección</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-map-marker-alt text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="text" 
            name="address" 
            value="{{ old('address') }}" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="Tu dirección completa"
            required
          >
        </div>
      </div>

      <!-- Biografía -->
      <div class="group md:col-span-2">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Biografía</label>
        <div class="relative">
          <div class="absolute top-4 left-4 pointer-events-none">
            <i class="fas fa-edit text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <textarea 
            name="biography" 
            rows="4" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm resize-none" 
            placeholder="Cuéntanos sobre ti y tu experiencia con mascotas..."
          >{{ old('biography') }}</textarea>
        </div>
      </div>

      <!-- CAMPOS ESPECÍFICOS PARA VETERINARIA -->
      <div id="veterinaryFields" class="hidden md:col-span-2 space-y-6 border-t border-gray-200 pt-6 mt-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Información de Veterinaria</h3>
        
        <!-- Nombre de la Clínica -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Nombre de la Clínica</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-hospital text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="text" 
              name="clinic_name" 
              value="{{ old('clinic_name') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Nombre de tu clínica veterinaria"
            >
          </div>
        </div>

        <!-- Licencia Veterinaria -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Licencia Veterinaria</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-id-card text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="text" 
              name="veterinary_license" 
              value="{{ old('veterinary_license') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Número de licencia veterinaria"
            >
          </div>
        </div>

        <!-- Especialización -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Especialización</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-stethoscope text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="text" 
              name="specialization" 
              value="{{ old('specialization') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Tu especialización veterinaria"
            >
          </div>
        </div>
      </div>

      <!-- CAMPOS ESPECÍFICOS PARA ENTRENADOR -->
      <div id="trainerFields" class="hidden md:col-span-2 space-y-6 border-t border-gray-200 pt-6 mt-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Información de Entrenador</h3>
        
        <!-- Especialidad -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Especialidad</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-dumbbell text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="text" 
              name="specialty" 
              value="{{ old('specialty') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Tu especialidad en entrenamiento"
            >
          </div>
        </div>

        <!-- Años de Experiencia -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Años de Experiencia</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-calendar-alt text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="number" 
              name="experience_years" 
              value="{{ old('experience_years') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Años de experiencia"
              min="0"
            >
          </div>
        </div>

        <!-- Calificaciones -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Calificaciones</label>
          <div class="relative">
            <div class="absolute top-4 left-4 pointer-events-none">
              <i class="fas fa-graduation-cap text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <textarea 
              name="qualifications" 
              rows="3" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm resize-none" 
              placeholder="Tus certificaciones y calificaciones..."
            >{{ old('qualifications') }}</textarea>
          </div>
        </div>

        <!-- Tarifa por Hora -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Tarifa por Hora (S/)</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-money-bill-wave text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="number" 
              name="hourly_rate" 
              value="{{ old('hourly_rate') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="0.00"
              step="0.01"
              min="0"
            >
          </div>
        </div>
      </div>

      <!-- CAMPOS ESPECÍFICOS PARA REFUGIO -->
      <div id="shelterFields" class="hidden md:col-span-2 space-y-6 border-t border-gray-200 pt-6 mt-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Información de Refugio</h3>
        
        <!-- Nombre del Refugio -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Nombre del Refugio</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-home text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="text" 
              name="shelter_name" 
              value="{{ old('shelter_name') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Nombre de tu refugio"
            >
          </div>
        </div>

        <!-- Persona Responsable -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Persona Responsable</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-user-check text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="text" 
              name="responsible_person" 
              value="{{ old('responsible_person') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Nombre del responsable"
            >
          </div>
        </div>

        <!-- Capacidad -->
        <div class="group">
          <label class="block mb-3 font-bold text-gray-700 text-lg">Capacidad de Mascotas</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <i class="fas fa-paw text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
            </div>
            <input 
              type="number" 
              name="capacity" 
              value="{{ old('capacity') }}" 
              class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
              placeholder="Número máximo de mascotas"
              min="1"
            >
          </div>
        </div>
      </div>

      <!-- Contraseña -->
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

      <!-- Confirmar contraseña -->
      <div class="group">
        <label class="block mb-3 font-bold text-gray-700 text-lg">Confirmar contraseña</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-lock text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"></i>
          </div>
          <input 
            type="password" 
            name="password_confirmation" 
            class="w-full border border-gray-300 rounded-2xl px-12 py-4 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all duration-200 text-lg bg-white/50 backdrop-blur-sm" 
            placeholder="••••••••"
            required
          >
        </div>
      </div>

      <!-- Términos y condiciones -->
      <div class="md:col-span-2">
        <label class="flex items-start">
          <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 mt-1" required>
          <span class="ml-3 text-gray-600 text-sm">
            Acepto los <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-500">términos y condiciones</a> 
            y la <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-500">política de privacidad</a>
          </span>
        </label>
      </div>

      <!-- Submit Button -->
      <div class="md:col-span-2">
        <button 
          type="submit" 
          class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-lg group"
        >
          <i class="fas fa-user-plus mr-2 group-hover:scale-110 transition-transform duration-300"></i>
          Crear Cuenta
        </button>
      </div>
    </form>

    <!-- Login Link -->
    <div class="mt-8 pt-6 border-t border-gray-200">
      <p class="text-center text-gray-600 font-medium">
        ¿Ya tienes cuenta? 
        <a href="/login" class="text-indigo-600 font-bold hover:text-indigo-500 hover:underline transition-all duration-200 ml-1 group">
          Inicia sesión aquí
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
  
  select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
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

    // Animación para los campos
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach((input, index) => {
      input.style.opacity = '0';
      input.style.transform = 'translateX(-20px)';
      
      setTimeout(() => {
        input.style.transition = 'all 0.5s ease-out';
        input.style.opacity = '1';
        input.style.transform = 'translateX(0)';
      }, 400 + (index * 100));
    });

    // Mostrar campos según el rol seleccionado
    toggleRoleFields();
  });

  function toggleRoleFields() {
    const roleSelect = document.getElementById('role_id');
    const veterinaryFields = document.getElementById('veterinaryFields');
    const trainerFields = document.getElementById('trainerFields');
    const shelterFields = document.getElementById('shelterFields');
    
    // Ocultar todos los campos específicos primero
    veterinaryFields.classList.add('hidden');
    trainerFields.classList.add('hidden');
    shelterFields.classList.add('hidden');
    
    // Quitar requerido de todos los campos específicos
    const specificInputs = document.querySelectorAll('#veterinaryFields input, #trainerFields input, #shelterFields input, #veterinaryFields textarea, #trainerFields textarea, #shelterFields textarea');
    specificInputs.forEach(input => {
      input.required = false;
    });

    // Mostrar campos según el rol seleccionado
    switch(roleSelect.value) {
      case '2': // Veterinaria
        veterinaryFields.classList.remove('hidden');
        setFieldsRequired(veterinaryFields);
        break;
      case '3': // Entrenador
        trainerFields.classList.remove('hidden');
        setFieldsRequired(trainerFields);
        break;
      case '4': // Refugio
        shelterFields.classList.remove('hidden');
        setFieldsRequired(shelterFields);
        break;
    }
  }

  function setFieldsRequired(container) {
    const inputs = container.querySelectorAll('input, textarea');
    inputs.forEach(input => {
      input.required = true;
    });
  }
</script>
@endsection