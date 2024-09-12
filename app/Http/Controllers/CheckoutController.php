<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        // Retrieve the cart from the session
        $cart = Session::get('cart', []);

        // Ensure cart items are properly structured
        foreach ($cart as $key => $item) {
            if (!isset($item['product']) || !isset($item['quantity'])) {
                unset($cart[$key]); // Remove invalid item
            }
        }

        // Calculate the total amount
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['product']->price * $item['quantity'];
        }, $cart));

        return view('checkout.index', compact('cart', 'totalAmount'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Retrieve the product from the database
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        // Get the current cart from the session
        $cart = Session::get('cart', []);

        // Add or update the item in the cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }

        // Save the cart back to the session
        Session::put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function confirm(Request $request)
    {
        // Validate order details
        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'comment' => 'nullable|string',
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer',
        ]);

        // Retrieve the cart from the session
        $cart = Session::get('cart', []);

        // Calculate the total amount
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['product']->price * $item['quantity'];
        }, $cart));

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->id(), // If the user is authenticated
            'total_amount' => $totalAmount,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'comment' => $validated['comment'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending', // Initial status
        ]);

        // Save each item in the order
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['product']->price,
            ]);
        }

        // Clear the cart
        Session::forget('cart');

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
