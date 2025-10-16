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
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        $response = $this->apiService->get('/adoptions');
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('dashboard')
                ->with('error', $response['error'] ?? 'Error al cargar las adopciones');
        }

        $adopciones = $response ?? [];
        
        // Extraer las mascotas de las adopciones (evitando duplicados)
        $mascotasAdopcion = $this->extraerMascotasDeAdopciones($adopciones);
        
        return view('adopciones.index', [
            'mascotas' => $mascotasAdopcion
        ]);
    }

    /**
     * Extrae las mascotas de las adopciones EVITANDO DUPLICADOS
     */
    private function extraerMascotasDeAdopciones($adopciones)
    {
        $mascotas = [];
        $mascotasIds = []; // Para evitar duplicados
        
        foreach ($adopciones as $adopcion) {
            // Verificar si la adopción tiene la mascota incluida
            if (isset($adopcion['pet']) && $adopcion['pet']) {
                $mascota = $adopcion['pet'];
                $mascotaId = $mascota['id'] ?? null;
                
                // Evitar duplicados por ID de mascota
                if ($mascotaId && !in_array($mascotaId, $mascotasIds)) {
                    $mascota['adoption_status'] = $adopcion['status'] ?? 'pending';
                    $mascota['adoption_id'] = $adopcion['id'] ?? null;
                    $mascota['adoption_comment'] = $adopcion['comment'] ?? null;
                    
                    $mascotas[] = $mascota;
                    $mascotasIds[] = $mascotaId;
                }
            }
            // Si la API no incluye la mascota anidada, pero sí tiene pet_id
            elseif (isset($adopcion['pet_id'])) {
                $petId = $adopcion['pet_id'];
                
                // Evitar duplicados por ID de mascota
                if (!in_array($petId, $mascotasIds)) {
                    $mascotas[] = [
                        'id' => $petId,
                        'adoption_status' => $adopcion['status'] ?? 'pending',
                        'adoption_id' => $adopcion['id'] ?? null,
                        'adoption_comment' => $adopcion['comment'] ?? null
                    ];
                    $mascotasIds[] = $petId;
                }
            }
        }
        
        return $mascotas;
    }

    public function store(Request $request)
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        try {
            $validated = $request->validate([
                'pet_id' => 'required|integer',
                'comment' => 'required|string|max:1000',
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'experience' => 'required|string'
            ]);

            $adoptionData = array_merge($validated, [
                'status' => 'pending'
            ]);

            $response = $this->apiService->post('/adoptions', $adoptionData);
            
            if (isset($response['success']) && $response['success']) {
                return redirect()->route('adopciones.index')
                    ->with('success', '¡Solicitud de adopción enviada con éxito! Está en revisión.');
            }

            $errorMessage = $response['error'] ?? 'Error al enviar la solicitud';
            return redirect()->route('adopciones.index')
                ->with('error', "Error al enviar la solicitud: $errorMessage");

        } catch (\Exception $e) {
            return redirect()->route('adopciones.index')
                ->with('error', "Error interno: " . $e->getMessage());
        }
    }
}