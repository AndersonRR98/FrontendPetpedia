<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_URL', 'http://localhost:8000/api');
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
        $publicEndpoints = [
            '/auth/login',
            '/auth/register', 
            '/auth/roles'
        ];
        
        $isPublicEndpoint = in_array($endpoint, $publicEndpoints);
        $token = session('token');
        
        // Solo verificar token si NO es un endpoint público
        if (!$token && !$isPublicEndpoint) {
            Log::warning('No token found for API request', ['endpoint' => $endpoint]);
            return ['success' => false, 'error' => 'No hay token de autenticación'];
        }

        $url = $this->baseUrl . $endpoint;
        
        Log::info('🚀 Making API request', [
            'method' => $method,
            'url' => $url,
            'data' => $data,
            'token_exists' => !empty($token),
            'is_public_endpoint' => $isPublicEndpoint
        ]);

        try {
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];
            
            // Solo agregar Authorization header si hay token Y no es endpoint público
            if ($token && !$isPublicEndpoint) {
                $headers['Authorization'] = 'Bearer ' . $token;
            }

            $response = Http::withHeaders($headers)
                ->timeout(10)
                ->retry(2, 100)
                ->{$method}($url, $data);

            Log::info('📡 API Response COMPLETA', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'headers' => $response->headers(),
                'body' => $response->body(), 
                'endpoint' => $endpoint,
                'is_public' => $isPublicEndpoint
            ]);

            if ($response->successful()) {
                $jsonResponse = $response->json();
                Log::info('✅ API Request Successful', ['response_data' => $jsonResponse]);
                return $jsonResponse;
            }

            // Si es error 401, limpiar sesión (solo para endpoints protegidos)
            if ($response->status() === 401 && !$isPublicEndpoint) {
                session()->forget(['token', 'user']);
                Log::warning('🔐 Session expired - 401 Unauthorized');
                return ['success' => false, 'error' => 'Sesión expirada'];
            }

            $errorBody = $response->body();
            Log::error('❌ API Error Response DETAILS', [
                'status' => $response->status(),
                'endpoint' => $endpoint,
                'response_body' => $errorBody,
                'response_json' => $response->json() 
            ]);

            $errorData = $response->json();
            $errorMessage = isset($errorData['message']) ? $errorData['message'] : 
                           (isset($errorData['error']) ? $errorData['error'] : 
                           'Error en la API: ' . $response->status());

            return [
                'success' => false, 
                'error' => $errorMessage,
                'status' => $response->status(),
                'body' => $errorBody
            ];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('⏰ API Connection Timeout', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage()
            ]);
            return ['success' => false, 'error' => 'Timeout de conexión con la API'];
            
        } catch (\Exception $e) {
            Log::error('💥 API Request Exception', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
                'url' => $url
            ]);
            return ['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()];
        }
    }

    public function put($endpoint, $data = [])
    {
        return $this->makeRequest('put', $endpoint, $data);
    }

    public function delete($endpoint)
    {
        $token = session('token');
        
        if (!$token) {
            Log::warning('No token found for API DELETE request', ['endpoint' => $endpoint]);
            return ['success' => false, 'error' => 'No hay token de autenticación'];
        }

        $url = $this->baseUrl . $endpoint;
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])
            ->timeout(10)
            ->delete($url);

            Log::info('API DELETE Response', [
                'status' => $response->status(),
                'success' => $response->successful(),
                'endpoint' => $endpoint
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            if ($response->status() === 401) {
                session()->forget(['token', 'user']);
                return ['success' => false, 'error' => 'Sesión expirada'];
            }

            return [
                'success' => false, 
                'error' => 'Error en la API: ' . $response->status(),
                'status' => $response->status()
            ];

        } catch (\Exception $e) {
            Log::error('API DELETE Exception', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage()
            ]);
            return ['success' => false, 'error' => 'Error de conexión: ' . $e->getMessage()];
        }
    }
}