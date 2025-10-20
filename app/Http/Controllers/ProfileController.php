<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }


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
    try {
        // Validar en el frontend antes de enviar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'biography' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Log::info('Perfil - Validación pasada', ['has_photo' => $request->hasFile('photo')]);

        // Obtener token y user de sesión
        $token = session('token');
        $user = session('user');

        if (!$token || !$user) {
            return redirect('/login')->with('error', 'Debes iniciar sesión.');
        }

        // URL CORREGIDA - usa PUT con el ID del usuario
        $apiUrl = env('API_URL') . '/profile/' . $user['id'];

        Log::info('Perfil - Enviando a API', ['url' => $apiUrl, 'user_id' => $user['id']]);

        if ($request->hasFile('photo')) {
            Log::info('Perfil - Con foto');
            
            // Para PUT con archivos, necesitamos usar multipart
            $response = Http::withToken($token)
                ->timeout(30)
                ->asMultipart()
                ->attach(
                    'photo', 
                    file_get_contents($request->file('photo')->getRealPath()),
                    $request->file('photo')->getClientOriginalName()
                );

            // Agregar los otros campos
            foreach ($validated as $key => $value) {
                if ($key !== 'photo') {
                    $response = $response->attach($key, $value ?? '');
                }
            }

            $response = $response->put($apiUrl);

        } else {
            Log::info('Perfil - Sin foto');
            
            // Sin foto, PUT normal
            $response = Http::withToken($token)
                ->timeout(30)
                ->put($apiUrl, $validated);
        }

        Log::info('Perfil - Respuesta API', [
            'status' => $response->status(),
            'success' => $response->successful()
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            
            // Actualizar sesión con los nuevos datos
            if (isset($responseData['user'])) {
                session(['user' => $responseData['user']]);
            }
            
            Log::info('Perfil - Actualización exitosa');
            return back()->with('success', 'Tu perfil se ha actualizado correctamente.');
        }

        // Manejar errores
        $errorData = $response->json();
        $errorMessage = $errorData['message'] ?? 'Error desconocido del servidor';
        
        Log::error('Perfil - Error del backend', [
            'status' => $response->status(),
            'error' => $errorMessage
        ]);

        return back()->with('error', 'Error al actualizar el perfil: ' . $errorMessage);

    } catch (\Exception $e) {
        Log::error('Perfil - Excepción', [
            'message' => $e->getMessage()
        ]);

        return back()->with('error', 'Error de conexión: ' . $e->getMessage());
    }
}
}