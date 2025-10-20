<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ProductController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // Listar productos
    public function index()
    {
        $response = $this->apiService->get('/products');
        $productos = isset($response['success']) && !$response['success'] ? [] : $response;
        
        return view('productos.index', compact('productos'));
    }

    // Mostrar detalle de producto
    public function show($id)
    {
        $response = $this->apiService->get("/products/{$id}");
        
        if (isset($response['success']) && !$response['success']) {
            return redirect()->route('products.index')
                ->with('error', $response['error'] ?? 'Producto no encontrado');
        }

        $producto = $response;
        return view('productos.show', compact('producto'));
    }

    // Agregar al carrito
    public function addToCart(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'name'       => 'required|string|max:255',
                'price'      => 'required|numeric|min:0',
                'quantity'   => 'required|integer|min:1|max:10'
            ]);

            $cart = session()->get('cart', []);

            // Verificar si el producto ya está en el carrito
            if (isset($cart[$validated['product_id']])) {
                $cart[$validated['product_id']]['quantity'] += $validated['quantity'];
            } else {
                $cart[$validated['product_id']] = [
                    'id'       => $validated['product_id'],
                    'name'     => $validated['name'],
                    'price'    => $validated['price'],
                    'quantity' => $validated['quantity']
                ];
            }

            session()->put('cart', $cart);

            // Actualizar contador del carrito en sesión
            $cartCount = count($cart);
            session()->put('cart_count', $cartCount);

            return redirect()->route('products.cart')
                ->with('success', '✅ Producto agregado al carrito correctamente');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', '❌ Error al agregar el producto al carrito: ' . $e->getMessage());
        }
    }

    // Ver carrito
    public function cart()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('productos.cart', compact('cart', 'total'));
    }

    // Actualizar cantidad en carrito
    public function updateCart(Request $request)
    {
        try {
            $validated = $request->validate([
                'product_id' => 'required|integer',
                'quantity'   => 'required|integer|min:1|max:10'
            ]);

            $cart = session()->get('cart', []);

            if (isset($cart[$validated['product_id']])) {
                if ($validated['quantity'] <= 0) {
                    unset($cart[$validated['product_id']]);
                } else {
                    $cart[$validated['product_id']]['quantity'] = $validated['quantity'];
                }

                session()->put('cart', $cart);
                
                // Actualizar contador
                $cartCount = count($cart);
                session()->put('cart_count', $cartCount);

                return redirect()->route('products.cart')
                    ->with('success', 'Carrito actualizado correctamente');
            }

            return redirect()->route('products.cart')
                ->with('error', 'Producto no encontrado en el carrito');

        } catch (\Exception $e) {
            return redirect()->route('products.cart')
                ->with('error', 'Error al actualizar el carrito: ' . $e->getMessage());
        }
    }

    // Eliminar producto del carrito
    public function removeFromCart($productId)
    {
        try {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
                
                // Actualizar contador
                $cartCount = count($cart);
                session()->put('cart_count', $cartCount);

                return redirect()->route('products.cart')
                    ->with('success', 'Producto eliminado del carrito');
            }

            return redirect()->route('products.cart')
                ->with('error', 'Producto no encontrado en el carrito');

        } catch (\Exception $e) {
            return redirect()->route('products.cart')
                ->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    // Vaciar carrito
    public function clearCart()
    {
        try {
            session()->forget('cart');
            session()->forget('cart_count');

            return redirect()->route('products.cart')
                ->with('success', 'Carrito vaciado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('products.cart')
                ->with('error', 'Error al vaciar el carrito: ' . $e->getMessage());
        }
    }

    // Guardar pedido en la API
    public function storeCart(Request $request)
    {
        try {
            $user = session('user');
            $cart = session('cart', []);

            if (!$user) {
                return back()->with('error', 'Debes iniciar sesión para hacer el pedido.');
            }

            if (empty($cart)) {
                return back()->with('error', 'Tu carrito está vacío.');
            }

            // Mapeamos los productos del carrito al formato que espera el backend
            $items = array_map(fn($item) => [
                'product_id' => (int) $item['id'],
                'quantity'   => (int) ($item['quantity'] ?? 1),
                'price'      => (float) ($item['price'] ?? 0),
            ], $cart);

            // Calcular el total
            $totalAmount = array_reduce($items, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);

            // Enviar pedido al backend usando ApiService
            $response = $this->apiService->post('/orders', [
                'user_id'      => $user['id'],
                'total_amount' => $totalAmount,
                'order_date'   => now()->toDateTimeString(),
                'status' => 'pending',
                'items'        => $items
            ]);

            if (isset($response['success']) && !$response['success']) {
                $error = $response['error'] ?? 'Error desconocido';
                return back()->with('error', "Error al guardar el pedido: $error");
            }

            // Limpiar carrito después de guardar el pedido
            session()->forget('cart');
            session()->forget('cart_count');

            return redirect()->route('products.myOrders')->with('success', '🎉 Pedido realizado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    // Ver pedidos del usuario
    public function myOrders()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        $response = $this->apiService->get("/orders/user/{$user['id']}");
        $orders = isset($response['success']) && !$response['success'] ? [] : $response;
        
        return view('productos.orders', compact('orders'));
    }
}