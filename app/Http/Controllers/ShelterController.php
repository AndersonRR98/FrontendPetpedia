<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ShelterController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/shelters');
        $refugios = isset($response['success']) && !$response['success'] ? [] : $response;
        return view('refugios.index', compact('refugios'));
    }

    public function show($id)
    {
        $response = $this->apiService->get("/shelters/{$id}");
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('refugios.index')
                ->with('error', $response['error'] ?? 'Refugio no encontrado');
        }

        $refugio = $response;
        return view('refugios.show', compact('refugio'));
    }
}