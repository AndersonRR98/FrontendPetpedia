<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class TrainerController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/trainers');
        $entrenadores = isset($response['success']) && !$response['success'] ? [] : $response;
        return view('entrenadores.index', compact('entrenadores'));
    }

    public function show($id)
    {
        $response = $this->apiService->get("/trainers/{$id}");
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('entrenadores.index')
                ->with('error', $response['error'] ?? 'Entrenador no encontrado');
        }
$entrenador = $response;
return view('entrenadores.show', compact('entrenador'));
    }
}