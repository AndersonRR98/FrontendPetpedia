<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
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
=======
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
>>>>>>> 74ed579730790986e3135f76ee078ae9e6e48f31
        }
    }
}