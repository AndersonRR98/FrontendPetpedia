<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ForumController extends Controller
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

        $response = $this->apiService->get('/forums');

        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('dashboard')
                ->with('error', $response['message'] ?? 'Error al cargar los posts del foro');
        }

        $foros = $response['data'] ?? [];

        return view('foros.index', compact('foros'));
    }

    public function store(Request $request)
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        // Validación básica
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        \Log::info('=== FRONTEND: Creando nuevo post ===');
        \Log::info('Datos del formulario:', [
            'title' => $request->title,
            'has_image' => $request->hasFile('image'),
            'description' => $request->description,
            'content_length' => strlen($request->content)
        ]);

        // Preparar payload - NO enviar imagen por ahora
        $payload = [
            'title' => $request->title,
            'description' => $request->description ?? '',
            'content' => $request->content,
            // No enviamos image para mantener compatibilidad con Android
        ];

        \Log::info('Enviando payload a la API:', $payload);

        try {
            $response = $this->apiService->post('/forums', $payload);
            \Log::info('Respuesta de la API:', $response);
        } catch (\Exception $e) {
            \Log::error('Error llamando a la API: ' . $e->getMessage());
            return back()->with('error', 'Error de conexión con el servidor: ' . $e->getMessage());
        }

        if (!isset($response['success']) || !$response['success']) {
            $errorMessage = $response['message'] ?? 'Error desconocido al crear el post';
            \Log::error('Error en la respuesta de la API: ' . $errorMessage);
            return back()->with('error', $errorMessage);
        }

        \Log::info('Post creado exitosamente');
        return redirect()->route('foros.index')->with('success', 'Post creado exitosamente');
    }

    public function like($id)
    {
        $response = $this->apiService->post("/forums/{$id}/like");

        if (!isset($response['success']) || !$response['success']) {
            return back()->with('error', $response['message'] ?? 'Error al dar like');
        }

        return back()->with('success', 'Like agregado correctamente');
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $payload = [
            'content' => $request->content
        ];

        $response = $this->apiService->post("/forums/{$id}/comments", $payload);

        if (!isset($response['success']) || !$response['success']) {
            return back()->with('error', $response['message'] ?? 'Error al agregar el comentario');
        }

        return back()->with('success', 'Comentario agregado exitosamente');
    }

    public function destroy($id)
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        $response = $this->apiService->delete("/forums/{$id}");

        if (!isset($response['success']) || !$response['success']) {
            return back()->with('error', $response['message'] ?? 'Error al eliminar el post');
        }

        return redirect()->route('foros.index')->with('success', 'Post eliminado exitosamente');
    }
}