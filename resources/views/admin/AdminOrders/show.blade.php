@extends('layouts.app')

@section('title', 'View Orders')

@section('content')
<div class="container">

    <h1 class="h1">Order Details</h1>

        <p>Order ID: {{ $order->id }}</p>
        <p>User: {{ $order->user->name ?? 'Unknown User' }}</p>
        <p>Total Price: {{ $order->total_amount }}</p>
        <p>Status: {{ $order->status }}</p>

    <h2 class="h2">Order Items</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($order->orderItems as $item) <!-- Use `orderItems` here -->
                <tr>
                    <td>{{ $item->product->title ?? 'Unknown Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a class="btn btn-dark" href="{{ route('admin.dashboard', ['id' => Auth::guard('admin')->user()->id]) }}">GO Back Dashboard</a>
    <a class="btn btn-dark" href="{{ route('admin.orders.index', ['id' => Auth::guard('admin')->user()->id]) }}">All Orders</a>
</div>
@endsection
