@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Search Results</h1>
    
    @if($products->isEmpty())
        <p>No products found matching your search criteria.</p>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img id="current-image" src="{{ asset($product->image) }}" alt="Product Image" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('single.product', ['category_slug' => $product->category->slug, 'product_slug' => urlencode($product->title)]) }}">
                                    {{ $product->title }}
                                </a>
                            </h5>
                            <p class="card-text">
                                {{ Str::limit($product->description, 100, '...') }}
                            </p>
                            <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
