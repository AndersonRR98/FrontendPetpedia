<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontAuthController extends Controller
{
    private $api;

    public function __construct()
    {
        // URL base del backend (API)
        $this->api = env('API_URL', 'http://localhost:8000/api');
    }

    // -------------------- LOGIN --------------------
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post("{$this->api}/auth/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Guardar token y usuario en sesión
            session([
                'token' => $data['token'],
                'user' => $data['user'],
                'user_id' => $data['user']['id'], 

            ]);

            // Redirigir al dashboard principal que mostrará los servicios
            return redirect()->route('dashboard');
        }

        // Si llega aquí, las credenciales no fueron válidas
        return back()->withErrors(['login' => 'Credenciales inválidas']);
    }

    // -------------------- REGISTER --------------------
    public function showRegister()
    {
        // Obtener roles desde la API
        $roles = Http::get("{$this->api}/auth/roles")->json();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        $response = Http::post("{$this->api}/auth/register", $request->all());

        if ($response->successful()) {
            $data = $response->json();
            session([
                'token' => $data['token'],
                'user' => $data['user'],
                'user_id' => $data['user']['id'], 
            ]);

            return redirect('/login')->with('success', 'Registro exitoso, inicia sesión');
        }

        return back()->withErrors([
            'register' => $response->json()['message'] ?? 'Error en el registro.',
            'errors' => $response->json()['errors'] ?? []
        ])->withInput();
    }

    // -------------------- LOGOUT --------------------
    public function logout()
    {
        if (session('token')) {
            Http::withToken(session('token'))->post("{$this->api}/auth/logout");
        }

        session()->flush();
        return redirect('/login');
    }
}