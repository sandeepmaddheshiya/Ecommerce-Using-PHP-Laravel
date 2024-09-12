@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex flex-wrap">
        <!-- Product Image -->
        <div class="w-full md:w-1/2 mb-8 md:mb-0">
            <div class="flex justify-center items-center h-96 bg-gray-100 rounded-md overflow-hidden">
                <img id="current-image" src="{{ asset($product->image) }}" alt="Product Image" class="max-w-full max-h-full object-contain">
            </div>
        </div>

        <!-- Product Details -->
        <div class="w-full md:w-1/2 md:pl-10">
            <h1 class="text-4xl font-bold mb-4">{{ $product->title }}</h1>
            <p class="text-lg mb-4">{{ $product->description }}</p>
            <p class="text-xl font-semibold mb-2"><strong>Price:</strong> ${{ $product->price }}</p>
            <p class="mb-2"><strong>Address:</strong> {{ $product->address }}</p>
            <p class="mb-4"><strong>Category:</strong> {{ $product->category->name }}</p>
            
            <!-- Action Buttons -->
            <div class="flex items-center mt-6">
                @auth
                <!-- Buy Now Button -->
                <form action="{{ route('checkout.index') }}" method="GET" class="mr-4">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1"> <!-- Default quantity -->
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded shadow">Buy Now</button>
                </form>

                <!-- Add to Cart Button -->
                <form action="{{ route('cart.add') }}" method="POST" class="flex">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1" class="form-input mr-2 w-20">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">Add to Cart</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">Login to Purchase</a>
                @endauth
            </div>
        </div>

        <div class="w-full mt-10">
            <h2 class="text-2xl font-bold mb-6">Reviews</h2>
            @forelse($reviews as $review)
                <div class="mb-4 p-4 bg-white rounded shadow">
                    <p class="font-semibold">{{ $review->user->name }} - {{ $review->rating }} Stars</p>
                    <p>{{ $review->comment }}</p>
                </div>
            @empty
                <p class="mb-3">No reviews available for this product.</p>
            @endforelse
        </div>
        
        
        
            
            <!-- Add Review Section -->
            @auth
            <div class="bg-white p-6 rounded shadow mt-6 w-100">
                <h3 class="text-xl font-bold mb-4">Leave a Review</h3>
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}"> <!-- Add this line -->
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                        <select id="rating" name="rating" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Choose a rating...</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Review</label>
                        <textarea id="comment" name="comment" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">Submit Review</button>
                </form>
                
            </div>
            @else
            <p><a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">Login to Leave a Review</a></p>
            @endauth
        </div>
    </div>
</div>
@endsection
