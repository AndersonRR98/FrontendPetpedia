<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    // Listar productos
    public function index()
    {
        $response = Http::get(env('API_URL') . '/products');
        $productos = $response->successful() ? $response->json() : [];

        return view('productos.index', compact('productos'));
    }

    // Mostrar detalle de producto
    public function show($id)
    {
        $response = Http::get(env('API_URL') . "/products/{$id}");
        $producto = $response->successful() ? $response->json() : [];

        return view('productos.show', compact('producto'));
    }

    // Agregar al carrito
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'name'       => 'required|string',
            'price'      => 'required|numeric',
            'quantity'   => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

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

        return redirect()->route('products.cart')->with('success', 'Producto agregado al carrito');
    }

    public function cart()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('productos.cart', compact('cart', 'total'));
    }

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

        // Enviar pedido al backend
        $response = Http::withToken(session('token'))->post(env('API_URL') . '/orders', [
            'user_id'      => $user['id'],
            'total_amount' => $totalAmount,
            'order_date'   => now()->toDateTimeString(),
            'status' => 'pending',
            'items'        => $items
        ]);

        if ($response->failed()) {
            // Mostramos el error exacto que responde el backend (útil para depuración)
            $error = $response->json()['error'] ?? 'Error desconocido';
            return back()->with('error', "Error al guardar el pedido: $error");
        }

        // Limpiar carrito después de guardar el pedido
        session()->forget('cart');

        return redirect()->route('products.myOrders')->with('success', 'Pedido realizado correctamente');

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

    $response = Http::withToken(session('token'))
                    ->get(env('API_URL') . "/orders/user/{$user['id']}");

    $orders = $response->successful() ? $response->json() : [];

    return view('productos.orders', compact('orders'));
}

}
