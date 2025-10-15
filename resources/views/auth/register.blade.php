@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
          <h3 class="text-center mb-4 fw-bold text-primary">Crear cuenta</h3>

          {{-- Mensaje de error --}}
          @if($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ url('/register') }}" method="POST">
            @csrf

            {{-- 🔹 Rol (de primero) --}}
            <div class="mb-3">
              <label for="role_id" class="form-label fw-semibold">Rol</label>
              <select name="role_id" id="role_id" class="form-select" required>
                <option value="">Selecciona un rol...</option>
                @foreach($roles as $role)
                  <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
              </select>
            </div>

            {{-- Nombre --}}
            <div class="mb-3">
              <label for="name" class="form-label fw-semibold">Nombre completo</label>
              <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>

            {{-- Correo --}}
            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
            </div>

            {{-- Teléfono --}}
            <div class="mb-3">
              <label for="phone" class="form-label fw-semibold">Teléfono</label>
              <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') }}">
            </div>

            {{-- Dirección --}}
            <div class="mb-3">
              <label for="address" class="form-label fw-semibold">Dirección</label>
              <input type="text" class="form-control" id="address" name="address" required value="{{ old('address') }}">
            </div>

            {{-- 🌟 Biografía --}}
            <div class="mb-3">
              <label for="biography" class="form-label fw-semibold">Biografía</label>
              <textarea class="form-control" id="biography" name="biography" rows="3" placeholder="Escribe una breve biografía...">{{ old('biography') }}</textarea>
            </div>

            {{-- 🔒 Contraseña --}}
            <div class="mb-3 mt-4">
              <label for="password" class="form-label fw-semibold">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            {{-- Confirmar Contraseña --}}
            <div class="mb-3">
              <label for="password_confirmation" class="form-label fw-semibold">Confirmar contraseña</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            {{-- Botón --}}
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary fw-bold py-2">Registrarse</button>
            </div>
          </form>

          <p class="mt-3 text-center">
            ¿Ya tienes cuenta?
            <a href="/login">Inicia sesión</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
