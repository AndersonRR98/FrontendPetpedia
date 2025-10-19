<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Veterinaria - PetPedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-bg-hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .nav-shadow {
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .dropdown-animation {
            animation: fadeInDown 0.3s ease-out;
        }
        
        .dropdown-container {
            position: relative;
        }
        
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease-out;
        }
        
        .dropdown-menu.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-delay {
            transition-delay: 150ms;
        }

        /* Animaciones personalizadas */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .hover-float:hover {
            animation: float 3s ease-in-out infinite;
        }

        .shadow-4xl {
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.25), 0 30px 60px -30px rgba(0, 0, 0, 0.3);
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.4);
            }
            to {
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.8);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-cyan-50">
    <!-- Navbar Veterinaria Mejorado -->
    <nav class="glass-effect nav-shadow sticky top-0 z-50 border-b border-white/20" x-data="{ 
        open: false, 
        servicesOpen: false,
        servicesTimeout: null,
        closeDelay: 300,
        
        openServices() {
            clearTimeout(this.servicesTimeout);
            this.servicesOpen = true;
        },
        
        closeServices() {
            this.servicesTimeout = setTimeout(() => {
                this.servicesOpen = false;
            }, this.closeDelay);
        },
        
        keepServicesOpen() {
            clearTimeout(this.servicesTimeout);
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <!-- Logo Mejorado -->
                <div class="flex items-center">
                    <a href="{{ route('veterinary.deshboard') }}" class="flex items-center group">
                        <div class="relative">
                            <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-10 w-auto transform group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </div>
                        <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent text-2xl font-black ml-3">
                            PetPedia Vet
                        </span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop Mejorado -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('veterinary.deshboard') }}" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group text-white gradient-bg shadow-lg">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>

                    <!-- Gestión de Citas - Destacado -->
                    <a href="#citas" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg hover:from-green-600 hover:to-emerald-600 pulse-glow">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Gestión de Citas
                    </a>

                    <!-- Pacientes -->
                    <a href="#pacientes" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group text-gray-700 hover:text-purple-600">
                        <i class="fas fa-paw mr-2"></i>
                        Mis Pacientes
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                    </a>

                    <!-- Historial Médico -->
                    <a href="#historial" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group text-gray-700 hover:text-purple-600">
                        <i class="fas fa-file-medical mr-2"></i>
                        Historial
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                    </a>
                </div>

                <!-- User Menu - Desktop Mejorado -->
                <div class="hidden lg:flex items-center space-x-3">
                    <div class="flex items-center space-x-3 bg-gradient-to-r from-purple-500/10 to-indigo-500/10 rounded-2xl px-4 py-2 border border-purple-200/50">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-md text-white text-sm"></i>
                        </div>
                        <div>
                            <span class="text-gray-800 font-semibold text-sm block">{{ session('user')['name'] ?? 'Veterinaria' }}</span>
                            <span class="text-gray-500 text-xs">Veterinaria Profesional</span>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 bg-gradient-to-r from-red-500 to-pink-500 text-white px-4 py-2.5 rounded-2xl hover:from-red-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Salir</span>
                        </button>
                    </form>
                </div>

                <!-- Mobile menu button mejorado -->
                <div class="lg:hidden">
                    <button @click="open = !open" class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-2xl flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-bars text-lg" x-show="!open"></i>
                        <i class="fas fa-times text-lg" x-show="open"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Mejorado -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="lg:hidden bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 mt-3 p-6">
                <div class="space-y-4">
                    <!-- Dashboard Mobile -->
                    <a href="{{ route('veterinary.deshboard') }}" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 text-purple-600 font-semibold">
                        <div class="flex items-center">
                            <i class="fas fa-home text-purple-500 mr-3 text-lg"></i>
                            Dashboard
                        </div>
                        <i class="fas fa-arrow-right text-purple-400"></i>
                    </a>
                    
                    <!-- Gestión de Citas Mobile -->
                    <a href="#citas" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 text-green-600 font-semibold">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-check text-green-500 mr-3 text-lg"></i>
                            Gestión de Citas
                        </div>
                        <i class="fas fa-arrow-right text-green-400"></i>
                    </a>

                    <!-- Pacientes Mobile -->
                    <a href="#pacientes" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-white border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                        <div class="flex items-center">
                            <i class="fas fa-paw text-purple-500 mr-3 text-lg"></i>
                            Mis Pacientes
                        </div>
                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-purple-500"></i>
                    </a>

                    <!-- Historial Mobile -->
                    <a href="#historial" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-white border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                        <div class="flex items-center">
                            <i class="fas fa-file-medical text-purple-500 mr-3 text-lg"></i>
                            Historial Médico
                        </div>
                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-purple-500"></i>
                    </a>

                    <!-- Información del usuario y logout Mobile -->
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-green-500/5 to-emerald-500/5 rounded-2xl mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-user-md text-white"></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-bold">{{ session('user')['name'] ?? 'Veterinaria' }}</p>
                                <p class="text-gray-500 text-sm">Veterinaria Profesional</p>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-gradient-to-r from-red-500 to-pink-500 text-white py-3 px-4 rounded-2xl hover:from-red-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content - Dashboard Veterinaria -->
    <main>
        <!-- Hero Section Veterinaria -->
        <div class="relative bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 text-white overflow-hidden">
            <!-- Background Animation -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-sm rounded-3xl mb-8 border border-white/30">
                        <i class="fas fa-user-md text-white text-3xl"></i>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black mb-6 bg-gradient-to-r from-white to-green-100 bg-clip-text text-transparent leading-tight">
                        ¡Bienvenido, Dr. {{ session('user')['name'] }}!
                    </h1>
                    <p class="text-xl md:text-2xl text-green-100 mb-8 max-w-3xl mx-auto leading-relaxed font-medium">
                        Panel de control especializado para la gestión de tu consulta veterinaria
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-lg">
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                            <i class="fas fa-calendar-check text-green-300 mr-2"></i>
                            <span id="citas-hoy">Cargando citas...</span>
                        </div>
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                            <i class="fas fa-clock text-yellow-300 mr-2"></i>
                            <span id="proximas-citas">Cargando...</span>
                        </div>
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-2xl">
                            <i class="fas fa-star text-blue-300 mr-2"></i>
                            <span>Calificación: 4.9/5</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Citas Hoy -->
                <div class="bg-white rounded-3xl shadow-2xl p-6 border border-green-100 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Citas Hoy</p>
                            <p class="text-3xl font-bold text-gray-900">12</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-calendar-day text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+2 desde ayer</span>
                    </div>
                </div>

                <!-- Pacientes Activos -->
                <div class="bg-white rounded-3xl shadow-2xl p-6 border border-blue-100 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pacientes Activos</p>
                            <p class="text-3xl font-bold text-gray-900">156</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-paw text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-blue-600">
                        <i class="fas fa-plus mr-1"></i>
                        <span>+8 este mes</span>
                    </div>
                </div>

                <!-- Ingresos Mensuales -->
                <div class="bg-white rounded-3xl shadow-2xl p-6 border border-purple-100 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Ingresos Mensuales</p>
                            <p class="text-3xl font-bold text-gray-900">$8,420</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-purple-600">
                        <i class="fas fa-chart-line mr-1"></i>
                        <span>+15% vs mes anterior</span>
                    </div>
                </div>

                <!-- Calificación -->
                <div class="bg-white rounded-3xl shadow-2xl p-6 border border-yellow-100 transform hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Calificación</p>
                            <p class="text-3xl font-bold text-gray-900">4.9/5</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-star text-white text-lg"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-yellow-600">
                        <i class="fas fa-heart mr-1"></i>
                        <span>128 reseñas</span>
                    </div>
                </div>
            </div>

            <!-- Gestión de Citas - Sección Principal -->
            <div id="citas" class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Lista de Citas del Día -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-black text-gray-900">Citas de Hoy</h2>
                            <span class="bg-green-100 text-green-800 text-sm font-bold px-4 py-2 rounded-2xl">
                                {{ \Carbon\Carbon::now()->translatedFormat('l, d F') }}
                            </span>
                        </div>

                        <div class="space-y-4">
                            <!-- Cita 1 -->
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-dog text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">Max - Golden Retriever</p>
                                        <p class="text-sm text-gray-600">Consulta general - 10:00 AM</p>
                                        <p class="text-xs text-gray-500">Dueño: María González</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition duration-200">
                                        Atender
                                    </button>
                                    <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition duration-200">
                                        Reprogramar
                                    </button>
                                </div>
                            </div>

                            <!-- Cita 2 -->
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-cat text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">Luna - Gato Siames</p>
                                        <p class="text-sm text-gray-600">Vacunación anual - 11:30 AM</p>
                                        <p class="text-xs text-gray-500">Dueño: Carlos Rodríguez</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition duration-200">
                                        Atender
                                    </button>
                                    <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition duration-200">
                                        Reprogramar
                                    </button>
                                </div>
                            </div>

                            <!-- Cita 3 -->
                            <div class="flex items-center justify-between p-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl border border-purple-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-dog text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">Rocky - Bulldog Francés</p>
                                        <p class="text-sm text-gray-600">Control post-operatorio - 2:15 PM</p>
                                        <p class="text-xs text-gray-500">Dueño: Ana Martínez</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition duration-200">
                                        Atender
                                    </button>
                                    <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition duration-200">
                                        Reprogramar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button class="w-full mt-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-4 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-xl font-bold flex items-center justify-center">
                            <i class="fas fa-plus mr-3"></i>
                            Nueva Cita Rápida
                        </button>
                    </div>
                </div>

                <!-- Panel de Control Rápido -->
                <div class="space-y-8">
                    <!-- Acciones Rápidas -->
                    <div class="bg-white rounded-3xl shadow-2xl p-6 border border-gray-100">
                        <h3 class="text-xl font-black text-gray-900 mb-6">Acciones Rápidas</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white p-4 rounded-2xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-plus text-lg mb-2"></i>
                                <p class="text-sm font-semibold">Nuevo Paciente</p>
                            </button>
                            <button class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white p-4 rounded-2xl hover:from-purple-600 hover:to-indigo-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-file-medical text-lg mb-2"></i>
                                <p class="text-sm font-semibold">Nuevo Historial</p>
                            </button>
                            <button class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-4 rounded-2xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-prescription text-lg mb-2"></i>
                                <p class="text-sm font-semibold">Recetar</p>
                            </button>
                            <button class="bg-gradient-to-r from-orange-500 to-red-500 text-white p-4 rounded-2xl hover:from-orange-600 hover:to-red-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-notes-medical text-lg mb-2"></i>
                                <p class="text-sm font-semibold">Reporte</p>
                            </button>
                        </div>
                    </div>

                    <!-- Próximas Citas -->
                    <div class="bg-white rounded-3xl shadow-2xl p-6 border border-gray-100">
                        <h3 class="text-xl font-black text-gray-900 mb-6">Próximas Citas</h3>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-yellow-50 rounded-2xl border border-yellow-200">
                                <div class="w-10 h-10 bg-yellow-500 rounded-2xl flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Mañana 9:00 AM</p>
                                    <p class="text-sm text-gray-600">Bella - Control</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-blue-50 rounded-2xl border border-blue-200">
                                <div class="w-10 h-10 bg-blue-500 rounded-2xl flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Mañana 11:00 AM</p>
                                    <p class="text-sm text-gray-600">Thor - Vacunación</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-green-50 rounded-2xl border border-green-200">
                                <div class="w-10 h-10 bg-green-500 rounded-2xl flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Jueves 3:00 PM</p>
                                    <p class="text-sm text-gray-600">Luna - Castración</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información de la Clínica -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-12 border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-black text-gray-900">Mi Consultorio</h2>
                    <button class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-3 rounded-2xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 font-semibold">
                        <i class="fas fa-edit mr-2"></i>Editar Información
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="flex items-center p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-200">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-hospital text-white"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Clínica Veterinaria Central</p>
                            <p class="text-sm text-gray-600">Nombre del consultorio</p>
                        </div>
                    </div>

                    <div class="flex items-center p-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl border border-blue-200">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-stethoscope text-white"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Medicina General</p>
                            <p class="text-sm text-gray-600">Especialización principal</p>
                        </div>
                    </div>

                    <div class="flex items-center p-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl border border-purple-200">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fas fa-id-card text-white"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">VET-123456</p>
                            <p class="text-sm text-gray-600">Licencia veterinaria</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-purple-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-8 w-auto">
                    <span class="text-white text-xl font-black ml-3">PetPedia Vet</span>
                </div>
                <p class="text-gray-300 text-sm">
                    &copy; 2024 PetPedia Veterinaria. Plataforma especializada para profesionales de la salud animal.
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada para las tarjetas
            const cards = document.querySelectorAll('.bg-white');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Actualizar información en tiempo real
            function updateDashboardInfo() {
                const now = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('citas-hoy').textContent = `12 citas para hoy`;
                document.getElementById('proximas-citas').textContent = `8 próximas esta semana`;
            }

            updateDashboardInfo();
            setInterval(updateDashboardInfo, 60000); // Actualizar cada minuto
        });
    </script>
</body>
</html>