@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="mb-3 text-center">Iniciar sesión</h4>

        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first('login') }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
          @csrf
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <p class="mt-3 text-center">¿No tienes cuenta? <a href="/register">Regístrate</a></p>
      </div>
    </div>
  </div>
</div>
@endsection
