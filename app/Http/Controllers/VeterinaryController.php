<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class VeterinaryController extends Controller
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

    $response = $this->apiService->get('/veterinaries');

    if (isset($response['success']) && !$response['success']) {
        return redirect()->route('dashboard')
            ->with('error', $response['error'] ?? 'Error al cargar las veterinarias');
    }

    // Maneja distintas estructuras posibles
    if (isset($response['data'])) {
        $veterinarias = $response['data'];
    } elseif (isset($response['data']['data'])) {
        $veterinarias = $response['data']['data'];
    } else {
        $veterinarias = $response;
    }

    return view('veterinarias.index', compact('veterinarias'));
}
    public function show($id)
    {
        // Verificar si el usuario está autenticado
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        // Consumir el endpoint específico de veterinaria
        $response = $this->apiService->get("/veterinaries/{$id}");
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('veterinarias.index')
                ->with('error', $response['error'] ?? 'Veterinaria no encontrada');
        }

        $veterinaria = $response;
        
        return view('veterinarias.show', compact('veterinaria'));
    }
}