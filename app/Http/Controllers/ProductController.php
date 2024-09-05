<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::all();
        return view('products.index', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $product = \App\Models\Product::find($request->product_id);
        $quantity = $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('products.index')->with('success', 'Product added to cart!');
    }
}
