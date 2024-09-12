@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mt-4">
    <h1 class="display-4">Order #{{ $order->id }}</h1>
    <div class="row">
        <div class="col-md-6">
            <h5>Order Details</h5>
            <ul>
                <li>Email: {{ $order->email }}</li>
                <li>Phone: {{ $order->phone }}</li>
                <li>Address: {{ $order->address }}</li>
                <li>Comment: {{ $order->comment }}</li>
                <li>Status: {{ $order->status }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h5>Order Items</h5>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->product->title }} - {{ $item->quantity }} x ${{ $item->price }}</li>
                @endforeach
            </ul>
            <h5>Total: ${{ $order->total }}</h5>
        </div>
    </div>
</div>
@endsection
