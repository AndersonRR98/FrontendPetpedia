<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
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

        try {
            // Obtener datos para el dashboard desde tu API con timeout más corto
            $veterinarias = $this->apiService->get('/veterinaries?limit=3');
            $entrenadores = $this->apiService->get('/trainers?limit=3');
            $refugios = $this->apiService->get('/shelters?limit=3');
            
            $user = session('user');
            
            // Log para debugging
            Log::info('Dashboard loaded', [
                'veterinarias_count' => is_array($veterinarias) ? count($veterinarias) : 'error',
                'entrenadores_count' => is_array($entrenadores) ? count($entrenadores) : 'error',
                'refugios_count' => is_array($refugios) ? count($refugios) : 'error'
            ]);
            
            return view('dashboard.index', compact('veterinarias', 'entrenadores', 'refugios', 'user'));
            
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            
            // Fallback: mostrar dashboard con datos vacíos
            return view('dashboard.index', [
                'veterinarias' => [],
                'entrenadores' => [], 
                'refugios' => [],
                'user' => session('user')
            ])->with('error', 'Error al cargar algunos datos. Intenta nuevamente.');
        }
    }
}