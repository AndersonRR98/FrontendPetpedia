<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FrontAuthController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // -------------------- LOGIN --------------------
    public function showLogin()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    try {
        // Validar en frontend antes de enviar
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        Log::info('Login - Iniciando proceso', ['email' => $request->email]);

        $response = $this->apiService->post('/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Log::info('Login - Respuesta API', [
            'success' => $response['success'] ?? false,
            'has_token' => isset($response['token']),
            'has_user' => isset($response['user']),
            'role_id' => $response['user']['role_id'] ?? null
        ]);

        if (isset($response['success']) && $response['success']) {
            // Guardar token y usuario en sesión
            session([
                'token' => $response['token'],
                'user' => $response['user'],
                'user_id' => $response['user']['id'],
            ]);

            Log::info('Login - Éxito', [
                'user_id' => $response['user']['id'],
                'role' => $response['user']['role_id'] ?? 'N/A'
            ]);

            // ⭐⭐ REDIRIGIR SEGÚN EL ROL ⭐⭐
            $roleId = $response['user']['role_id'];
            
            switch ($roleId) {
                case 2: // Veterinaria
                    return redirect()->route('veterinary.deshboard')->with('success', '¡Bienvenida Veterinaria!');
                case 3: // Entrenador
                    return redirect()->route('trainer.deshboard')->with('success', '¡Bienvenido Entrenador!');
                case 4: // Refugio
                    return redirect()->route('shelter.deshboard')->with('success', '¡Bienvenido Refugio!');
                default: // Cliente (rol 1) y otros
                    return redirect()->route('dashboard')->with('success', '¡Bienvenido de nuevo!');
            }
        }

        // Manejar errores de la API
        $errorMessage = $response['error'] ?? $response['message'] ?? 'Credenciales inválidas';
        
        Log::warning('Login - Error', ['error' => $errorMessage]);

        return back()->withErrors(['login' => $errorMessage])->withInput();

    } catch (\Exception $e) {
        Log::error('Login - Excepción', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()->withErrors(['login' => 'Error de conexión: ' . $e->getMessage()])->withInput();
    }
}

    // -------------------- REGISTER --------------------
    public function showRegister()
    {
        try {
            // Obtener roles desde la API usando ApiService
            $response = $this->apiService->get('/auth/roles');
            
            Log::info('Register - Obteniendo roles', [
                'success' => $response['success'] ?? false,
                'roles_count' => is_array($response) ? count($response) : 0
            ]);

            $roles = [];
            
            if (isset($response['success']) && $response['success']) {
                $roles = $response;
            } elseif (is_array($response) && !isset($response['success'])) {
                // Si la respuesta es directamente el array de roles
                $roles = $response;
            } else {
                Log::error('Register - Error obteniendo roles', ['response' => $response]);
                // Usar roles por defecto si falla la API
                $roles = [
                    ['id' => 1, 'name' => 'Cliente'],
                    ['id' => 2, 'name' => 'Veterinaria'],
                    ['id' => 3, 'name' => 'Entrenador'],
                    ['id' => 4, 'name' => 'Refugio'],
                ];
            }

            return view('auth.register', compact('roles'));

        } catch (\Exception $e) {
            Log::error('Register - Error cargando vista', [
                'message' => $e->getMessage()
            ]);

            // Roles por defecto en caso de error
            $roles = [
                ['id' => 1, 'name' => 'Cliente'],
                ['id' => 2, 'name' => 'Veterinaria'],
                ['id' => 3, 'name' => 'Entrenador'],
                ['id' => 4, 'name' => 'Refugio'],
            ];

            return view('auth.register', compact('roles'));
        }
    }

    public function register(Request $request)
{
    try {
        // Validación básica en frontend
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|in:1,2,3,4',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'biography' => 'nullable|string',
        ]);

        Log::info('Register - Iniciando registro', [
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        // Preparar datos para la API
        $registerData = $request->only([
            'name', 'email', 'password', 'password_confirmation', 
            'role_id', 'phone', 'address', 'biography'
        ]);

        // Agregar campos específicos según el rol
        switch ($request->role_id) {
            case 2: // Veterinaria
                $request->validate([
                    'clinic_name' => 'required|string|max:255',
                    'veterinary_license' => 'required|string|max:100',
                    'specialization' => 'required|string|max:255',
                ]);
                $registerData = array_merge($registerData, $request->only([
                    'clinic_name', 'veterinary_license', 'specialization'
                ]));
                break;

            case 3: // Entrenador
                $request->validate([
                    'specialty' => 'required|string|max:255',
                    'experience_years' => 'required|integer|min:0',
                    'qualifications' => 'required|string',
                    'hourly_rate' => 'required|numeric|min:0',
                ]);
                $registerData = array_merge($registerData, $request->only([
                    'specialty', 'experience_years', 'qualifications', 'hourly_rate'
                ]));
                break;

            case 4: // Refugio
                $request->validate([
                    'shelter_name' => 'required|string|max:255',
                    'responsible_person' => 'required|string|max:255',
                    'capacity' => 'required|integer|min:1',
                ]);
                $registerData = array_merge($registerData, $request->only([
                    'shelter_name', 'responsible_person', 'capacity'
                ]));
                break;
        }

        $response = $this->apiService->post('/auth/register', $registerData);

        Log::info('Register - Respuesta API', [
            'success' => $response['success'] ?? false,
            'has_token' => isset($response['token']),
            'has_user' => isset($response['user'])
        ]);

        if (isset($response['success']) && $response['success']) {
            
            Log::info('Register - Éxito, redirigiendo al login', [
                'user_id' => $response['user']['id'],
                'role' => $response['user']['role_id']
            ]);

            return redirect('/login')->with('success', '¡Registro exitoso! Por favor inicia sesión con tus credenciales.');
        }

        // Manejar errores de la API
        $errorData = $response;
        $errorMessage = $errorData['error'] ?? $errorData['message'] ?? 'Error en el registro';
        $errors = $errorData['errors'] ?? [];

        Log::error('Register - Error del backend', [
            'message' => $errorMessage,
            'errors' => $errors
        ]);

        return back()->withErrors([
            'register' => $errorMessage,
            'errors' => $errors
        ])->withInput();

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Capturar errores de validación de Laravel
        Log::warning('Register - Validación fallida', [
            'errors' => $e->errors()
        ]);
        
        return back()->withErrors($e->errors())->withInput();

    } catch (\Exception $e) {
        Log::error('Register - Excepción', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()->withErrors([
            'register' => 'Error de conexión: ' . $e->getMessage()
        ])->withInput();
    }
}

    // -------------------- LOGOUT --------------------
    public function logout()
    {
        try {
            $token = session('token');
            
            if ($token) {
                Log::info('Logout - Cerrando sesión en API');
                
                $response = $this->apiService->post('/auth/logout', []);
                
                Log::info('Logout - Respuesta API', [
                    'success' => $response['success'] ?? false
                ]);
            }

            // Limpiar sesión localmente
            session()->flush();

            Log::info('Logout - Sesión limpiada localmente');

            return redirect('/login')->with('success', 'Sesión cerrada correctamente.');

        } catch (\Exception $e) {
            Log::error('Logout - Excepción', [
                'message' => $e->getMessage()
            ]);

            // Limpiar sesión incluso si hay error
            session()->flush();
            
            return redirect('/login')->with('info', 'Sesión cerrada.');
        }
    }

    // -------------------- VERIFICAR SESIÓN --------------------
    public function checkSession()
    {
        $user = session('user');
        $token = session('token');

        return response()->json([
            'authenticated' => !empty($user) && !empty($token),
            'user' => $user,
            'has_token' => !empty($token)
        ]);
    }
}