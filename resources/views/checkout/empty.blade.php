@extends('layouts.app')

@section('title', 'Cart Empty')

@section('content')
<div class="container mt-5">
    <h1>Your Cart is Empty</h1>
    <p>You have no items in your cart. Please add some items before proceeding to checkout.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Browse Products</a>
</div>
@endsection
