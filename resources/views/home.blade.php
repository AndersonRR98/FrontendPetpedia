@extends('layouts.tailwind') <!-- vista de la pagina inicial -->

@section('content')
<!-- Navbar FINAL Mejorado -->
<nav class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 fixed w-full z-50 top-0 shadow-2xl backdrop-blur-sm">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Logo Mejorado -->
    <div class="flex items-center group">
      <div class="p-2 rounded-2xl group-hover:scale-110 transition-transform duration-300">
        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-12 w-auto">
      </div>
      <span class="text-white text-2xl font-black ml-3 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">PetPedia</span>
    </div>

    <!-- Navbar links con menú desplegable mejorado -->
    <div class="hidden md:flex space-x-8">
      <!-- Enlace simple Sobre Nosotros -->
      <a href="#sobre-nosotros" class="text-white hover:text-indigo-200 font-bold text-lg transition-all duration-300 transform hover:scale-105 flex items-center">
        <i class="fas fa-info-circle mr-2 text-lg"></i>
        Sobre Nosotros
      </a>

      <!-- Menú desplegable de Servicios mejorado -->
      <div class="relative group">
        <button class="text-white hover:text-indigo-200 font-bold text-lg transition-all duration-300 transform hover:scale-105 flex items-center">
          <i class="fas fa-concierge-bell mr-2 text-lg"></i>
          Servicios
          <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <!-- Menú desplegable mejorado -->
        <div class="absolute left-0 mt-3 w-80 bg-white/95 backdrop-blur-lg rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-4 border border-white/20">
          <div class="p-4">
            <a href="#veterinaria" class="block p-4 text-gray-800 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-300 transform hover:scale-105 group/item mb-3">
              <div class="flex items-center">
                <div class="p-3 mr-4 group-hover/item:scale-110 transition-transform duration-300">
                  <i class="fas fa-stethoscope text-indigo-500 text-xl"></i>
                </div>
                <div>
                  <p class="font-bold text-gray-900">Servicios Veterinarios</p>
                  <p class="text-sm text-gray-600 mt-1">Atención médica y cuidado profesional</p>
                </div>
              </div>
            </a>
            <a href="#entrenador" class="block p-4 text-gray-800 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 rounded-xl transition-all duration-300 transform hover:scale-105 group/item mb-3">
              <div class="flex items-center">
                <div class="p-3 mr-4 group-hover/item:scale-110 transition-transform duration-300">
                  <i class="fas fa-dumbbell text-emerald-500 text-xl"></i>
                </div>
                <div>
                  <p class="font-bold text-gray-900">Entrenadores</p>
                  <p class="text-sm text-gray-600 mt-1">Capacitación y comportamiento</p>
                </div>
              </div>
            </a>
            <a href="#tienda" class="block p-4 text-gray-800 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 rounded-xl transition-all duration-300 transform hover:scale-105 group/item mb-3">
              <div class="flex items-center">
                <div class="p-3 mr-4 group-hover/item:scale-110 transition-transform duration-300">
                  <i class="fas fa-shopping-bag text-blue-500 text-xl"></i>
                </div>
                <div>
                  <p class="font-bold text-gray-900">Tienda de Productos</p>
                  <p class="text-sm text-gray-600 mt-1">Alimentos y accesorios</p>
                </div>
              </div>
            </a>
            <a href="#adopciones" class="block p-4 text-gray-800 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 rounded-xl transition-all duration-300 transform hover:scale-105 group/item">
              <div class="flex items-center">
                <div class="p-3 mr-4 group-hover/item:scale-110 transition-transform duration-300">
                  <i class="fas fa-paw text-pink-500 text-xl"></i>
                </div>
                <div>
                  <p class="font-bold text-gray-900">Adopciones</p>
                  <p class="text-sm text-gray-600 mt-1">Encuentra tu compañero ideal</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Otros enlaces mejorados -->
      <a href="#comunidad" class="text-white hover:text-indigo-200 font-bold text-lg transition-all duration-300 transform hover:scale-105 flex items-center">
        <i class="fas fa-users mr-2 text-lg"></i>
        Comunidad
      </a>
      <a href="#app" class="text-white hover:text-indigo-200 font-bold text-lg transition-all duration-300 transform hover:scale-105 flex items-center">
        <i class="fas fa-mobile-alt mr-2 text-lg"></i>
        App
      </a>
      <a href="#contacto" class="text-white hover:text-indigo-200 font-bold text-lg transition-all duration-300 transform hover:scale-105 flex items-center">
        <i class="fas fa-envelope mr-2 text-lg"></i>
        Contacto
      </a>
    </div>

    <!-- Nuevo ícono para iniciar sesión mejorado -->
    <div class="flex items-center">
      <a href="/login" class="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-2xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 shadow-lg border border-white/30 font-bold flex items-center group">
        <i class="fas fa-user-circle mr-3 text-lg group-hover:scale-110 transition-transform duration-300"></i>
        Iniciar Sesión
      </a>
    </div>
  </div>
</nav>

<!-- Espacio fijo para el navbar -->
<div class="h-20"></div>

<!-- Hero Section Mejorada -->
<section id="sobre-nosotros" class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white overflow-hidden py-24">
  <!-- Background Animation -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
  </div>
  
  <div class="relative max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-center">
      <!-- Texto descriptivo mejorado -->
      <div class="md:w-1/2 md:pr-12 mb-10 md:mb-0">
        <div class="mb-8">
          <i class="fas fa-paw text-white text-4xl"></i>
        </div>
        <h1 class="text-5xl md:text-6xl font-black mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent leading-tight">
          Bienvenido a PetPedia
        </h1>
        <p class="text-xl text-blue-100 mb-6 leading-relaxed font-medium">
          En PetPedia nos dedicamos al cuidado integral de tus mascotas. Ofrecemos servicios veterinarios de calidad, 
          entrenamiento profesional y una tienda con los mejores productos para el bienestar de tu compañero peludo.
        </p>
        <p class="text-lg text-indigo-100 mb-8 leading-relaxed">
          Nuestro equipo de expertos está comprometido con la salud y felicidad de tus mascotas, 
          brindando atención personalizada y soluciones adaptadas a sus necesidades específicas.
        </p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
          <a href="#veterinaria" class="bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-2xl text-center flex items-center justify-center group">
            <i class="fas fa-arrow-down mr-3 group-hover:animate-bounce"></i>
            Conoce nuestros servicios
          </a>
          <a href="/login" class="bg-white/20 backdrop-blur-sm text-white border border-white/30 px-8 py-4 rounded-2xl font-bold hover:bg-white/30 transition-all duration-300 transform hover:scale-105 shadow-lg text-center flex items-center justify-center group">
            <i class="fas fa-user-circle mr-3 group-hover:scale-110 transition-transform duration-300"></i>
            Iniciar Sesión
          </a>
        </div>
      </div>
      
      <!-- Imagen descriptiva mejorada -->
      <div class="md:w-1/2">
        <div class="relative group">
          <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-3xl blur-2xl opacity-30 group-hover:opacity-50 transition duration-1000"></div>
          <img src="{{ asset('images/macotas.png') }}" alt="Mascotas felices" class="relative w-full h-80 object-contain rounded-2xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección Veterinaria Mejorada -->
<section id="veterinaria" class="py-20 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <div class="mb-6">
        <i class="fas fa-stethoscope text-blue-500 text-4xl"></i>
      </div>
      <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
        Servicios Veterinarios
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto font-medium">
        Atención médica profesional con los mejores veterinarios. Emergencias, consultas y especialidades para el bienestar de tu mascota.
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="space-y-6">
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-bolt text-blue-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Urgencias 24/7</h3>
          </div>
          <p class="text-gray-600">Atención inmediata para emergencias veterinarias las 24 horas del día, los 7 días de la semana.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-syringe text-green-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Vacunación Completa</h3>
          </div>
          <p class="text-gray-600">Programas de vacunación preventiva y seguimiento médico personalizado para tu mascota.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-heartbeat text-purple-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Especialidades</h3>
          </div>
          <p class="text-gray-600">Cardiología, dermatología, oftalmología y más especialidades veterinarias disponibles.</p>
        </div>
      </div>
      
      <div class="relative group">
        <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
        <img src="{{ asset('images/veterinaria.jpg') }}" alt="Veterinaria" class="relative w-full h-96 object-cover rounded-2xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500">
      </div>
    </div>
  </div>
</section>

<!-- Sección Entrenadores Mejorada -->
<section id="entrenador" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <div class="mb-6">
        <i class="fas fa-dumbbell text-emerald-500 text-4xl"></i>
      </div>
      <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
        Entrenadores Profesionales
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto font-medium">
        Transforma el comportamiento de tu mascota con entrenadores certificados y métodos positivos de aprendizaje.
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="relative group order-2 lg:order-1">
        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-green-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
        <img src="{{ asset('images/entrenador.jpg') }}" alt="Entrenador" class="relative w-full h-96 object-cover rounded-2xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500">
      </div>
      
      <div class="space-y-6 order-1 lg:order-2">
        <div class="bg-gradient-to-br from-white to-emerald-50 rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-emerald-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-graduation-cap text-emerald-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Obediencia</h3>
          </div>
          <p class="text-gray-600">Entrenamiento en obediencia básica y avanzada para una mejor convivencia.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-users text-blue-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Socialización</h3>
          </div>
          <p class="text-gray-600">Programas de socialización para mejorar la interacción con otros animales y personas.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-magic text-purple-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Modificación Conductual</h3>
          </div>
          <p class="text-gray-600">Solución de problemas de comportamiento y modificación de conductas no deseadas.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección Tienda Mejorada -->
<section id="tienda" class="py-20 bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <div class="mb-6">
        <i class="fas fa-shopping-bag text-blue-500 text-4xl"></i>
      </div>
      <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
        Tienda de Productos
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto font-medium">
        Encuentra productos de calidad para tu mascota: alimentos premium, juguetes, accesorios y mucho más.
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="space-y-6">
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-cyan-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-utensils text-cyan-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Alimentos Premium</h3>
          </div>
          <p class="text-gray-600">Alimentos balanceados de la más alta calidad para todas las etapas de vida.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-orange-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-gamepad text-orange-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Juguetes y Entretenimiento</h3>
          </div>
          <p class="text-gray-600">Juguetes interactivos y educativos para mantener a tu mascota activa y feliz.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-pink-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-tshirt text-pink-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Accesorios</h3>
          </div>
          <p class="text-gray-600">Collares, correas, camas y todo tipo de accesorios para el confort de tu mascota.</p>
        </div>
      </div>
      
      <div class="relative group">
        <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
        <img src="{{ asset('images/productos.png') }}" alt="Tienda" class="relative w-full h-96 object-cover rounded-2xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500">
      </div>
    </div>
  </div>
</section>

<!-- Sección Adopciones Mejorada -->
<section id="adopciones" class="py-20 bg-gradient-to-br from-pink-50 via-rose-50 to-red-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <div class="mb-6">
        <i class="fas fa-paw text-pink-500 text-4xl"></i>
      </div>
      <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">
        Adopta un Amigo
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto font-medium">
        Miles de mascotas esperan un hogar lleno de amor. Encuentra a tu compañero perfecto y cambia dos vidas para siempre.
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="relative group order-2 lg:order-1">
        <div class="absolute -inset-4 bg-gradient-to-r from-pink-500 to-rose-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
        <img src="{{ asset('images/adopciones.png') }}" alt="Adopciones" class="relative w-full h-96 object-cover rounded-2xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500">
      </div>
      
      <div class="space-y-6 order-1 lg:order-2">
        <div class="bg-gradient-to-br from-white to-pink-50 rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-pink-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-shield-alt text-pink-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Proceso Seguro</h3>
          </div>
          <p class="text-gray-600">Proceso de adopción verificado y seguro para garantizar el bienestar de las mascotas.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-red-50 rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-red-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-hand-holding-heart text-red-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Seguimiento</h3>
          </div>
          <p class="text-gray-600">Acompañamiento post-adopción para asegurar una adaptación exitosa.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-comments text-purple-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Asesoramiento</h3>
          </div>
          <p class="text-gray-600">Asesoramiento gratuito para elegir la mascota perfecta para tu estilo de vida.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección Comunidad Mejorada -->
<section id="comunidad" class="py-20 bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <div class="mb-6">
        <i class="fas fa-users text-purple-500 text-4xl"></i>
      </div>
      <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
        Comunidad PetPedia
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto font-medium">
        Únete a nuestra comunidad de amantes de las mascotas. Comparte experiencias, consejos y conecta con otros dueños.
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="space-y-6">
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-purple-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-comments text-purple-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Foro Activo</h3>
          </div>
          <p class="text-gray-600">Comunidad activa con miles de miembros compartiendo experiencias y consejos.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-indigo-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-calendar-alt text-indigo-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Eventos</h3>
          </div>
          <p class="text-gray-600">Participa en eventos, encuentros y actividades especiales para mascotas y dueños.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-blue-100/50">
          <div class="flex items-center mb-4">
            <div class="mr-4">
              <i class="fas fa-lightbulb text-blue-500 text-xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Consejos Expertos</h3>
          </div>
          <p class="text-gray-600">Accede a consejos de veterinarios y entrenadores profesionales de la comunidad.</p>
        </div>
      </div>
      
      <div class="relative group">
        <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
        <img src="{{ asset('images/comunidad.png') }}" alt="Comunidad" class="relative w-full h-96 object-cover rounded-2xl shadow-2xl transform group-hover:scale-105 transition-transform duration-500">
      </div>
    </div>
  </div>
</section>

<!-- Sección App Móvil Mejorada -->
<section id="app" class="py-20 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white relative overflow-hidden">
  <!-- Background Animation -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
  </div>
  
  <div class="relative max-w-7xl mx-auto px-6 text-center">
    <div class="mb-8">
      <i class="fas fa-mobile-alt text-white text-4xl"></i>
    </div>
    <h2 class="text-4xl md:text-6xl font-black mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
      Descarga Nuestra App
    </h2>
    <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto leading-relaxed font-medium">
      Lleva a PetPedia contigo a todas partes. Nuestra aplicación móvil te permite acceder a todos nuestros servicios 
      desde tu teléfono. Agenda citas, compra productos, conecta con la comunidad y mucho más.
    </p>
    
    <div class="flex flex-col sm:flex-row justify-center items-center space-y-6 sm:space-y-0 sm:space-x-8 mb-12">
      <a href="#" class="bg-white text-indigo-600 px-10 py-5 rounded-2xl font-black hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-2xl flex items-center text-lg group">
        <i class="fab fa-apple text-2xl mr-4 group-hover:scale-110 transition-transform duration-300"></i>
        <div class="text-left">
          <div class="text-xs font-semibold">Descargar en</div>
          <div class="text-lg font-bold">App Store</div>
        </div>
      </a>
      <a href="#" class="bg-white text-indigo-600 px-10 py-5 rounded-2xl font-black hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-2xl flex items-center text-lg group">
        <i class="fab fa-google-play text-2xl mr-4 group-hover:scale-110 transition-transform duration-300"></i>
        <div class="text-left">
          <div class="text-xs font-semibold">Descargar en</div>
          <div class="text-lg font-bold">Google Play</div>
        </div>
      </a>
    </div>
    
    <div class="relative group max-w-md mx-auto">
      <div class="absolute -inset-4 bg-gradient-to-r from-white to-blue-100 rounded-3xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000"></div>
      <img src="{{ asset('images/logo petpedia.png') }}" alt="App Móvil PetPedia" class="relative w-full h-64 object-contain rounded-2xl transform group-hover:scale-105 transition-transform duration-500">
    </div>
  </div>
</section>

<!-- Footer Mejorado -->
<footer id="contacto" class="bg-gradient-to-r from-indigo-800 via-purple-800 to-pink-800 text-white pt-20 pb-8 relative overflow-hidden">
  <!-- Background Animation -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-20 -left-20 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
    <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
  </div>
  
  <div class="relative max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
      <!-- Logo y descripción mejorado -->
      <div class="lg:col-span-1">
        <div class="flex items-center mb-6">
          <div class="mr-4">
            <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-10 w-auto">
          </div>
          <span class="text-white text-2xl font-black bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">PetPedia</span>
        </div>
        <p class="text-indigo-200 mb-6 leading-relaxed">
          Tu aliado en el cuidado integral de tus mascotas. Ofrecemos servicios veterinarios, entrenamiento y productos de calidad.
        </p>
        <div class="flex space-x-4">
          <a href="#" class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center text-indigo-200 hover:text-white hover:bg-white/20 transition-all duration-300 transform hover:scale-110 border border-white/20">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center text-indigo-200 hover:text-white hover:bg-white/20 transition-all duration-300 transform hover:scale-110 border border-white/20">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center text-indigo-200 hover:text-white hover:bg-white/20 transition-all duration-300 transform hover:scale-110 border border-white/20">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center text-indigo-200 hover:text-white hover:bg-white/20 transition-all duration-300 transform hover:scale-110 border border-white/20">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <!-- Enlaces rápidos mejorado -->
      <div>
        <h3 class="text-xl font-black mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Enlaces Rápidos</h3>
        <ul class="space-y-3">
          <li><a href="#sobre-nosotros" class="text-indigo-200 hover:text-white transition-all duration-300 transform hover:translate-x-2 flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-3 group-hover:scale-110 transition-transform duration-300"></i>
            Sobre Nosotros
          </a></li>
          <li><a href="#veterinaria" class="text-indigo-200 hover:text-white transition-all duration-300 transform hover:translate-x-2 flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-3 group-hover:scale-110 transition-transform duration-300"></i>
            Servicios Veterinarios
          </a></li>
          <li><a href="#entrenador" class="text-indigo-200 hover:text-white transition-all duration-300 transform hover:translate-x-2 flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-3 group-hover:scale-110 transition-transform duration-300"></i>
            Entrenadores
          </a></li>
          <li><a href="#tienda" class="text-indigo-200 hover:text-white transition-all duration-300 transform hover:translate-x-2 flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-3 group-hover:scale-110 transition-transform duration-300"></i>
            Tienda
          </a></li>
          <li><a href="#adopciones" class="text-indigo-200 hover:text-white transition-all duration-300 transform hover:translate-x-2 flex items-center group">
            <i class="fas fa-chevron-right text-xs mr-3 group-hover:scale-110 transition-transform duration-300"></i>
            Adopciones
          </a></li>
        </ul>
      </div>

      <!-- Información de contacto mejorado -->
      <div>
        <h3 class="text-xl font-black mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Contacto</h3>
        <ul class="space-y-4">
          <li class="flex items-start group">
            <div class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center mr-4 mt-1 group-hover:scale-110 transition-transform duration-300 border border-white/20">
              <i class="fas fa-map-marker-alt text-indigo-200 text-sm"></i>
            </div>
            <span class="text-indigo-200 flex-1">Av. Las Mascotas 123, Lima, Perú</span>
          </li>
          <li class="flex items-start group">
            <div class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center mr-4 mt-1 group-hover:scale-110 transition-transform duration-300 border border-white/20">
              <i class="fas fa-phone text-indigo-200 text-sm"></i>
            </div>
            <span class="text-indigo-200 flex-1">+51 987 654 321</span>
          </li>
          <li class="flex items-start group">
            <div class="bg-white/10 backdrop-blur-sm w-10 h-10 rounded-2xl flex items-center justify-center mr-4 mt-1 group-hover:scale-110 transition-transform duration-300 border border-white/20">
              <i class="fas fa-envelope text-indigo-200 text-sm"></i>
            </div>
            <span class="text-indigo-200 flex-1">info@petpedia.com</span>
          </li>
        </ul>
      </div>

      <!-- Horario de atención mejorado -->
      <div>
        <h3 class="text-xl font-black mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">Horario de Atención</h3>
        <ul class="space-y-3 text-indigo-200 mb-6">
          <li class="flex items-center">
            <i class="fas fa-clock text-indigo-300 mr-3"></i>
            Lunes a Viernes: 8:00 AM - 8:00 PM
          </li>
          <li class="flex items-center">
            <i class="fas fa-clock text-indigo-300 mr-3"></i>
            Sábados: 9:00 AM - 2:00 PM
          </li>
          <li class="flex items-center">
            <i class="fas fa-clock text-indigo-300 mr-3"></i>
            Domingos: Cerrado
          </li>
        </ul>
        
        <!-- Botón de contacto mejorado -->
        <a href="mailto:info@petpedia.com" class="bg-white text-indigo-600 px-6 py-3 rounded-2xl font-bold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg inline-flex items-center group">
          <i class="fas fa-paper-plane mr-3 group-hover:scale-110 transition-transform duration-300"></i>
          Contáctanos
        </a>
      </div>
    </div>
    
    <!-- Línea divisoria -->
    <div class="border-t border-indigo-700/50 pt-8">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <p class="text-indigo-300 text-sm mb-4 md:mb-0">
          &copy; 2024 PetPedia. Todos los derechos reservados.
        </p>
        <div class="flex space-x-6 text-sm">
          <a href="#" class="text-indigo-300 hover:text-white transition-all duration-300 transform hover:scale-105">Política de Privacidad</a>
          <a href="#" class="text-indigo-300 hover:text-white transition-all duration-300 transform hover:scale-105">Términos de Servicio</a>
          <a href="#" class="text-indigo-300 hover:text-white transition-all duration-300 transform hover:scale-105">Mapa del Sitio</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Smooth Scroll Mejorado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Smooth scroll para enlaces internos
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        const navbarHeight = 80;
        const targetPosition = targetElement.offsetTop - navbarHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // Animaciones de entrada para las secciones
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  // Observar todas las secciones
  document.querySelectorAll('section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(30px)';
    section.style.transition = 'all 0.6s ease-out';
    observer.observe(section);
  });
});
</script>

<style>
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

.hover\\:float:hover {
  animation: float 3s ease-in-out infinite;
}

.shadow-4xl {
  box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.25), 0 30px 60px -30px rgba(0, 0, 0, 0.3);
}

/* Scroll personalizado */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #8B5CF6, #EC4899);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #7C3AED, #DB2777);
}
</style>
@endsection