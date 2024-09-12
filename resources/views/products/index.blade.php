@extends('layouts.app')

@section('title', 'Products List')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Products List</h1>
            <a href="{{ route('admin.products.create', ['admin' => Auth::guard('admin')->user()->id]) }}" class="btn btn-primary mb-3">Create New Product</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('admin.products.show', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}">{{ $product->title }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.products.destroy', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
