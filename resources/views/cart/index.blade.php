@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-4xl font-bold mb-4">Your Cart</h1>
    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="w-full">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td>{{ $item['product']->title }}</td>
                    <td>${{ $item['product']->price }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['product']->price * $item['quantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total Amount:</strong> ${{ $totalAmount }}</p>
        <div class="flex justify-end mt-8 ml-5 space-x-4">
            <!-- Form to proceed to checkout -->
            <form action="{{ route('checkout.index') }}" method="GET">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    Proceed to Checkout
                </button>
            </form>
            <!-- Link to add more products -->
            <a href="{{ url('/') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Add More Products
            </a>
        </div>        
    @endif
</div>
@endsection
