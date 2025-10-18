<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckApiSession
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero');
        }

        // Verificar token con la API
        $response = Http::withToken($token)
                        ->get(env('API_URL') . '/auth/me');

        if ($response->failed()) {
            session()->flush(); // eliminar sesión si token inválido
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero');
        }

        // Guardar usuario actualizado en sesión
        session(['user' => $response->json()]);

        return $next($request);
    }
}
