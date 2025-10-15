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
                        Dashboard
                    </a>

                    <!-- Servicios Dropdown -->
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 flex items-center">
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
                                    <p class="text-xs text-gray-500">Adopta una mascota</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Mis Citas
                    </a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Mi Perfil
                    </a>
                </div>

                <!-- User Menu - Desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    <span class="text-gray-700">Hola, {{ session('user')['name'] ?? 'Usuario' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 transition duration-200">
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </button>
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" class="md:hidden border-t border-gray-200 pt-4 pb-6">
                <div class="space-y-4">
                    <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>
                    
                    <div class="space-y-2">
                        <p class="font-medium text-gray-900">Servicios</p>
                        <a href="{{ route('veterinarias.index') }}" class="block text-gray-600 hover:text-indigo-600 ml-4">
                            <i class="fas fa-clinic-medical text-indigo-500 mr-2"></i>Veterinarias
                        </a>
                        <a href="{{ route('entrenadores.index') }}" class="block text-gray-600 hover:text-green-600 ml-4">
                            <i class="fas fa-dumbbell text-green-500 mr-2"></i>Entrenadores
                        </a>
                        <a href="{{ route('refugios.index') }}" class="block text-gray-600 hover:text-orange-600 ml-4">
                            <i class="fas fa-home text-orange-500 mr-2"></i>Refugios
                        </a>
                    </div>

                    <a href="#" class="block text-gray-700 hover:text-indigo-600 font-medium">Mis Citas</a>
                    <a href="#" class="block text-gray-700 hover:text-indigo-600 font-medium">Mi Perfil</a>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-gray-900 font-medium">{{ session('user')['name'] ?? 'Usuario' }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700 mt-2">
                                <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
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

    @stack('scripts')
</body>
</html>