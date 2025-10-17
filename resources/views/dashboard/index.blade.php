@extends('layouts.app')

@section('title', 'Dashboard - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Hero Section Mejorada -->
    <div class="relative bg-gradient-to-r from-indigo-600 to-purple-700 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black/10">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzQuNDE0VjIyLjA3M2g2Ljg1NnYxMi4zNDFIMzZ6bS0xMiAwVjIyLjA3M2g2Ljg1NnYxMi4zNDFIMjR6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-10"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-indigo-100 bg-clip-text text-transparent">
                    ¡Bienvenido, {{ $user['name'] }}!
                </h1>
                <p class="text-xl md:text-2xl text-indigo-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Tu compañero perfecto para el cuidado y bienestar de tu mascota
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="flex items-center text-indigo-100">
                        <i class="fas fa-check-circle text-green-300 mr-2"></i>
                        <span>Servicios verificados</span>
                    </div>
                    <div class="flex items-center text-indigo-100">
                        <i class="fas fa-star text-yellow-300 mr-2"></i>
                        <span>Profesionales calificados</span>
                    </div>
                    <div class="flex items-center text-indigo-100">
                        <i class="fas fa-shield-alt text-blue-300 mr-2"></i>
                        <span>Reservas seguras</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Grid Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <!-- Veterinarias Service -->
            <div class="group relative bg-white rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-indigo-100 p-4 rounded-2xl group-hover:bg-indigo-200 transition-colors duration-300">
                            <i class="fas fa-stethoscope text-indigo-600 text-2xl"></i>
                        </div>
                        <span class="bg-indigo-100 text-indigo-800 text-sm font-semibold px-3 py-1 rounded-full">24/7</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Atención Veterinaria</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Cuidado médico profesional, emergencias, vacunación y consultas especializadas para garantizar la salud de tu mascota.
                    </p>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Consultas de rutina</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Urgencias 24 horas</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Cirugías especializadas</span>
                        </div>
                    </div>
                    <a href="{{ route('veterinarias.index') }}" 
                       class="w-full bg-indigo-600 text-white text-center py-3 px-6 rounded-xl font-semibold hover:bg-indigo-700 transition duration-300 inline-flex items-center justify-center group-hover:shadow-lg">
                        Encontrar Veterinario
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>

            <!-- Entrenadores Service -->
            <div class="group relative bg-white rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600 opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-green-100 p-4 rounded-2xl group-hover:bg-green-200 transition-colors duration-300">
                            <i class="fas fa-dumbbell text-green-600 text-2xl"></i>
                        </div>
                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">+500</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Entrenamiento Canino</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Adiestramiento profesional, modificación de conducta y actividades que fortalecen el vínculo con tu mascota.
                    </p>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Obediencia básica</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Socialización</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Terapia conductual</span>
                        </div>
                    </div>
                    <a href="{{ route('entrenadores.index') }}" 
                       class="w-full bg-green-600 text-white text-center py-3 px-6 rounded-xl font-semibold hover:bg-green-700 transition duration-300 inline-flex items-center justify-center group-hover:shadow-lg">
                        Buscar Entrenador
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>

            <!-- Adopciones Service -->
            <div class="group relative bg-white rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-600 opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-purple-100 p-4 rounded-2xl group-hover:bg-purple-200 transition-colors duration-300">
                            <i class="fas fa-paw text-purple-600 text-2xl"></i>
                        </div>
                        <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full">❤️</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Adopción Responsable</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Encuentra a tu nuevo mejor amigo. Miles de mascotas esperan un hogar lleno de amor y cuidados.
                    </p>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Proceso verificado</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Seguimiento post-adopción</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span class="text-sm">Asesoramiento gratuito</span>
                        </div>
                    </div>
                    <a href="{{ route('adopciones.index') }}" 
                       class="w-full bg-purple-600 text-white text-center py-3 px-6 rounded-xl font-semibold hover:bg-purple-700 transition duration-300 inline-flex items-center justify-center group-hover:shadow-lg">
                        Adoptar Mascota
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Services Section -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Más Servicios para tu Mascota</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Descubre todos los servicios que tenemos para el bienestar y felicidad de tu compañero peludo
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Peluquería -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 group border border-gray-100">
                    <div class="bg-pink-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-pink-200 transition-colors">
                        <i class="fas fa-cut text-pink-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Peluquería</h4>
                    <p class="text-gray-600 text-sm mb-4">Corte, baño y cuidado estético profesional</p>
                    <span class="text-pink-600 text-sm font-semibold">Desde $25</span>
                </div>

                <!-- Guardería -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 group border border-gray-100">
                    <div class="bg-blue-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-home text-blue-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Guardería</h4>
                    <p class="text-gray-600 text-sm mb-4">Cuidado diurno con actividades recreativas</p>
                    <span class="text-blue-600 text-sm font-semibold">Por día/hora</span>
                </div>

                <!-- Paseadores -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 group border border-gray-100">
                    <div class="bg-green-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-walking text-green-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Paseadores</h4>
                    <p class="text-gray-600 text-sm mb-4">Paseos individuales o grupales</p>
                    <span class="text-green-600 text-sm font-semibold">+50 paseadores</span>
                </div>

                <!-- Farmacia -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 group border border-gray-100">
                    <div class="bg-red-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-red-200 transition-colors">
                        <i class="fas fa-pills text-red-600 text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Farmacia</h4>
                    <p class="text-gray-600 text-sm mb-4">Medicamentos y productos veterinarios</p>
                    <span class="text-red-600 text-sm font-semibold">Entrega rápida</span>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-indigo-600 mb-2">5,000+</div>
                    <div class="text-gray-600">Mascotas Felices</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-green-600 mb-2">200+</div>
                    <div class="text-gray-600">Profesionales</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-600 mb-2">1,500+</div>
                    <div class="text-gray-600">Adopciones</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-pink-600 mb-2">4.9/5</div>
                    <div class="text-gray-600">Rating Promedio</div>
                </div>
            </div>
        </div>

      <!-- Emergency Veterinarians Section -->
<div class="bg-gradient-to-r from-red-500 to-orange-600 rounded-2xl p-12 text-center text-white mb-16 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-black/10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMzAgMTVjLTguMjggMC0xNSA2LjcyLTE1IDE1czYuNzIgMTUgMTUgMTUgMTUtNi43MiAxNS0xNS02LjcyLTE1LTE1LTE1eiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utb3BhY2l0eT0iMC4xIiBzdHJva2Utd2lkdGg9IjIiLz48L3N2Zz4=')] opacity-20"></div>
    </div>
    
    <div class="relative z-10">
        <div class="flex justify-center mb-6">
            <div class="bg-white/20 p-4 rounded-full">
                <i class="fas fa-exclamation-triangle text-3xl"></i>
            </div>
        </div>
        
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Señales de Urgencia en Mascotas</h2>
        <p class="text-red-100 text-xl mb-6 max-w-2xl mx-auto">
            Identifica estas señales de alerta que requieren atención veterinaria inmediata
        </p>
        
        <!-- Emergency Signals Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 max-w-6xl mx-auto">
            <!-- Signal 1 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-temperature-high text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Fiebre Alta</h4>
                <p class="text-red-100 text-sm">
                    Temperatura superior a 39.5°C en perros o 39°C en gatos
                </p>
            </div>

            <!-- Signal 2 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ban text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Rechazo de Alimento</h4>
                <p class="text-red-100 text-sm">
                    Más de 24 horas sin comer o beber agua
                </p>
            </div>

            <!-- Signal 3 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tint text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Vómitos con Sangre</h4>
                <p class="text-red-100 text-sm">
                    Vómitos persistentes o con presencia de sangre
                </p>
            </div>

            <!-- Signal 4 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-wind text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Dificultad Respiratoria</h4>
                <p class="text-red-100 text-sm">
                    Jadeo excesivo, tos constante o respiración agitada
                </p>
            </div>

            <!-- Signal 5 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-crutch text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Inmovilidad</h4>
                <p class="text-red-100 text-sm">
                    No puede levantarse o camina con dificultad
                </p>
            </div>

            <!-- Signal 6 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-circle text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Convulsiones</h4>
                <p class="text-red-100 text-sm">
                    Temblores, espasmos o pérdida de conciencia
                </p>
            </div>

            <!-- Signal 7 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Ojos Inyectados</h4>
                <p class="text-red-100 text-sm">
                    Ojos rojos, nublados o con secreción abundante
                </p>
            </div>

            <!-- Signal 8 -->
            <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm hover:bg-white/15 transition duration-300">
                <div class="bg-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-syringe text-white text-xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Abdomen Inflamado</h4>
                <p class="text-red-100 text-sm">
                    Barriga dura e inflamada con signos de dolor
                </p>
            </div>
        </div>

        <!-- Emergency Action -->
        <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm max-w-4xl mx-auto mb-6">
            <h3 class="text-2xl font-bold mb-4">¿Identificas alguna de estas señales?</h3>
            <p class="text-red-100 text-lg mb-6">
                Busca atención veterinaria inmediata. Contamos con clínicas 24/7 para emergencias
            </p>
            
            <a href="{{ route('veterinarias.index') }}?emergency=true" 
               class="bg-white text-red-600 px-12 py-4 rounded-xl font-bold hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg inline-flex items-center text-lg">
                <i class="fas fa-search-location mr-3"></i>
                Encontrar Veterinarias 24h Cercanas
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-red-100 max-w-4xl mx-auto">
            <div class="flex items-center justify-center">
                <i class="fas fa-clock text-yellow-300 mr-2"></i>
                <span>Disponibilidad 24 horas</span>
            </div>
            <div class="flex items-center justify-center">
                <i class="fas fa-user-md text-green-300 mr-2"></i>
                <span>Veterinarios especializados</span>
            </div>
            <div class="flex items-center justify-center">
                <i class="fas fa-map-marker-alt text-blue-300 mr-2"></i>
                <span>Ubicaciones en toda la ciudad</span>
            </div>
        </div>
    </div>
</div>

<!-- Quick Tips Section -->
<div class="bg-white rounded-2xl shadow-xl p-8 mb-16">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">¿Qué hacer en caso de emergencia?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="text-center p-6">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-phone text-blue-600 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 text-lg mb-3">Llama Primero</h4>
            <p class="text-gray-600">
                Contacta a la veterinaria para que estén preparados para tu llegada
            </p>
        </div>
        <div class="text-center p-6">
            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-first-aid text-green-600 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 text-lg mb-3">Mantén la Calma</h4>
            <p class="text-gray-600">
                Tu mascota puede sentir tu ansiedad. Mantén la tranquilidad para no estresarla más
            </p>
        </div>
        <div class="text-center p-6">
            <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-car text-purple-600 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 text-lg mb-3">Transporte Seguro</h4>
            <p class="text-gray-600">
                Usa un transportador o mantén a tu mascota segura durante el traslado
            </p>
        </div>
    </div>
</div>

<!-- Font Awesome para los íconos -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
@endsection