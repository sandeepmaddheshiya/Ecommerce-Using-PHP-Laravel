@extends('layouts.app')

@section('title', 'Remove from Cart')

@section('content')
<div class="container mt-5">
    <h1>Remove from Cart</h1>
    <p>Are you sure you want to remove the item "{{ $product->title }}" from your cart?</p>
    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Remove</button>
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
