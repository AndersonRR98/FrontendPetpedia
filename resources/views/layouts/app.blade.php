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
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-8 w-auto">
                        <span class="text-indigo-600 text-xl font-bold ml-3">PetPedia</span>
                    </a>
                </div>

                <!-- Navegación de Escritorio -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" 
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 {{ request()->routeIs('dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600' : '' }}">
                        <i class="fas fa-home mr-1"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('citas.index') }}" 
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 {{ request()->routeIs('citas.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : '' }}">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Mis Citas
                    </a>
                    
                    <!-- 📦 NUEVO: Enlace a la Tienda de Productos -->
                    <a href="{{ route('products.index') }}" 
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 {{ request()->routeIs('products.*') || request()->routeIs('cart.*') || request()->routeIs('checkout.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : '' }}">
                        <i class="fas fa-store mr-1"></i>
                        Tienda
                    </a>
                    <!-- FIN NUEVO: Tienda -->

                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 flex items-center">
                            <i class="fas fa-concierge-bell mr-1"></i>
                            Servicios
                            <i class="fas fa-chevron-down ml-1 text-xs" :class="{ 'rotate-180': open }"></i>
                        </button>
                        
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

                            <a href="{{ route('adopciones') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition duration-200">
                                <i class="fas fa-heart text-pink-600 mr-3"></i>
                                <div>
                                    <p class="font-medium">Adopciones</p>
                                    <p class="text-xs text-gray-500">Dale un hogar a una mascota</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('profile.show') }}" 
                       class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200 {{ request()->routeIs('profile.show') ? 'text-indigo-600 border-b-2 border-indigo-600' : '' }}">
                        <i class="fas fa-user mr-1"></i>
                        Mi Perfil
                    </a>
                </div>

                <!-- Iconos de Carrito y Usuario (Escritorio) -->
                <div class="hidden md:flex items-center space-x-4">
                    
                    <!-- 🛒 NUEVO: Ícono del Carrito de Compras -->
                    @php
                        $cart = session('cart', []);
                        $itemCount = count($cart);
                    @endphp

                    <a href="{{ route('cart.index') }}" 
                       class="p-2 relative text-gray-700 hover:text-indigo-600 transition duration-150">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @if ($itemCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ $itemCount }}
                        </span>
                        @endif
                    </a>
                    <!-- FIN NUEVO: Carrito -->

                    <div class="flex items-center space-x-2">
                        <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                            {{ strtoupper(substr(session('user.name', 'D'), 0, 1)) }}
                        </div>
                        <span class="text-gray-800 font-medium">
                            {{ session('user.name') ?? 'Usuario' }}
                        </span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded text-sm transition duration-200">
                            Salir
                        </button>
                    </form>
                </div>
                
                <!-- Botón de Menú Móvil -->
                <div class="flex md:hidden">
                    <button @click="open = true" type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <i class="fas fa-bars h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Menú Móvil Desplegable -->
        <div x-show="open" 
             x-transition:enter="duration-200 ease-out" 
             x-transition:enter-start="opacity-0 scale-95" 
             x-transition:enter-end="opacity-100 scale-100" 
             x-transition:leave="duration-100 ease-in" 
             x-transition:leave-start="opacity-100 scale-100" 
             x-transition:leave-end="opacity-0 scale-95" 
             class="md:hidden absolute w-full bg-white shadow-lg pb-3">
             
            <div class="px-2 pt-2 space-y-1 sm:px-3">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Dashboard</a>
                <a href="{{ route('citas.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Mis Citas</a>
                
                <!-- 📦 NUEVO: Enlace a la Tienda (Móvil) -->
                <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">
                    <i class="fas fa-store mr-1"></i> Tienda
                </a>
                <!-- 🛒 NUEVO: Enlace al Carrito (Móvil) -->
                <a href="{{ route('cart.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 flex items-center justify-between">
                    <span><i class="fas fa-shopping-cart mr-1"></i> Carrito</span>
                    @if ($itemCount > 0)
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                        {{ $itemCount }}
                    </span>
                    @endif
                </a>

                <a href="{{ route('veterinarias.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Veterinarias</a>
                <a href="{{ route('entrenadores.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Entrenadores</a>
                <a href="{{ route('refugios.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Refugios</a>
                <a href="{{ route('adopciones') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Adopciones</a>
                <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Mi Perfil</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-lg">
                        {{ strtoupper(substr(session('user.name', 'D'), 0, 1)) }}
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ session('user.name') ?? 'Usuario' }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ session('user.email') ?? 'email@ejemplo.com' }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-red-600 hover:bg-red-50">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
