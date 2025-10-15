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
        // Verificar si el usuario está autenticado
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        // Consumir el endpoint de veterinarias de tu API
        $response = $this->apiService->get('/veterinaries');
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('dashboard')
                ->with('error', $response['error'] ?? 'Error al cargar las veterinarias');
        }

        // Tu API retorna un array de veterinarias
        $veterinarias = $response ?? [];
        
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