<?php

namespace App\Http\Controllers\Cart;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAddToCartController extends Controller
{
    public function __invoke(Request $request, $productId)
    {
        // Retrieve the product
        $product = Product::findOrFail($productId);

        // Get the current cart from the session or create a new one if it doesn't exist
        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            // Add new product to the cart
            $cart[$productId] = [
                'title' => $product->title,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        // Redirect to the cart index page
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    protected function updateOrderTotal(Order $order)
    {
        $total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order->update(['total_price' => $total]);
    }
}
