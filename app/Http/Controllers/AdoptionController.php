<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Log;

class AdoptionController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        // Consumir el endpoint de ADOPCIONES, no de mascotas
        $response = $this->apiService->get('/adoptions');
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('dashboard')
                ->with('error', $response['error'] ?? 'Error al cargar las adopciones');
        }

        $adopciones = $response ?? [];
        
        Log::info('Adopciones recibidas:', ['count' => count($adopciones)]);
        
        // Extraer las mascotas de las adopciones
        $mascotasAdopcion = $this->extraerMascotasDeAdopciones($adopciones);
        
        return view('adopciones.index', [
            'mascotas' => $mascotasAdopcion
        ]);
    }

    /**
     * Extrae las mascotas de las adopciones
     */
    private function extraerMascotasDeAdopciones($adopciones)
    {
        $mascotas = [];
        
        foreach ($adopciones as $adopcion) {
            // Verificar si la adopción tiene la mascota incluida
            if (isset($adopcion['pet']) && $adopcion['pet']) {
                // Agregar información del status de la adopción a la mascota
                $mascota = $adopcion['pet'];
                $mascota['adoption_status'] = $adopcion['status'] ?? 'pending';
                $mascota['adoption_id'] = $adopcion['id'] ?? null;
                $mascota['adoption_comment'] = $adopcion['comment'] ?? null;
                
                $mascotas[] = $mascota;
            }
            // Si la API no incluye la mascota anidada, pero sí tiene pet_id
            elseif (isset($adopcion['pet_id'])) {
                // En este caso necesitaríamos hacer otra llamada a la API para obtener los datos de la mascota
                // Por ahora solo agregamos el ID
                $mascotas[] = [
                    'id' => $adopcion['pet_id'],
                    'adoption_status' => $adopcion['status'] ?? 'pending',
                    'adoption_id' => $adopcion['id'] ?? null,
                    'adoption_comment' => $adopcion['comment'] ?? null
                ];
            }
        }
        
        return $mascotas;
    }

    public function store(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        try {
            // Validar los datos del formulario
            $validated = $request->validate([
                'pet_id' => 'required|integer',
                'comment' => 'required|string|max:1000',
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'experience' => 'required|string'
            ]);

            // AGREGAR EL CAMPO STATUS CON VALOR 'pending'
            $adoptionData = array_merge($validated, [
                'status' => 'pending' // Siempre en espera por defecto
            ]);

            Log::info('Datos a enviar a la API de adopciones:', $adoptionData);

            // Enviar solicitud de adopción a la API
            $response = $this->apiService->post('/adoptions', $adoptionData);
            
            Log::info('Respuesta completa de la API:', $response);

            if (isset($response['success']) && $response['success']) {
                return redirect()->route('adopciones.index')
                    ->with('success', '¡Solicitud de adopción enviada con éxito! Está en revisión.');
            }

            // Debug detallado del error
            $errorMessage = 'Error desconocido al enviar la solicitud';
            $statusCode = null;

            if (isset($response['error'])) {
                $errorMessage = $response['error'];
            }
            
            if (isset($response['status'])) {
                $statusCode = $response['status'];
                $errorMessage .= " (Código: $statusCode)";
            }

            // Si hay errores de validación de la API
            if (isset($response['errors'])) {
                $errorMessage .= " - Errores: " . json_encode($response['errors']);
            }

            Log::error('Error al enviar adopción:', [
                'error' => $errorMessage,
                'response' => $response,
                'data_sent' => $adoptionData
            ]);

            return redirect()->route('adopciones.index')
                ->with('error', "Error al enviar la solicitud: $errorMessage");

        } catch (\Exception $e) {
            Log::error('Excepción al enviar adopción:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('adopciones.index')
                ->with('error', "Error interno: " . $e->getMessage());
        }
    }
}