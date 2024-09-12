@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    @if($cart)
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Your Cart</h2>
            <ul>
                @foreach($cart as $item)
                    <li class="flex justify-between mb-4">
                        <span>{{ $item['product']->title }} ({{ $item['quantity'] }})</span>
                        <span>${{ $item['product']->price * $item['quantity'] }}</span>
                    </li>
                @endforeach
            </ul>   
            <div class="font-bold">Total: ${{ $totalAmount }}</div>

            <!-- Checkout Form -->
            <form action="{{ route('checkout.confirm') }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" id="phone" name="phone" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" name="address" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea id="comment" name="comment" rows="4" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md" required>
                        <option value="">Select a payment method...</option>
                        <option value="credit_card">Credit_Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Pay On Delivery</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">Confirm Order</button>
            </form>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
