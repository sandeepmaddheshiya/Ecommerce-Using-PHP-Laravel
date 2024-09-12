@extends('layouts.app')

@section('title', 'Order Completed')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Order Completed</h1>
    <div class="alert alert-success" role="alert">
        Your order has been placed successfully!
    </div>
    <p>Thank you for shopping with us. <a href="{{ route('home') }}">Continue shopping</a> or <a href="{{ route('order.history') }}">view your orders</a>.</p>
</div>
@endsection
