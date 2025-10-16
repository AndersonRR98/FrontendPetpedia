<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PetPedia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navbar del Dashboard -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-8 w-auto">
                        <span class="text-indigo-600 text-xl font-bold ml-3">PetPedia</span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" 
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 {{ request()->routeIs('dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600' : '' }}">
                        <i class="fas fa-home mr-1"></i>
                        Dashboard
                    </a>

                    <!-- Enlace directo a Mis Citas -->
                    <a href="{{ route('citas.index') }}" 
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 {{ request()->routeIs('citas.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : '' }}">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Mis Citas
                    </a>

                    <!-- Servicios Dropdown -->
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 flex items-center">
                            <i class="fas fa-concierge-bell mr-1"></i>
                            Servicios
                            <i class="fas fa-chevron-down ml-1 text-xs" :class="{ 'rotate-180': open }"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50">
                            
                            <a href="{{ route('veterinarias.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                                <i class="fas fa-clinic-medical text-indigo-600 mr-3"></i>
                                <div>
                                    <p class="font-medium">Veterinarias</p>
                                    <p class="text-xs text-gray-500">Atención médica profesional</p>
                                </div>
                            </a>

                            <a href="{{ route('entrenadores.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-600 transition duration-200">
                                <i class="fas fa-dumbbell text-green-600 mr-3"></i>
                                <div>
                                    <p class="font-medium">Entrenadores</p>
                                    <p class="text-xs text-gray-500">Adiestramiento canino</p>
                                </div>
                            </a>

                            <a href="{{ route('refugios.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition duration-200">
                                <i class="fas fa-home text-orange-600 mr-3"></i>
                                <div>
                                    <p class="font-medium">Refugios</p>
                                    <p class="text-xs text-gray-500">Conoce los refugios</p>
                                </div>
                            </a>

                            <!-- Nueva opción para Adopciones -->
                            <a href="{{ route('adopciones.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition duration-200">
                                <i class="fas fa-paw text-purple-600 mr-3"></i>
                                <div>
                                    <p class="font-medium">Adopciones</p>
                                    <p class="text-xs text-gray-500">Adopta una mascota</p>
                                </div>
                            </a>

                            <!-- Nueva opción para Productos -->
                            <a href="{{ route('products.index') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-200">
                                <i class="fas fa-shopping-bag text-blue-600 mr-3"></i>
                                <div>
                                    <p class="font-medium">Productos</p>
                                    <p class="text-xs text-gray-500">Compra para tu mascota</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Enlace a Perfil -->
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        <i class="fas fa-user mr-1"></i>
                        Mi Perfil
                    </a>
                </div>

                <!-- User Menu - Desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    <div class="flex items-center space-x-3 bg-gray-100 rounded-full px-4 py-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">
                                {{ substr(session('user')['name'] ?? 'U', 0, 1) }}
                            </span>
                        </div>
                        <span class="text-gray-700 text-sm font-medium">{{ session('user')['name'] ?? 'Usuario' }}</span>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-600 transition duration-200 flex items-center space-x-2 bg-gray-100 hover:bg-red-50 px-3 py-2 rounded-lg">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Salir</span>
                        </button>
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-indigo-600 p-2 rounded-lg bg-gray-100">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" class="md:hidden border-t border-gray-200 pt-4 pb-6">
                <div class="space-y-4">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center text-gray-700 hover:text-indigo-600 font-medium p-3 rounded-lg hover:bg-indigo-50 transition duration-200">
                        <i class="fas fa-home text-indigo-500 mr-3 w-5"></i>
                        Dashboard
                    </a>
                    
                    <!-- Mis Citas -->
                    <a href="{{ route('citas.index') }}" 
                       class="flex items-center text-gray-700 hover:text-indigo-600 font-medium p-3 rounded-lg hover:bg-indigo-50 transition duration-200">
                        <i class="fas fa-calendar-alt text-indigo-500 mr-3 w-5"></i>
                        Mis Citas
                    </a>
                    
                    <!-- Servicios -->
                    <div class="space-y-2">
                        <p class="font-medium text-gray-900 px-3 py-2">Servicios</p>
                        
                        <a href="{{ route('veterinarias.index') }}" 
                           class="flex items-center text-gray-600 hover:text-indigo-600 ml-4 p-3 rounded-lg hover:bg-indigo-50 transition duration-200">
                            <i class="fas fa-clinic-medical text-indigo-500 mr-3 w-5"></i>
                            Veterinarias
                        </a>
                        
                        <a href="{{ route('entrenadores.index') }}" 
                           class="flex items-center text-gray-600 hover:text-green-600 ml-4 p-3 rounded-lg hover:bg-green-50 transition duration-200">
                            <i class="fas fa-dumbbell text-green-500 mr-3 w-5"></i>
                            Entrenadores
                        </a>
                        
                        <a href="{{ route('refugios.index') }}" 
                           class="flex items-center text-gray-600 hover:text-orange-600 ml-4 p-3 rounded-lg hover:bg-orange-50 transition duration-200">
                            <i class="fas fa-home text-orange-500 mr-3 w-5"></i>
                            Refugios
                        </a>

                        <!-- Nueva opción para Adopciones en móvil -->
                        <a href="{{ route('adopciones.index') }}" 
                           class="flex items-center text-gray-600 hover:text-purple-600 ml-4 p-3 rounded-lg hover:bg-purple-50 transition duration-200">
                            <i class="fas fa-paw text-purple-500 mr-3 w-5"></i>
                            Adopciones
                        </a>

                        <!-- Nueva opción para Productos en móvil -->
                        <a href="{{ route('products.index') }}" 
                           class="flex items-center text-gray-600 hover:text-blue-600 ml-4 p-3 rounded-lg hover:bg-blue-50 transition duration-200">
                            <i class="fas fa-shopping-bag text-blue-500 mr-3 w-5"></i>
                            Productos
                        </a>
                    </div>

                    <!-- Mi Perfil -->
                    <a href="#" 
                       class="flex items-center text-gray-700 hover:text-indigo-600 font-medium p-3 rounded-lg hover:bg-indigo-50 transition duration-200">
                        <i class="fas fa-user text-indigo-500 mr-3 w-5"></i>
                        Mi Perfil
                    </a>
                    
                    <!-- Información del usuario y logout -->
                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-3 px-3 py-2 mb-3">
                            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ substr(session('user')['name'] ?? 'U', 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">{{ session('user')['name'] ?? 'Usuario' }}</p>
                                <p class="text-gray-500 text-sm">{{ session('user')['email'] ?? '' }}</p>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center text-red-600 hover:text-red-700 p-3 rounded-lg hover:bg-red-50 transition duration-200">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Cerrar Sesión
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

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo y descripción -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-8 w-auto">
                        <span class="text-white text-xl font-bold ml-3">PetPedia</span>
                    </div>
                    <p class="text-gray-300 text-sm">
                        La plataforma líder para el cuidado y bienestar de tus mascotas. 
                        Conectamos dueños con los mejores profesionales veterinarios, 
                        entrenadores y refugios.
                    </p>
                </div>

                <!-- Enlaces rápidos -->
                <div>
                    <h3 class="font-semibold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white transition duration-200">Dashboard</a></li>
                        <li><a href="{{ route('veterinarias.index') }}" class="hover:text-white transition duration-200">Veterinarias</a></li>
                        <li><a href="{{ route('entrenadores.index') }}" class="hover:text-white transition duration-200">Entrenadores</a></li>
                        <li><a href="{{ route('refugios.index') }}" class="hover:text-white transition duration-200">Refugios</a></li>
                        <li><a href="{{ route('adopciones.index') }}" class="hover:text-white transition duration-200">Adopciones</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition duration-200">Productos</a></li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div>
                    <h3 class="font-semibold mb-4">Contacto</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-indigo-400"></i>
                            info@petpedia.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-indigo-400"></i>
                            +1 (555) 123-4567
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-indigo-400"></i>
                            Ciudad, País
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2024 PetPedia. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>