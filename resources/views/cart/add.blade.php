@extends('layouts.app')

@section('title', 'Add to Cart')

@section('content')
<div class="container mt-5">
    <h1>Add to Cart</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('cart.add', $product->id) }}" method="post">
        @csrf
        <div class="input-group mb-2" style="width: 150px;">
            <input type="number" name="quantity" value="1" min="1" class="form-control">
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </div>
    </form>
    
</div>
@endsection
