@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Create Order</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <!-- Form fields for order creation -->
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
@endsection
