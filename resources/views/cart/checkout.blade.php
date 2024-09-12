@extends('layouts.app')

@section('title', 'Confirm Order')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Confirm Order</h1>

    <div>
        <h4>Items in Cart:</h4>
        <ul>
            @foreach(session('cart') as $id => $details)
                <li>{{ $details['name'] }} - Quantity: {{ $details['quantity'] }} - Price: ${{ $details['price'] * $details['quantity'] }}</li>
            @endforeach
        </ul>

        <h4>Total Amount: ${{ array_reduce(session('cart'), fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0) }}</h4>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="address" value="{{ request('address') }}">
            <input type="hidden" name="payment_method" value="{{ request('payment_method') }}">
            <button type="submit" class="btn btn-success">Confirm Order</button>
            <a href="{{ route('checkout.index') }}" class="btn btn-secondary">Edit Details</a>
        </form>
    </div>
</div>
@endsection
