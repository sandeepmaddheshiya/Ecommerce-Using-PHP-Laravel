@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Category Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="card-title mb-2">{{ $category->name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.edit', [$category->slug, $category->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', [$category->slug, $category->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
