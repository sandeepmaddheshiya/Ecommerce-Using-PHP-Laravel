@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Order Details</h1>

    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total Price:</strong> ${{ $order->total_price }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>

    <h2>Order Items</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                    <td>${{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
