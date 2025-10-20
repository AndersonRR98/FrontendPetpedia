@extends('layouts.app')  <!-- vista del deshboard principal del usuario cliente -->

@section('title', 'Dashboard - PetPedia')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <!-- Hero Section Mejorada -->
    <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white overflow-hidden">
        <!-- Background Animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-sm rounded-3xl mb-8 border border-white/30">
                    <i class="fas fa-paw text-white text-3xl"></i>
                </div>
                <h1 class="text-5xl md:text-7xl font-black mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent leading-tight">
                    ¡Hola, {{ $user['name'] }}!
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto leading-relaxed font-medium">
                    Todo lo que necesitas para el bienestar de tu mascota en un solo lugar
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-lg">
                    <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                        <i class="fas fa-shield-alt text-green-300 mr-2"></i>
                        <span>Servicios Verificados</span>
                    </div>
                    <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                        <i class="fas fa-star text-yellow-300 mr-2"></i>
                        <span>+500 Profesionales</span>
                    </div>
                    <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                        <i class="fas fa-heart text-pink-300 mr-2"></i>
                        <span>Comunidad Activa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Services Grid Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
            <!-- Veterinarias Service - Promocional -->
            <div class="group relative bg-gradient-to-br from-white to-blue-50 rounded-3xl shadow-2xl hover:shadow-4xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-blue-100/50">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="p-8 relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 p-5 rounded-3xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-stethoscope text-white text-2xl"></i>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-sm font-bold px-4 py-2 rounded-2xl border border-blue-200">
                            🏥 24/7
                        </span>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 mb-4">Atención Veterinaria</h3>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed font-medium">
                        Cuidado médico profesional con los mejores veterinarios. Emergencias, consultas y especialidades.
                    </p>
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center text-gray-700 bg-white/50 rounded-2xl p-3">
                            <i class="fas fa-bolt text-yellow-500 text-lg mr-3"></i>
                            <span class="font-semibold">Urgencias 24 horas</span>
                        </div>
                        <div class="flex items-center text-gray-700 bg-white/50 rounded-2xl p-3">
                            <i class="fas fa-syringe text-green-500 text-lg mr-3"></i>
                            <span class="font-semibold">Vacunación y prevención</span>
                        </div>
                        <div class="flex items-center text-gray-700 bg-white/50 rounded-2xl p-3">
                            <i class="fas fa-heartbeat text-red-500 text-lg mr-3"></i>
                            <span class="font-semibold">Especialidades médicas</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-users mr-1"></i>
                            +200 veterinarios
                        </div>
                        <a href="{{ route('veterinarias.index') }}" 
                           class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-4 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center group/btn">
                            Encontrar Veterinario
                            <i class="fas fa-arrow-right ml-3 group-hover/btn:translate-x-2 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Adopciones Service - Promocional -->
            <div class="group relative bg-gradient-to-br from-white to-pink-50 rounded-3xl shadow-2xl hover:shadow-4xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-pink-100/50">
                <div class="absolute top-0 right-0 w-32 h-32 bg-pink-500/10 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="p-8 relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 p-5 rounded-3xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-paw text-white text-2xl"></i>
                        </div>
                        <span class="bg-pink-100 text-pink-800 text-sm font-bold px-4 py-2 rounded-2xl border border-pink-200">
                            ❤️ 1.5K+
                        </span>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 mb-4">Adopta un Amigo</h3>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed font-medium">
                        Miles de mascotas esperan un hogar lleno de amor. Encuentra a tu compañero perfecto.
                    </p>
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center text-gray-700 bg-white/50 rounded-2xl p-3">
                            <i class="fas fa-shield-alt text-green-500 text-lg mr-3"></i>
                            <span class="font-semibold">Proceso verificado y seguro</span>
                        </div>
                        <div class="flex items-center text-gray-700 bg-white/50 rounded-2xl p-3">
                            <i class="fas fa-hand-holding-heart text-red-500 text-lg mr-3"></i>
                            <span class="font-semibold">Seguimiento post-adopción</span>
                        </div>
                        <div class="flex items-center text-gray-700 bg-white/50 rounded-2xl p-3">
                            <i class="fas fa-comments text-blue-500 text-lg mr-3"></i>
                            <span class="font-semibold">Asesoramiento gratuito</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-home mr-1"></i>
                            +1,500 adopciones
                        </div>
                        <a href="{{ route('adopciones.index') }}" 
                           class="bg-gradient-to-r from-pink-500 to-rose-600 text-white px-8 py-4 rounded-2xl hover:from-pink-600 hover:to-rose-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center group/btn">
                            Adoptar Ahora
                            <i class="fas fa-arrow-right ml-3 group-hover/btn:translate-x-2 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información sobre el cuidado de mascotas -->
        <div class="bg-white rounded-3xl shadow-2xl p-12 mb-20 border border-gray-100/50">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-black text-gray-900 mb-4">Cuidado Responsable de Mascotas</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Tu mascota depende de ti para tener una vida larga, saludable y feliz
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-heartbeat text-red-500 mr-3"></i>
                        Salud y Bienestar
                    </h3>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Visitas veterinarias regulares:</strong> Al menos una vez al año para chequeos preventivos</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Vacunación al día:</strong> Protege a tu mascota de enfermedades graves</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Control de parásitos:</strong> Desparasitación interna y externa periódica</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Alimentación balanceada:</strong> Según la edad, tamaño y necesidades específicas</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-home text-blue-500 mr-3"></i>
                        Entorno Seguro
                    </h3>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Espacio adecuado:</strong> Un lugar cómodo para descansar y jugar</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Ejercicio diario:</strong> Paseos y actividad física según la raza</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Socialización:</strong> Exposición controlada a personas y otros animales</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span><strong>Identificación:</strong> Microchip y placa con tus datos de contacto</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-12 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 border border-blue-100">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">¿Sabías que?</h3>
                <p class="text-lg text-gray-700 text-center">
                    Las mascotas que reciben atención veterinaria regular viven en promedio <strong>2 años más</strong> 
                    y tienen una mejor calidad de vida. La prevención es clave para detectar problemas de salud a tiempo.
                </p>
            </div>
        </div>

        <!-- App Móvil Section -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 rounded-3xl p-12 text-white mb-20 relative overflow-hidden shadow-2xl">
            <!-- Background Animation -->
            <div class="absolute inset-0">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/10 rounded-full translate-x-32 translate-y-32"></div>
            </div>
            
            <div class="relative z-10">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="lg:w-1/2 mb-10 lg:mb-0">
                        <h2 class="text-4xl md:text-5xl font-black mb-6">Lleva a PetPedia contigo</h2>
                        <p class="text-xl text-purple-100 mb-8 leading-relaxed">
                            Descarga nuestra app móvil y ten acceso a todos los servicios para el cuidado de tu mascota desde cualquier lugar.
                        </p>
                        
                        <div class="space-y-6 mb-8">
                            <div class="flex items-center">
                                <div class="bg-white/20 w-12 h-12 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-bell text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Recordatorios automáticos</h4>
                                    <p class="text-purple-100">Vacunas, desparasitaciones y citas veterinarias</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="bg-white/20 w-12 h-12 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Ubicación en tiempo real</h4>
                                    <p class="text-purple-100">Encuentra veterinarias y servicios cerca de ti</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="bg-white/20 w-12 h-12 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-history text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Historial médico digital</h4>
                                    <p class="text-purple-100">Accede al historial de tu mascota en cualquier momento</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#" class="bg-white text-purple-600 px-6 py-4 rounded-2xl font-bold hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg inline-flex items-center justify-center">
                                <i class="fab fa-google-play text-2xl mr-3"></i>
                                <div class="text-left">
                                    <div class="text-xs">Disponible en</div>
                                    <div class="text-lg">Google Play</div>
                                </div>
                            </a>
                            <a href="#" class="bg-white text-purple-600 px-6 py-4 rounded-2xl font-bold hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg inline-flex items-center justify-center">
                                <i class="fab fa-apple text-2xl mr-3"></i>
                                <div class="text-left">
                                    <div class="text-xs">Descarga en</div>
                                    <div class="text-lg">App Store</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="lg:w-2/5 flex justify-center">
                        <div class="relative">
                            <!-- Aquí iría la imagen del logo o un mockup de la app -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20 w-64 h-96 flex items-center justify-center">
                                <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia App" class="max-w-full max-h-full">
                            </div>
                            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-yellow-400 rounded-full opacity-20"></div>
                            <div class="absolute -top-6 -left-6 w-24 h-24 bg-pink-400 rounded-full opacity-20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emergency Section Mejorada -->
        <div class="bg-gradient-to-r from-red-500 via-orange-500 to-pink-600 rounded-3xl p-12 text-center text-white mb-20 relative overflow-hidden shadow-2xl">
            <!-- Background Animation -->
            <div class="absolute inset-0">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/10 rounded-full translate-x-32 translate-y-32"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full"></div>
            </div>
            
            <div class="relative z-10">
                <div class="flex justify-center mb-8">
                    <div class="bg-white/20 backdrop-blur-sm p-6 rounded-3xl border border-white/30">
                        <i class="fas fa-exclamation-triangle text-4xl"></i>
                    </div>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-black mb-6">¿Emergencia Veterinaria?</h2>
                <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto font-medium">
                    No esperes, actúa rápido. Nuestros veterinarios están disponibles 24/7 para emergencias
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-10">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-left hover:bg-white/15 transition duration-300">
                        <div class="flex items-center mb-4">
                            <div class="bg-red-400 w-12 h-12 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-white text-lg"></i>
                            </div>
                            <h4 class="font-bold text-xl">Línea de Emergencia</h4>
                        </div>
                        <p class="text-red-100">Llama inmediatamente para recibir instrucciones y ubicar la veterinaria más cercana</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-left hover:bg-white/15 transition duration-300">
                        <div class="flex items-center mb-4">
                            <div class="bg-orange-400 w-12 h-12 rounded-2xl flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                            <h4 class="font-bold text-xl">Veterinarias 24h</h4>
                        </div>
                        <p class="text-red-100">Encuentra clínicas de emergencia disponibles las 24 horas cerca de tu ubicación</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ route('veterinarias.index') }}?emergency=true" 
                       class="bg-white text-red-600 px-12 py-5 rounded-2xl font-black hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-2xl inline-flex items-center text-lg">
                        <i class="fas fa-search-location mr-4 text-xl"></i>
                        Veterinarias de Emergencia
                    </a>
                    <button class="bg-white/20 backdrop-blur-sm text-white px-8 py-5 rounded-2xl font-bold hover:bg-white/30 transition duration-300 transform hover:scale-105 border border-white/30 inline-flex items-center">
                        <i class="fas fa-phone mr-4 text-xl"></i>
                        Línea 24/7: 01-800-PET-HELP
                    </button>
                </div>
            </div>
        </div>

        <!-- CTA Final Section -->
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">¿Listo para comenzar?</h2>
            <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                Explora todos nuestros servicios y encuentra exactamente lo que tu mascota necesita
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('veterinarias.index') }}" 
                   class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-10 py-5 rounded-2xl hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105 shadow-2xl font-bold text-lg flex items-center">
                    <i class="fas fa-stethoscope mr-3"></i>
                    Veterinarias
                </a>
                <a href="{{ route('adopciones.index') }}" 
                   class="bg-gradient-to-r from-pink-500 to-rose-600 text-white px-10 py-5 rounded-2xl hover:from-pink-600 hover:to-rose-700 transition-all duration-300 transform hover:scale-105 shadow-2xl font-bold text-lg flex items-center">
                    <i class="fas fa-paw mr-3"></i>
                    Adopciones
                </a>
                <a href="{{ route('products.index') }}" 
                   class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-10 py-5 rounded-2xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-2xl font-bold text-lg flex items-center">
                    <i class="fas fa-shopping-bag mr-3"></i>
                    Productos
                </a>
            </div>
        </div>
    </div>
</div>

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
</style>

<script>
    // Efectos de entrada para las tarjetas
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.group');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endsection