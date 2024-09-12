{{-- @extends('layouts.app')

@section('title', 'Home')

@section('content')


<div class="container mt-4">
    <h1 class="display-4">Products</h1>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img id="current-image" src="{{ asset($product->image) }}" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->description }}</p>

                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>No products available.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection --}}
