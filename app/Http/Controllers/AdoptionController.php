<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class AdoptionController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // Mostrar mascotas disponibles
    public function index()
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        $response = $this->apiService->get('/adoptions');
        $adopciones = $response ?? [];

        // Solo adopciones pendientes
        $adopcionesPendientes = array_filter($adopciones, fn($a) => ($a['status'] ?? '') === 'pending');
        $mascotasAdopcion = $this->extraerMascotasDeAdopciones($adopcionesPendientes);

        return view('adopciones.index', ['mascotas' => $mascotasAdopcion]);
    }

    private function extraerMascotasDeAdopciones($adopciones)
    {
        $mascotas = [];
        $mascotasIds = [];

        foreach ($adopciones as $adopcion) {
            if (isset($adopcion['pet'])) {
                $mascota = $adopcion['pet'];
                $id = $mascota['id'] ?? null;
                if ($id && !in_array($id, $mascotasIds)) {
                    $mascota['adoption_status'] = $adopcion['status'] ?? 'pending';
                    $mascota['adoption_id'] = $adopcion['id'] ?? null;
                    $mascotas[] = $mascota;
                    $mascotasIds[] = $id;
                }
            } elseif (isset($adopcion['pet_id'])) {
                $id = $adopcion['pet_id'];
                if (!in_array($id, $mascotasIds)) {
                    $mascotas[] = [
                        'id' => $id,
                        'adoption_status' => $adopcion['status'] ?? 'pending',
                        'adoption_id' => $adopcion['id'] ?? null,
                    ];
                    $mascotasIds[] = $id;
                }
            }
        }

        return $mascotas;
    }

    // Guardar solicitud sin validación
    public function store(Request $request)
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        // Solo tomamos los datos necesarios para la API
        $requestData = [
            'adoption_id' => $request->input('adoption_id'),
            'user_id' => session('user')['id'] ?? null,
            'priority' => 'medium',
            'application_status' => 'accepted',
            'trainer_id' => null,
        ];

        $response = $this->apiService->post('/requestts', $requestData);
        
          return redirect()->route('adopciones.index')
            ->with('success', '¡Solicitud enviada correctamente! Está en revisión.');

        return redirect()->route('adopciones.index')
            ->with('error', $response['error'] ?? 'Error al enviar la solicitud');
    }
}
