<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_URL', 'http://localhost:8001/api');
    }

    public function get($endpoint)
    {
        return $this->makeRequest('get', $endpoint);
    }

    public function post($endpoint, $data = [])
    {
        return $this->makeRequest('post', $endpoint, $data);
    }

    protected function makeRequest($method, $endpoint, $data = [])
    {
        $token = session('token');
        
        if (!$token) {
            Log::warning('No token found for API request', ['endpoint' => $endpoint]);
            return ['success' => false, 'error' => 'No hay token de autenticación'];
        }

        $url = $this->baseUrl . $endpoint;
        
        Log::info('Making API request', [
            'method' => $method,
            'url' => $url,
            'token_exists' => !empty($token)
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])
            ->timeout(10) // Timeout más corto
            ->retry(2, 100) // Reintentar 2 veces
            ->{$method}($url, $data);

            Log::info('API Response', [
                'status' => $response->status(),
                'success' => $response->successful(),
                'endpoint' => $endpoint
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            // Si es error 401, limpiar sesión
            if ($response->status() === 401) {
                session()->forget(['token', 'user']);
                return ['success' => false, 'error' => 'Sesión expirada'];
            }

            $errorBody = $response->body();
            Log::error('API Error Response', [
                'status' => $response->status(),
                'endpoint' => $endpoint,
                'response' => $errorBody
            ]);

            return [
                'success' => false, 
                'error' => 'Error en la API: ' . $response->status(),
                'status' => $response->status()
            ];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('API Connection Timeout', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage()
            ]);
            return ['success' => false, 'error' => 'Timeout de conexión con la API'];
            
        } catch (\Exception $e) {
            Log::error('API Request Exception', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
                'url' => $url
            ]);
            return ['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()];
        }
    }
}