@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Welcome to Dovex E-Commerce Website</h1>
    <p class="lead">Explore our products and enjoy the best shopping experience.</p>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Categories Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header h6">Categories</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($categories as $category)
                            <li class="list-group-item h6">
                                <a href="{{ route('category.products', ['slug' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="col-md-9">
            <h1 class="display-4">Products</h1>

            <!-- Search Form -->
        {{-- <form action="{{ route('products.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search products..." required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form> --}}


            <div class="row">
                @forelse ($products as $product)
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
                @empty
                    <div class="col-12">
                        <p>No products available.</p>
                    </div>
                @endforelse
            </div>
            {{-- {{ $products->links() }} --}}
        </div>
    </div>
</div>

@endsection
