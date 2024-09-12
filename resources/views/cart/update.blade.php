@extends('layouts.app')

@section('title', 'Update Cart')

@section('content')
<div class="container mt-5">
    <h1>Update Cart</h1>
    <form action="{{ route('cart.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $cartItem->quantity }}" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Cart</button>
    </form>
</div>
@endsection
