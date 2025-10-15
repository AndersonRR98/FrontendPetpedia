<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class AppointmentController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Mostrar lista de citas del usuario
     */
    public function index()
    {
        $response = $this->apiService->get('/appointments');

        if ($response['success'] ?? false) {
            $citas = $response;
            return view('citas.index', compact('citas'));
        }

        $error = $response['error'] ?? 'Error al cargar las citas';
        return view('citas.index', ['citas' => []])->withErrors(['error' => $error]);
    }

    /**
     * Mostrar formulario para crear cita
     */
    public function create()
    {
        // Obtener veterinarias para el select
        $veterinariasResponse = $this->apiService->get('/veterinaries');
        $veterinarias = $veterinariasResponse['success'] ?? false ? $veterinariasResponse : [];

        return view('citas.create', compact('veterinarias'));
    }

    /**
     * Guardar nueva cita
     */
  /**
 * Guardar nueva cita
 */
public function store(Request $request)
{
    // Verificar token primero
    if (!session('token')) {
        return redirect()->route('login')
            ->withErrors(['error' => 'Por favor inicia sesión para solicitar una cita']);
    }

    $request->validate([
        'date' => 'required|date|after:today',
        'description' => 'required|string|min:10|max:500',
        'veterinary_id' => 'required|integer|min:1',
    ]);

    $response = $this->apiService->post('/appointments', [
        'date' => $request->date,
        'description' => $request->description,
        'veterinary_id' => $request->veterinary_id,
        'status' => 'pending'
    ]);

    if ($response['success'] ?? false) {
        return redirect()->route('citas.index')
            ->with('success', 'Cita solicitada exitosamente. Te contactaremos para confirmarla.');
    }

    // Manejar específicamente el error 401
    if (isset($response['error']) && str_contains($response['error'], 'Sesión expirada')) {
        session()->forget(['token', 'user']);
        return redirect()->route('login')
            ->withErrors(['error' => 'Tu sesión ha expirado. Por favor inicia sesión nuevamente.']);
    }

    $error = $response['error'] ?? 'Error al crear la cita';
    return back()->withErrors(['error' => $error])->withInput();
}
    /**
     * Mostrar detalles de una cita
     */
    public function show($id)
    {
        $response = $this->apiService->get("/appointments/{$id}");

        if ($response['success'] ?? false) {
            $cita = $response;
            return view('citas.show', compact('cita'));
        }

        $error = $response['error'] ?? 'Cita no encontrada';
        return redirect()->route('citas.index')->withErrors(['error' => $error]);
    }

    /**
     * Cancelar una cita
     */
// En AppointmentController, actualiza el método destroy:
public function destroy($id)
{
    $response = $this->apiService->delete("/appointments/{$id}");

    if ($response['success'] ?? false) {
        return redirect()->route('citas.index')
            ->with('success', 'Cita cancelada exitosamente');
    }

    $error = $response['error'] ?? 'Error al cancelar la cita';
    return back()->withErrors(['error' => $error]);
}
}