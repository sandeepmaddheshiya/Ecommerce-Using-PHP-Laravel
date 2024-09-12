<!-- resources/views/admin/products/index.blade.php -->

@extends('layouts.app')

@section('title', 'Product List')

@section('content')
<style>
    .text {
        display: block;
        width: 400px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
<div class="container">
    <h1>Products</h1>
    
    @if ($products->isEmpty())
        <p>No products found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td class="text">{{ $product->description }}</td>
                        <td>{{ $product->address }}</td>
                        <td>{{ $product->category ? $product->category->name : 'No category' }}</td>
                        <td>
                            <a href="{{ route('admin.products.show', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('admin.products.edit', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.products.destroy', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a class="btn btn-dark" href="{{ route('admin.dashboard', ['id' => Auth::guard('admin')->user()->id])}}">GO Back Dashboard</a>
        <a href="{{ route('admin.products.create', Auth::guard('admin')->user()->id) }}" class="btn btn-primary">Create Product</a>
        @endif
</div>
@endsection
