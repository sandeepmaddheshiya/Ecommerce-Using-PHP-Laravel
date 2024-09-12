@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<style>

/* Add this to your CSS file or in a <style> block in your layout */

    #image-preview-container {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f8f9fa;
        text-align: center;
    }

    #current-image {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Edit Product</span>
                    <a href="{{ route('admin.products.index', Auth::guard('admin')->user()->id) }}" class="btn btn-dark">Back</a>
                </div>

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('admin.products.update', ['admin' => Auth::guard('admin')->user()->id, 'product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" value="{{ old('title', $product->title) }}" class="form-control" name="title" id="title" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" value="{{ old('price', $product->price) }}" class="form-control" name="price" id="price" required>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="5" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" value="{{ old('address', $product->address) }}" class="form-control" name="address" id="address" required>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" id="image" class="form-control" name="image" accept="image/*">
                            @if($product->image)
                                <div id="image-preview-container" class="mt-3">
                                    <p>Current Image:</p>
                                    <img id="current-image" class="img-fluid" src="{{ asset($product->image) }}" alt="Product Image">
                                </div>
                            @endif
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview-container');
            let currentImage = document.getElementById('current-image');
            
            // Remove current image if it exists
            if (currentImage) {
                previewContainer.removeChild(currentImage);
            }

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.id = 'current-image';
                    img.classList.add('img-fluid', 'mt-3');
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</div>
@endsection
