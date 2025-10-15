<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdoptionController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL', 'http://127.0.0.1:8000/api');
    }

    /**
     * Mostrar todas las mascotas disponibles para adopción
     */
    public function index()
    {
        try {
            // Llamada a la API para obtener mascotas disponibles
            $response = Http::timeout(30)->get("{$this->apiUrl}/pets/available");
            
            if ($response->successful()) {
                $pets = $response->json();
                
                // Si la respuesta tiene estructura success/data
                if (isset($pets['success']) && $pets['success']) {
                    $pets = $pets['data'] ?? [];
                }
                
                return view('adopciones.index', compact('pets'));
            }
            
            // Si la API no responde correctamente
            return view('adopciones.index', [
                'pets' => [],
                'error' => 'No se pudieron cargar las mascotas disponibles'
            ]);
            
        } catch (\Exception $e) {
            return view('adopciones.index', [
                'pets' => [],
                'error' => 'Error de conexión con el servidor: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Mostrar detalles de una mascota específica
     */
    public function show($id)
    {
        try {
            $response = Http::timeout(30)->get("{$this->apiUrl}/pets/{$id}");
            
            if ($response->successful()) {
                $pet = $response->json();
                
                // Si la respuesta tiene estructura success/data
                if (isset($pet['success']) && $pet['success']) {
                    $pet = $pet['data'] ?? null;
                }
                
                if ($pet) {
                    return view('adopciones.show', compact('pet'));
                }
            }
            
            return redirect()->route('adopciones')
                ->with('error', 'Mascota no encontrada');
                
        } catch (\Exception $e) {
            return redirect()->route('adopciones')
                ->with('error', 'Error al cargar la mascota: ' . $e->getMessage());
        }
    }

    /**
     * Enviar solicitud de adopción
     */
    public function adopt(Request $request, $petId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        try {
            // Obtener el token de la sesión
            $token = session('token');
            
            if (!$token) {
                return redirect()->route('login')
                    ->with('error', 'Debes iniciar sesión para solicitar una adopción');
            }

            // Enviar solicitud a la API
            $response = Http::timeout(30)
                ->withToken($token)
                ->post("{$this->apiUrl}/adoptions", [
                    'pet_id' => $petId,
                    'comment' => $request->comment,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return redirect()->route('adopciones')
                    ->with('success', '¡Solicitud de adopción enviada exitosamente! El refugio se pondrá en contacto contigo pronto.');
            }
            
            // Si la API devuelve un error
            $error = $response->json()['message'] ?? 'No se pudo enviar la solicitud';
            return back()->with('error', $error)->withInput();
            
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error al procesar la solicitud: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Ver mis solicitudes de adopción
     */
    public function myAdoptions()
    {
        try {
            // Obtener el token de la sesión
            $token = session('token');
            
            if (!$token) {
                return redirect()->route('login')
                    ->with('error', 'Debes iniciar sesión para ver tus solicitudes');
            }

            // Llamada a la API para obtener las solicitudes del usuario
            $response = Http::timeout(30)
                ->withToken($token)
                ->get("{$this->apiUrl}/adoptions/my-adoptions");
            
            if ($response->successful()) {
                $adoptions = $response->json();
                
                // Si la respuesta tiene estructura success/data
                if (isset($adoptions['success']) && $adoptions['success']) {
                    $adoptions = $adoptions['data'] ?? [];
                }
                
                return view('adopciones.my-adoptions', compact('adoptions'));
            }
            
            return view('adopciones.my-adoptions', [
                'adoptions' => [],
                'error' => 'No se pudieron cargar tus solicitudes'
            ]);
            
        } catch (\Exception $e) {
            return view('adopciones.my-adoptions', [
                'adoptions' => [],
                'error' => 'Error de conexión: ' . $e->getMessage()
            ]);
        }
    }
}