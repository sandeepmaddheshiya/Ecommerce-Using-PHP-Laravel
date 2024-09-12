@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header h6">{{ $product->title }}</div>

                <div class="card-body">
                    <p><strong>Price:</strong> {{ $product->price }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Address:</strong> {{ $product->address }}</p>
                    <p><strong>Category:</strong> {{ $product->category ? $product->category->name : 'No category assigned' }}</p>
                    
                    <div class="mb-3 h5">
                        @if($product->image)
                            <p><strong>Image:</strong></p>
                            <div class="mb-3 h5">
                            <div id="image-preview-container">
                            <img id="current-image" src="{{ asset($product->image) }}" alt="Product Image" class="w-50 my-3">
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header h6">Perform Operations

                    
                    <a href="{{ route('admin.products.index', Auth::guard('admin')->user()->id) }}"><small class="btn float-right btn-dark btn-sm">Back to All Products</small></a>
            
                    @if(Auth::guard('admin')->check())
                    
                    <a href="{{ route('admin.products.edit', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}"><small class="btn float-left btn-warning">Edit</small></a>
                    
                    <form action="{{ route('admin.products.destroy', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection
