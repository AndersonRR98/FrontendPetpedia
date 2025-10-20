<!DOCTYPE html> <!-- vista de layaout principal-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PetPedia')</title>
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
        
        /* Mejoras para la estabilidad del dropdown */
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
        
        /* Delay para evitar cierre accidental */
        .dropdown-delay {
            transition-delay: 150ms;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-cyan-50">
    <!-- Navbar Mejorado -->
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
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <div class="relative">
                            <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-10 w-auto transform group-hover:scale-110 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </div>
                        <span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent text-2xl font-black ml-3">
                            PetPedia
                        </span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop Mejorado -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group {{ request()->routeIs('dashboard') ? 'text-white gradient-bg shadow-lg' : 'text-gray-700 hover:text-purple-600' }}">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                    </a>

                    <!-- Servicios Dropdown Mejorado con mejor manejo de hover -->
                    <div class="dropdown-container relative" 
                         @mouseenter="openServices()" 
                         @mouseleave="closeServices()">
                        <button @click="servicesOpen = !servicesOpen"
                                class="flex items-center px-5 py-2.5 rounded-2xl font-semibold text-gray-700 hover:text-white transition-all duration-300 group relative">
                            <i class="fas fa-concierge-bell mr-2"></i>
                            Servicios
                            <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300" :class="{ 'rotate-180': servicesOpen }"></i>
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                        </button>
                        
                        <!-- Dropdown Menu Mejorado con estabilidad -->
                        <div x-show="servicesOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             @mouseenter="keepServicesOpen()"
                             @mouseleave="closeServices()"
                             class="absolute left-0 mt-2 w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 py-3 z-50 dropdown-menu"
                             :class="{ 'open': servicesOpen }">
                            
                            <a href="{{ route('veterinarias.index') }}" 
                               class="flex items-center px-5 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-indigo-50 hover:text-purple-600 transition-all duration-300 group border-b border-gray-100/50 dropdown-delay">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-clinic-medical text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-purple-600">Veterinarias</p>
                                    <p class="text-sm text-gray-500 mt-1">Atención médica profesional</p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto text-gray-300 group-hover:text-purple-500 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            </a>

                            <a href="{{ route('entrenadores.index') }}" 
                               class="flex items-center px-5 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 hover:text-green-600 transition-all duration-300 group border-b border-gray-100/50 dropdown-delay">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-dumbbell text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-green-600">Entrenadores</p>
                                    <p class="text-sm text-gray-500 mt-1">Adiestramiento canino</p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto text-gray-300 group-hover:text-green-500 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            </a>

                            <a href="{{ route('adopciones.index') }}" 
                               class="flex items-center px-5 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-pink-50 hover:to-rose-50 hover:text-pink-600 transition-all duration-300 group border-b border-gray-100/50 dropdown-delay">
                                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-paw text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-pink-600">Adopciones</p>
                                    <p class="text-sm text-gray-500 mt-1">Adopta una mascota</p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto text-gray-300 group-hover:text-pink-500 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            </a>

                            <a href="{{ route('products.index') }}" 
                               class="flex items-center px-5 py-4 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-600 transition-all duration-300 group dropdown-delay">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-shopping-bag text-white text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 group-hover:text-blue-600">Productos</p>
                                    <p class="text-sm text-gray-500 mt-1">Compra para tu mascota</p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto text-gray-300 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-all duration-300"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Foro Mejorado -->
                    <a href="{{ route('foros.index') }}" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group {{ request()->routeIs('foros.*') ? 'text-white gradient-bg shadow-lg' : 'text-gray-700 hover:text-purple-600' }}">
                        <i class="fas fa-comments mr-2"></i>
                        Foro
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                    </a>

                    <!-- Perfil Mejorado -->
                    <a href="{{ route('profile.show') }}" 
                       class="relative px-5 py-2.5 rounded-2xl font-semibold transition-all duration-300 group {{ request()->routeIs('profile.*') ? 'text-white gradient-bg shadow-lg' : 'text-gray-700 hover:text-purple-600' }}">
                        <i class="fas fa-user mr-2"></i>
                        Mi Perfil
                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                    </a>
                </div>

                <!-- User Menu - Desktop Mejorado -->
                <div class="hidden lg:flex items-center space-x-3">
                    <div class="flex items-center space-x-3 bg-gradient-to-r from-purple-500/10 to-indigo-500/10 rounded-2xl px-4 py-2 border border-purple-200/50">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-sm">
                                {{ substr(session('user')['name'] ?? 'U', 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-800 font-semibold text-sm block">{{ session('user')['name'] ?? 'Usuario' }}</span>
                            <span class="text-gray-500 text-xs">{{ session('user')['email'] ?? '' }}</span>
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
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-100 text-purple-600 font-semibold">
                        <div class="flex items-center">
                            <i class="fas fa-home text-purple-500 mr-3 text-lg"></i>
                            Dashboard
                        </div>
                        <i class="fas fa-arrow-right text-purple-400"></i>
                    </a>
                    
                    <!-- Servicios Mobile -->
                    <div class="space-y-3">
                        <p class="font-bold text-gray-900 px-2 text-lg">Servicios</p>
                        
                        <a href="{{ route('veterinarias.index') }}" 
                           class="flex items-center p-4 rounded-2xl bg-white border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-3">
                                <i class="fas fa-clinic-medical text-white text-sm"></i>
                            </div>
                            <span class="font-semibold text-gray-700 group-hover:text-purple-600">Veterinarias</span>
                        </a>
                        
                        <a href="{{ route('entrenadores.index') }}" 
                           class="flex items-center p-4 rounded-2xl bg-white border border-gray-100 hover:border-green-200 hover:bg-green-50 transition-all duration-300 group">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mr-3">
                                <i class="fas fa-dumbbell text-white text-sm"></i>
                            </div>
                            <span class="font-semibold text-gray-700 group-hover:text-green-600">Entrenadores</span>
                        </a>

                        <a href="{{ route('adopciones.index') }}" 
                           class="flex items-center p-4 rounded-2xl bg-white border border-gray-100 hover:border-pink-200 hover:bg-pink-50 transition-all duration-300 group">
                            <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mr-3">
                                <i class="fas fa-paw text-white text-sm"></i>
                            </div>
                            <span class="font-semibold text-gray-700 group-hover:text-pink-600">Adopciones</span>
                        </a>

                        <a href="{{ route('products.index') }}" 
                           class="flex items-center p-4 rounded-2xl bg-white border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-all duration-300 group">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-3">
                                <i class="fas fa-shopping-bag text-white text-sm"></i>
                            </div>
                            <span class="font-semibold text-gray-700 group-hover:text-blue-600">Productos</span>
                        </a>
                    </div>

                    <!-- Foro y Perfil Mobile -->
                    <a href="{{ route('foros.index') }}" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-white border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                        <div class="flex items-center">
                            <i class="fas fa-comments text-purple-500 mr-3 text-lg"></i>
                            Foro
                        </div>
                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-purple-500"></i>
                    </a>

                    <a href="{{ route('profile.show') }}" 
                       class="flex items-center justify-between p-4 rounded-2xl bg-white border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                        <div class="flex items-center">
                            <i class="fas fa-user text-purple-500 mr-3 text-lg"></i>
                            Mi Perfil
                        </div>
                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-purple-500"></i>
                    </a>

                    <!-- Información del usuario y logout Mobile -->
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-purple-500/5 to-indigo-500/5 rounded-2xl mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold">
                                    {{ substr(session('user')['name'] ?? 'U', 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-gray-900 font-bold">{{ session('user')['name'] ?? 'Usuario' }}</p>
                                <p class="text-gray-500 text-sm">{{ session('user')['email'] ?? '' }}</p>
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

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Mejorado -->
    <footer class="bg-gradient-to-r from-gray-900 to-purple-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo y descripción mejorado -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-10 w-auto">
                        <span class="text-white text-2xl font-black ml-3">PetPedia</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        La plataforma líder para el cuidado y bienestar de tus mascotas. 
                        Conectamos dueños con los mejores profesionales veterinarios, 
                        entrenadores y refugios. Tu mascota merece lo mejor.
                    </p>
                </div>

                <!-- Enlaces rápidos mejorado -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">Enlaces Rápidos</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white transition duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-purple-400 mr-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            Dashboard
                        </a></li>
                        <li><a href="{{ route('veterinarias.index') }}" class="hover:text-white transition duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-purple-400 mr-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            Veterinarias
                        </a></li>
                        <li><a href="{{ route('entrenadores.index') }}" class="hover:text-white transition duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-purple-400 mr-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            Entrenadores
                        </a></li>
                        <li><a href="{{ route('adopciones.index') }}" class="hover:text-white transition duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-purple-400 mr-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            Adopciones
                        </a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-purple-400 mr-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                            Productos
                        </a></li>
                    </ul>
                </div>

                <!-- Contacto mejorado -->
                <div>
                    <h3 class="font-bold text-lg mb-6 text-white">Contacto</h3>
                    <ul class="space-y-4 text-sm text-gray-300">
                        <li class="flex items-center">
                            <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-purple-400"></i>
                            </div>
                            info@petpedia.com
                        </li>
                        <li class="flex items-center">
                            <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-purple-400"></i>
                            </div>
                            +1 (555) 123-4567
                        </li>
                        <li class="flex items-center">
                            <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-purple-400"></i>
                            </div>
                            Ciudad, País
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright mejorado -->
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2024 PetPedia. Todos los derechos reservados. 
                    <span class="text-purple-400">Hecho con ❤️ para mascotas</span>
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>