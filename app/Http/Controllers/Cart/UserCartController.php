<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCartController extends Controller
{
    public function index()
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Calculate the total amount
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Pass the cart items and total amount to the view
        return view('cart.index', ['cartItems' => $cart, 'totalAmount' => $totalAmount]);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Update the quantity of the specified item
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Redirect back to the cart index page
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Remove the specified item from the cart
        if(isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Redirect back to the cart index page
        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully!');
    }
}
