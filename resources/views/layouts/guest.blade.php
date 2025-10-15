<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PetPedia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navbar Público (Home) -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo petpedia.png') }}" alt="PetPedia Logo" class="h-8 w-auto">
                        <span class="text-indigo-600 text-xl font-bold ml-3">PetPedia</span>
                    </a>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Inicio
                    </a>
                    <a href="#servicios" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Servicios
                    </a>
                    <a href="#about" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Nosotros
                    </a>
                    <a href="#contact" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Contacto
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-200">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 font-medium">
                        Registrarse
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobileMenuButton" class="text-gray-700 hover:text-indigo-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden hidden border-t border-gray-200 pt-4 pb-6">
                <div class="space-y-4">
                    <a href="/" class="block text-gray-700 hover:text-indigo-600 font-medium">Inicio</a>
                    <a href="#servicios" class="block text-gray-700 hover:text-indigo-600 font-medium">Servicios</a>
                    <a href="#about" class="block text-gray-700 hover:text-indigo-600 font-medium">Nosotros</a>
                    <a href="#contact" class="block text-gray-700 hover:text-indigo-600 font-medium">Contacto</a>
                    <div class="pt-4 border-t border-gray-200 space-y-2">
                        <a href="{{ route('login') }}" class="block text-gray-700 hover:text-indigo-600 font-medium">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="block bg-indigo-600 text-white px-4 py-2 rounded-lg text-center font-medium">Registrarse</a>
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
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 PetPedia. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>