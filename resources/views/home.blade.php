@extends('layouts.tailwind')

@section('content')
<!-- Navbar FINAL -->
<nav class="bg-indigo-600 fixed w-full z-50 top-0 shadow-lg">
  <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
    <!-- Logo -->
    <div class="flex items-center">
      <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-12 w-auto">
      <span class="text-white text-2xl font-bold ml-3">PetPedia</span>
    </div>

    <!-- Navbar links con menú desplegable -->
    <div class="hidden md:flex space-x-8">
      <!-- Enlace simple Sobre Nosotros -->
      <a href="#sobre-nosotros" class="text-white hover:text-indigo-200 font-semibold text-lg transition duration-300">Sobre Nosotros</a>

      <!-- Menú desplegable de Servicios -->
      <div class="relative group">
        <button class="text-white hover:text-indigo-200 font-semibold text-lg transition duration-300 flex items-center">
          Servicios
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <!-- Menú desplegable -->
        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
          <div class="py-2">
            <a href="#veterinaria" class="block px-4 py-3 text-gray-800 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300 border-b border-gray-100">
              <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <div>
                  <p class="font-semibold">Servicios Veterinarios</p>
                  <p class="text-sm text-gray-600">Atención médica y cuidado profesional</p>
                </div>
              </div>
            </a>
            <a href="#entrenador" class="block px-4 py-3 text-gray-800 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300 border-b border-gray-100">
              <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <div>
                  <p class="font-semibold">Entrenadores</p>
                  <p class="text-sm text-gray-600">Capacitación y comportamiento</p>
                </div>
              </div>
            </a>
            <a href="#tienda" class="block px-4 py-3 text-gray-800 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300 border-b border-gray-100">
              <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <div>
                  <p class="font-semibold">Tienda de Productos</p>
                  <p class="text-sm text-gray-600">Alimentos y accesorios</p>
                </div>
              </div>
            </a>
            <a href="#adopciones" class="block px-4 py-3 text-gray-800 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">
              <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <div>
                  <p class="font-semibold">Adopciones</p>
                  <p class="text-sm text-gray-600">Encuentra tu compañero ideal</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Otros enlaces -->
      <a href="#comunidad" class="text-white hover:text-indigo-200 font-semibold text-lg transition duration-300">Comunidad</a>
      <a href="#app" class="text-white hover:text-indigo-200 font-semibold text-lg transition duration-300">App</a>
      <a href="#contacto" class="text-white hover:text-indigo-200 font-semibold text-lg transition duration-300">Contacto</a>
    </div>

    <!-- Nuevo ícono para iniciar sesión -->
    <div class="flex items-center">
      <a href="/login" class="bg-white rounded-full p-2 hover:bg-indigo-100 transition duration-300 shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
      </a>
    </div>
  </div>
</nav>

<!-- Espacio fijo para el navbar -->
<div class="h-24"></div>

<!-- Sección Sobre Nosotros (AHORA ES LA BIENVENIDA) -->
<section id="sobre-nosotros" class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-center">
      <!-- Texto descriptivo -->
      <div class="md:w-1/2 md:pr-12 mb-10 md:mb-0">
        <h1 class="text-4xl font-bold text-indigo-700 mb-6">Bienvenido a PetPedia</h1>
        <p class="text-gray-700 text-lg mb-6">
          En PetPedia nos dedicamos al cuidado integral de tus mascotas. Ofrecemos servicios veterinarios de calidad, 
          entrenamiento profesional y una tienda con los mejores productos para el bienestar de tu compañero peludo.
        </p>
        <p class="text-gray-700 text-lg mb-6">
          Nuestro equipo de expertos está comprometido con la salud y felicidad de tus mascotas, 
          brindando atención personalizada y soluciones adaptadas a sus necesidades específicas.
        </p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="#veterinaria" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 text-center">
            Conoce nuestros servicios
          </a>
          <!-- Cambiado a Iniciar Sesión -->
          <a href="/login" class="bg-white text-indigo-600 border border-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition duration-300 text-center flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Iniciar Sesión
          </a>
        </div>
      </div>
      
      <!-- Imagen descriptiva -->
     <div class="md:w-1/2">
  <img src="{{ asset('images/macotas.png') }}" alt="Mascotas felices" class="w-full h-64 md:h-80 object-contain rounded-xl shadow-lg">
</div>
    </div>
  </div>
</section>

<!-- Sección Veterinaria con imagen más pequeña -->
<section id="veterinaria" class="py-20 bg-gray-100">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-indigo-700 mb-6">Servicios Veterinarios</h2>
    <p class="text-gray-700 mb-12 max-w-3xl mx-auto">
      Aquí puedes colocar información sobre los servicios de veterinaria que ofreces: atención médica, vacunación, consultas y más.
    </p>
    <img src="{{ asset('images/veterinaria.jpg') }}" alt="Veterinaria" class="w-full max-w-3xl mx-auto h-80 object-cover rounded-xl shadow-lg">
  </div>
</section>

<!-- Sección Entrenadores con imagen más pequeña -->
<section id="entrenador" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-indigo-700 mb-6">Entrenadores</h2>
    <p class="text-gray-700 mb-12 max-w-3xl mx-auto">
      Servicios de entrenamiento profesional para tu mascota, con entrenadores especializados en comportamiento y habilidades.
    </p>
    <img src="{{ asset('images/entrenador.jpg') }}" alt="Entrenador" class="w-full max-w-3xl mx-auto h-80 object-cover rounded-xl shadow-lg">
  </div>
</section>

<!-- Sección Tienda con imagen más pequeña -->
<section id="tienda" class="py-20 bg-gray-100">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-indigo-700 mb-6">Tienda de Productos</h2>
    <p class="text-gray-700 mb-12 max-w-3xl mx-auto">
      Encuentra productos de calidad para tu mascota: alimentos, juguetes, accesorios y mucho más.
    </p>
    <img src="{{ asset('images/productos.png') }}" alt="Tienda" class="w-full max-w-3xl mx-auto h-80 object-cover rounded-xl shadow-lg">
  </div>
</section>

<!-- Sección Adopciones con imagen más pequeña -->
<section id="adopciones" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-indigo-700 mb-6">Adopciones</h2>
    <p class="text-gray-700 mb-12 max-w-3xl mx-auto">
      Encuentra a tu compañero perfecto. Tenemos muchos animales esperando por un hogar lleno de amor y cuidados.
      Adopta, no compres. Dale una segunda oportunidad a una mascota que te amará para siempre.
    </p>
    <img src="{{ asset('images/adopciones.png') }}" alt="Adopciones" class="w-full max-w-3xl mx-auto h-80 object-cover rounded-xl shadow-lg">
  </div>
</section>

<!-- Sección Comunidad con imagen más pequeña -->
<section id="comunidad" class="py-20 bg-gray-100">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-indigo-700 mb-6">Comunidad PetPedia</h2>
    <p class="text-gray-700 mb-12 max-w-3xl mx-auto">
      Únete a nuestra comunidad de amantes de las mascotas. Comparte experiencias, consejos y conecta con otros dueños de mascotas.
      Participa en eventos, grupos de apoyo y actividades especiales para ti y tu compañero peludo.
    </p>
    <img src="{{ asset('images/comunidad.png') }}" alt="Comunidad" class="w-full max-w-3xl mx-auto h-80 object-cover rounded-xl shadow-lg">
  </div>
</section>

<!-- Sección App Móvil -->
<section id="app" class="py-20 bg-indigo-600 text-white">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold mb-6">Descarga Nuestra App</h2>
    <p class="text-indigo-100 mb-8 max-w-2xl mx-auto text-lg">
      Lleva a PetPedia contigo a todas partes. Nuestra aplicación móvil te permite acceder a todos nuestros servicios 
      desde tu teléfono. Agenda citas, compra productos, conecta con la comunidad y mucho más.
    </p>
    
    <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-12">
      <a href="#" class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition duration-300 flex items-center">
        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.924 17.315c-.057.174-.193.332-.348.367-.156.035-.34-.054-.483-.227-.143-.173-.185-.402-.128-.576.057-.174.193-.332.348-.367.156-.035.34.054.483.227.143.173.185.402.128.576zm-2.202-1.407c-.114.345-.393.618-.724.69-.331.072-.683-.064-.917-.365-.234-.301-.3-.699-.186-1.044.114-.345.393-.618.724-.69.331-.072.683.064.917.365.234.301.3.699.186 1.044zm3.12 1.769c-.274.829-.96 1.484-1.806 1.666-.846.182-1.698-.135-2.202-.86-.504-.725-.564-1.682-.29-2.511.274-.829.96-1.484 1.806-1.666.846-.182 1.698.135 2.202.86.504.725.564 1.682.29 2.511zM12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/>
        </svg>
        Descargar en App Store
      </a>
      <a href="#" class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition duration-300 flex items-center">
        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
          <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 10.937a.995.995 0 01-.61-.92V2.734a1 1 0 01.609-.92l10.938 10.937zm-2.302 2.302l10.937 10.938a.995.995 0 01-.609.92H2.734a1 1 0 01-.92-.609l10.937-10.938z"/>
        </svg>
        Descargar en Google Play
      </a>
    </div>
    
    <img src="{{ asset('images/logo petpedia.png') }}" alt="App Móvil PetPedia" class="w-full max-w-md mx-auto rounded-xl shadow-lg">
  </div>
</section>

<!-- Footer en lugar de sección Contacto -->
<footer id="contacto" class="bg-indigo-800 text-white pt-16 pb-8">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
      <!-- Logo y descripción -->
      <div class="lg:col-span-1">
        <div class="flex items-center mb-4">
          <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-10 w-auto">
          <span class="text-white text-xl font-bold ml-2">PetPedia</span>
        </div>
        <p class="text-indigo-200 mb-4">
          Tu aliado en el cuidado integral de tus mascotas. Ofrecemos servicios veterinarios, entrenamiento y productos de calidad.
        </p>
        <div class="flex space-x-4">
          <a href="#" class="text-indigo-200 hover:text-white transition duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
          </a>
          <a href="#" class="text-indigo-200 hover:text-white transition duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
            </svg>
          </a>
          <a href="#" class="text-indigo-200 hover:text-white transition duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.042-3.441.219-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.017z"/>
            </svg>
          </a>
          <a href="#" class="text-indigo-200 hover:text-white transition duration-300">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Enlaces rápidos -->
      <div>
        <h3 class="text-lg font-bold mb-4">Enlaces Rápidos</h3>
        <ul class="space-y-2">
          <li><a href="#sobre-nosotros" class="text-indigo-200 hover:text-white transition duration-300">Sobre Nosotros</a></li>
          <li><a href="#veterinaria" class="text-indigo-200 hover:text-white transition duration-300">Servicios Veterinarios</a></li>
          <li><a href="#entrenador" class="text-indigo-200 hover:text-white transition duration-300">Entrenadores</a></li>
          <li><a href="#tienda" class="text-indigo-200 hover:text-white transition duration-300">Tienda</a></li>
          <li><a href="#adopciones" class="text-indigo-200 hover:text-white transition duration-300">Adopciones</a></li>
        </ul>
      </div>

      <!-- Información de contacto -->
      <div>
        <h3 class="text-lg font-bold mb-4">Contacto</h3>
        <ul class="space-y-3">
          <li class="flex items-start">
            <svg class="w-5 h-5 text-indigo-200 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="text-indigo-200">Av. Las Mascotas 123, Lima, Perú</span>
          </li>
          <li class="flex items-start">
            <svg class="w-5 h-5 text-indigo-200 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <span class="text-indigo-200">+51 987 654 321</span>
          </li>
          <li class="flex items-start">
            <svg class="w-5 h-5 text-indigo-200 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span class="text-indigo-200">info@petpedia.com</span>
          </li>
        </ul>
      </div>

      <!-- Horario de atención -->
      <div>
        <h3 class="text-lg font-bold mb-4">Horario de Atención</h3>
        <ul class="space-y-2 text-indigo-200">
          <li>Lunes a Viernes: 8:00 AM - 8:00 PM</li>
          <li>Sábados: 9:00 AM - 2:00 PM</li>
          <li>Domingos: Cerrado</li>
        </ul>
        
        <!-- Botón de contacto -->
        <a href="mailto:info@petpedia.com" class="inline-block mt-4 bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition duration-300">
          Contáctanos
        </a>
      </div>
    </div>
    
    <!-- Línea divisoria -->
    <div class="border-t border-indigo-700 pt-8">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <p class="text-indigo-300 text-sm mb-4 md:mb-0">
          &copy; 2023 PetPedia. Todos los derechos reservados.
        </p>
        <div class="flex space-x-6 text-sm">
          <a href="#" class="text-indigo-300 hover:text-white transition duration-300">Política de Privacidad</a>
          <a href="#" class="text-indigo-300 hover:text-white transition duration-300">Términos de Servicio</a>
          <a href="#" class="text-indigo-300 hover:text-white transition duration-300">Mapa del Sitio</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Smooth Scroll Actualizado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        const navbarHeight = 96;
        const targetPosition = targetElement.offsetTop - navbarHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  });
});
</script>
@endsection