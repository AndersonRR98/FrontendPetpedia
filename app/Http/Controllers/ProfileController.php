<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = env('API_URL', 'http://localhost:8001/api');
    }

    /**
     * Muestra el formulario de perfil con la información del usuario de la sesión.
     */
    public function show()
    {
        $user = session('user'); // Obtiene el usuario de la sesión

        if (!$user) {
            return redirect('/login')->withErrors(['session' => 'Sesión expirada.']);
        }

        // Si necesitas los datos más actualizados del backend (Recomendado)
        $response = Http::withToken(session('token'))->get("{$this->api}/users/{$user['id']}");
        
        if ($response->successful()) {
            $user = $response->json();
            session(['user' => $user]); // Actualiza la sesión con los datos frescos
        }
        
        return view('profile.show', compact('user'));
    }

    /**
     * Envía los datos actualizados a la API de Backend.
     */
    public function update(Request $request)
    {
        $user = session('user');

        if (!$user || !isset($user['id'])) {
            return redirect('/login')->withErrors(['session' => 'Sesión expirada.']);
        }

        // Validación básica en el frontend antes de enviar a la API
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
        ]);

        $dataToUpdate = $request->only(['name', 'email', 'phone', 'address', 'biography']);

        // Envío de la solicitud PUT a la API
        $response = Http::withToken(session('token'))
                        ->put("{$this->api}/users/{$user['id']}", $dataToUpdate);

        if ($response->successful()) {
            $updatedUser = $response->json();
            session(['user' => $updatedUser]); // Actualiza la sesión con la respuesta del backend
            return back()->with('success', 'Perfil actualizado correctamente.');
        }

        // Manejo de errores de validación o del API (usando la lógica de corrección anterior)
        $responseData = $response->json();
        $errorMessages = ['update' => $responseData['message'] ?? 'Error al actualizar.'];
        $validationErrors = $responseData['errors'] ?? [];

        // Lógica para aplanar errores anidados
        if (!empty($validationErrors) && is_array($validationErrors)) {
            foreach ($validationErrors as $field => $messages) {
                if (is_array($messages)) {
                    foreach ($messages as $message) {
                        $errorMessages["$field"] = $message;
                    }
                } else {
                    $errorMessages["$field"] = $messages;
                }
            }
        }
        
        return back()->withErrors($errorMessages)->withInput();
    }
}