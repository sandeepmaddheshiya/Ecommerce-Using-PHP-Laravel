<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        $quantity = $request->quantity;

        $cart = Session::get('cart', []);
        $cart[$product->id] = [
            'product' => $product,
            'quantity' => $quantity,
        ];
        Session::put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['product']->price * $item['quantity'];
        }, $cart));

        return view('cart.index', compact('cart', 'totalAmount'));
    }
}
