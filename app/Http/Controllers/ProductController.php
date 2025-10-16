<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
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

        Log::info('Accediendo a productos.index');

        // Consumir el endpoint de productos de tu API
        $response = $this->apiService->get('/products');
        
        Log::info('Respuesta de la API productos:', ['response' => $response]);

        // Si hay error, mostramos productos vacíos pero no redirigimos
        if (isset($response['success']) && !$response['success']) {
            Log::error('Error en API productos:', ['error' => $response['error']]);
            $productos = [];
        } else {
            // Tu API retorna un array de productos
            $productos = is_array($response) ? $response : [];
        }
        
        Log::info('Productos a mostrar:', ['count' => count($productos)]);

        return view('productos.index', compact('productos'));
    }

    public function show($id)
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        $response = $this->apiService->get('/products/' . $id);
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('products.index')
                ->with('error', $response['error'] ?? 'Error al cargar el producto');
        }

        $producto = $response ?? [];
        
        return view('productos.show', compact('producto'));
    }

    public function addToCart(Request $request)
    {
        if (!session('token')) {
            return redirect()->route('login')->with('error', 'Por favor inicia sesión');
        }

        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        // Aquí puedes implementar la lógica local del carrito
        // Por ahora solo mostramos un mensaje de éxito
        Log::info('Producto agregado al carrito local:', $validated);

        return redirect()->route('products.index')
            ->with('success', 'Producto agregado al carrito correctamente');
    }
}