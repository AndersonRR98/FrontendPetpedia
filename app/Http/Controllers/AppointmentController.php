<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
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

        // Obtener citas del usuario actual
        $response = $this->apiService->get('/appointments');
        
        Log::info('Respuesta de citas index:', ['response' => $response]);
        
        if (isset($response['success']) && !$response['success']) {
            $appointments = [];
        } else {
            $appointments = $response;
        }

        return view('citas.index', compact('appointments'));
    }

 public function store(Request $request)
{
    Log::info('=== 🎯 INICIANDO CREACIÓN DE CITA ===');
    Log::info('📝 Datos del formulario:', $request->all());

    if (!session('token')) {
        return redirect()->route('login')
            ->with('error', 'Por favor inicia sesión para agendar una cita');
    }

    // Validar los datos dinámicamente
    try {
        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'description' => 'required|string|min:10|max:500',
            'veterinary_id' => 'nullable|integer',
            'trainer_id' => 'nullable|integer',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('❌ Error de validación:', $e->errors());
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput();
    }

    // Detectar si la cita es para veterinaria o entrenador
    $appointmentData = [
        'date' => $request->date,
        'description' => $request->description,
        'status' => 'pending',
        'veterinary_id' => $request->veterinary_id ?? null,
        'trainer_id' => $request->trainer_id ?? null,
    ];

    Log::info('📤 Enviando a API:', $appointmentData);

    try {
        $response = $this->apiService->post('/appointments', $appointmentData);
        Log::info('📥 Respuesta API:', [$response]);

        if (isset($response['id'])) {
            return redirect()->back()->with('success', 'Cita con la veterinaria Solicitada su estado actual es pendiente de confirmar ');
        }

        $errorMessage = $response['error'] ?? 'Error desconocido al agendar la cita';
        Log::error('❌ Error de API:', ['error' => $errorMessage]);

        return redirect()->back()
            ->with('error', $errorMessage)
            ->withInput();
    } catch (\Exception $e) {
        Log::error('❌ Excepción en store:', ['error' => $e->getMessage()]);
        return redirect()->back()
            ->with('error', 'Error de conexión: ' . $e->getMessage())
            ->withInput();
    }
}

public function storeTrainer(Request $request)
{
    Log::info('=== 🎯 INICIANDO CREACIÓN DE CITA CON TRAINER ===');
    Log::info('📝 Datos del formulario:', $request->all());

    if (!session('token')) {
        return redirect()->route('login')
            ->with('error', 'Por favor inicia sesión para agendar una cita con el entrenador');
    }

    try {
        $validated = $request->validate([
            'trainer_id' => 'required|integer',
            'date' => 'required|date|after:today',
            'description' => 'required|string|min:10|max:500',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('❌ Error de validación (Trainer):', $e->errors());
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput();
    }

    // ✅ Datos específicos para entrenadores
    $appointmentData = [
        'trainer_id' => (int) $request->trainer_id,
        'date' => $request->date,
        'description' => $request->description,
        'status' => 'pending',
        'veterinary_id' => null,
    ];

    Log::info('📤 Enviando a API (Trainer):', $appointmentData);

    try {
        $response = $this->apiService->post('/appointments', $appointmentData);

        Log::info('📥 Respuesta API (Trainer):', [$response]);

        if (isset($response['id']) && isset($response['trainer_id'])) {
            return redirect()->back()
                ->with('success', 'Cita con el entrenador Solicitada su estado actual es pendiente de confirmar.');
        }

        $errorMessage = $response['error'] ?? $response['message'] ?? 'Error al agendar la cita con el entrenador';
        Log::error('❌ Error de API (Trainer):', ['error' => $errorMessage]);

        return redirect()->back()
            ->with('error', $errorMessage)
            ->withInput();

    } catch (\Exception $e) {
        Log::error('❌ Excepción al agendar cita con trainer:', ['error' => $e->getMessage()]);
        return redirect()->back()
            ->with('error', 'Error de conexión: ' . $e->getMessage())
            ->withInput();
    }
}


   
}