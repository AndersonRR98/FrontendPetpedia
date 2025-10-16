<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Obtiene la URL base de la API desde el archivo .env
    private $apiUrl;

    public function __construct()
    {
        // Obtiene la URL de la variable de entorno, sin añadir el slash final aquí.
        $this->apiUrl = env('API_URL', 'http://localhost:8001/api'); 
    }

    /**
     * Helper para obtener datos de la API.
     * Incluye el token de la sesión para peticiones autenticadas.
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    private function fetchDataFromApi($endpoint, $params = [])
    {
        try {
            // 1. Obtener el token de la sesión. Si no existe, será nulo.
            $token = session('token');

            // 2. Construir el cliente HTTP. Si hay token, lo incluye.
            $client = $token ? Http::withToken($token) : Http::timeout(10); 
            
            // 3. Construye la URL de la API, usando el slash para separar la base del endpoint:
            $url = "{$this->apiUrl}/{$endpoint}"; 
            
            // Realiza la petición GET, pasando los parámetros de filtro (search, category)
            $response = $client->get($url, $params);

            // Verifica si la respuesta es exitosa (código 200)
            if ($response->successful()) {
                // Devuelve los datos en formato array
                return $response->json();
            }
            
            // Manejar error de autenticación 401 si la API de productos lo requiere
            if ($response->status() === 401) {
                Log::warning("API Auth Warning: Token inválido o no proporcionado para acceder a $endpoint.");
            }

            // Si falla, loguea el error y devuelve un array vacío
            Log::error("API Error: Fallo al obtener datos de $endpoint. Código: " . $response->status() . " | Respuesta: " . $response->body());
            return [];

        } catch (\Exception $e) {
            // Loguea cualquier excepción (ej: no hay conexión con la API)
            Log::error("API Connection Error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Muestra la lista de productos, aplicando filtros de búsqueda y categoría.
     * Los filtros se pasan a la API como parámetros de consulta.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->query('search');
        $selectedCategory = $request->query('category');
        
        // Parámetros de consulta que se enviarán a la API
        $params = [];
        if ($searchQuery) {
            $params['search'] = $searchQuery;
        }
        // Solo enviar el parámetro de categoría si no es 'Todos'
        if ($selectedCategory && $selectedCategory !== 'Todos') {
            $params['category'] = $selectedCategory;
        }

        // Obtener productos filtrados de la API
        $products = $this->fetchDataFromApi('products', $params);

        // Obtener categorías de la API. Si falla, usamos un valor por defecto.
        $categoriesFromApi = $this->fetchDataFromApi('categories');
        
        // Si la API devuelve un array, úsalo. Si no, usa el array por defecto.
        // Asegúrate de que las categorías siempre contengan 'Todos' al principio.
        $categories = is_array($categoriesFromApi) && !empty($categoriesFromApi) 
                        ? $categoriesFromApi 
                        : ['Perros', 'Gatos', 'Peces', 'Aves']; 

        if (!in_array('Todos', $categories)) {
            array_unshift($categories, 'Todos');
        }
        
        // Formatear productos para asegurar que 'price' y 'description' existen
        $products = array_map(function($p) {
            $p['price'] = (float) ($p['price'] ?? 0.00);
            $p['description'] = $p['description'] ?? 'Descripción no disponible.';
            return $p;
        }, $products);

        return view('productos.index', [
            'products' => $products,
            'categories' => $categories,
            'searchQuery' => $searchQuery,
            'selectedCategory' => $selectedCategory ?: 'Todos',
        ]);
    }

    /**
     * Muestra la página de detalle de un producto, obteniéndolo de la API.
     */
    public function show($id)
    {
        // Obtener producto de la API (ej: /api/products/1)
        $product = $this->fetchDataFromApi("products/{$id}");

        if (!$product) {
            abort(404, 'Producto no encontrado en la API');
        }

        return view('productos.show', ['product' => $product]);
    }

    // --- Métodos de Carrito y Checkout (Usan Sesión) ---

    public function cartIndex(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        
        // Se asegura de que price y quantity existen para evitar errores al mapear
        $subtotal = array_sum(array_map(function($item) {
            return ($item['price'] ?? 0.00) * ($item['quantity'] ?? 0);
        }, $cart));

        return view('productos.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal
        ]);
    }

    public function addToCart(Request $request)
    {
        // Validación básica
        $request->validate([
            'product_id' => 'required', // Puede ser string si el ID de la API es un UUID
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $productData = $request->only(['product_id', 'name', 'price', 'image']);
        $productID = $productData['product_id'];
        $quantity = $request->input('quantity', 1);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$productID])) {
            $cart[$productID]['quantity'] += $quantity;
        } else {
            $cart[$productID] = [
                'id' => $productID,
                'name' => $productData['name'],
                'price' => (float)$productData['price'],
                'image' => $productData['image'] ?? 'placeholder.jpg',
                'quantity' => $quantity,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
        }

        return redirect()->route('cart.index')->with('error', 'Producto no encontrado en el carrito.');
    }

    public function updateCartItem(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = $request->session()->get('cart', []);
        $quantity = $request->input('quantity');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            $request->session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
        }

        return redirect()->route('cart.index')->with('error', 'Producto no encontrado.');
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'El carrito ha sido vaciado.');
    }

    public function checkoutIndex(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'El carrito está vacío.');
        }

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $shipping = 15.00; // Envío simulado
        $total = $subtotal + $shipping;

        return view('productos.checkout', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function processPayment(Request $request)
    {
        // En un caso real, aquí iría la lógica de pago con la API
        $request->session()->forget('cart');
        return redirect()->route('dashboard')->with('success', '¡Gracias! Tu compra ha sido procesada con éxito.');
    }
}
