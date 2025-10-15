<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'PetPedia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- 🔷 NAVBAR AZUL -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wide">🐾 PetPedia</h1>
            <div class="space-x-6">
                <a href="{{ route('home') }}" class="hover:text-blue-200">Inicio</a>
                <a href="{{ route('compra') }}" class="hover:text-blue-200">Compra</a>
                <a href="{{ route('veterinaria') }}" class="hover:text-blue-200">Veterinaria</a>
                <a href="{{ route('adopciones') }}" class="hover:text-blue-200">Adopciones</a>
                <a href="{{ route('foro') }}" class="hover:text-blue-200">Foro</a>
                <a href="{{ route('perfil') }}" class="hover:text-blue-200">Perfil</a>
                <a href="{{ route('configuracion') }}" class="hover:text-blue-200">Configuración</a>
            </div>
        </div>
    </nav>

    <!-- 🔹 CONTENIDO -->
    <main class="container mx-auto mt-10 p-8 bg-white shadow-xl rounded-2xl">
        @yield('contenido')
    </main>

    <!-- 🔹 FOOTER -->
    <footer class="bg-blue-700 text-white mt-10 py-4 text-center">
        <p>© 2025 PetPedia — Todos los derechos reservados 🐕🐈</p>
    </footer>

</body>
</html>
