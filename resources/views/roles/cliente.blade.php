@extends('layouts.tailwind')

@section('content')
<div class="text-center">
  <h2>Bienvenido, {{ session('user.name') }}</h2>
  <p class="lead">Has iniciado sesión como <strong>Cliente</strong>.</p>
  <a href="/logout" class="btn btn-danger">Cerrar sesión</a>
</div>
@endsection
