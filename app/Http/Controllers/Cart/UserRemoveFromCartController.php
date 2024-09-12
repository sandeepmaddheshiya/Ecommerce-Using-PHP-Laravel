<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRemoveFromCartController extends Controller
{
    public function __invoke(Request $request, $productId)
    {
        $user = Auth::user();
        // Add logic to remove product from cart for the user
        // ...

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}