<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetPedia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">🐾 PetPedia</a>
      <div>
        @if(session('user'))
          <span class="text-white me-3">Hola, {{ session('user.name') }}</span>
          <a href="/logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        @endif
      </div>
    </div>
  </nav>

  <main class="container mt-4">
    @yield('content')
  </main>
</body>
</html>
