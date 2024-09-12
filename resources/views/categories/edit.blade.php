@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Category</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.update', [$category->slug, $category->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
        </div>
    </div>
@endsection
