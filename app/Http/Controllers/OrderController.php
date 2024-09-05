<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty!');
        }

        $order = \App\Models\Order::create();

        foreach ($cart as $productId => $details) {
            $order->products()->attach($productId, ['quantity' => $details['quantity'], 'price' => $details['price']]);
        }

        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Order placed successfully!');
    }
}
