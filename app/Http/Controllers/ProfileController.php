<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;


class ProfileController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Muestra la vista de perfil con los datos del usuario.
     */
    public function show()
    {
        $user = session('user');
        if (!$user || !isset($user['id'])) {
            return redirect('/login')->withErrors(['session' => 'Sesión expirada.']);
        }

        // Obtener datos actualizados desde la API
        $response = $this->apiService->get("/profile/{$user['id']}");
        
        if (isset($response['success']) && !$response['success']) {
            return redirect('/login')->with('error', $response['error'] ?? 'Error al obtener el perfil');
        }

        // Actualiza la sesión con los datos frescos del usuario
        session(['profile' => $response]);
        
        return view('profile.show', ['user' => $response]);
    }

  
     public function update(Request $request)
{
    // Validar en el frontend antes de enviar
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'biography' => 'nullable|string|max:1000',
    ]);

    // Obtener token de sesión
    $token = session('token');

    if (!$token) {
        return redirect('/login')->with('error', 'Debes iniciar sesión.');
    }

    // Enviar la actualización al backend
    $response = Http::withToken($token)
                    ->put(env('API_URL') . '/profile', $validated);

    if ($response->successful()) {
        // Actualizamos también los datos locales de sesión
        session(['user' => $response->json()]);
        return back()->with('success', 'Tu perfil se ha actualizado correctamente.');
    }

    // Manejar errores del backend
    return back()->with('error', 'Error al actualizar el perfil: ' . ($response->json('message') ?? 'Error desconocido.'));
}

}
