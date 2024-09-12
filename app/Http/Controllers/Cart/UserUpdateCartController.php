<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUpdateCartController extends Controller
{
    public function __invoke(Request $request, $productId)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity');
        // Add logic to update product quantity in the cart for the user
        // ...

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }
}