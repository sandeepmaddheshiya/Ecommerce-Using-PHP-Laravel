@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="bg-dark py-3">
    <h3 class="text-white text-center">POST PRODUCT</h3>
</div>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('admin.products.index', Auth::guard('admin')->user()->id) }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-3">
                <div class="card-header bg-dark h4">
                    <h3 class="text-white">Create Product</h3>
                </div>
                <form enctype="multipart/form-data" action="{{ route('admin.products.store', ['admin' => Auth::guard('admin')->user()->id]) }}" method="POST">


                    @csrf
                    <div class="card-body">
                        <div class="mb-3 h5">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" value="{{ old('title') }}" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" required>
                            @error('title')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 h5">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" value="{{ old('price') }}" class="form-control form-control-lg @error('price') is-invalid @enderror" id="price" name="price" required>
                            @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 h5">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control form-control-lg @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 h5">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" placeholder="Description" class="form-control form-control-lg @error('description') is-invalid @enderror" id="description" cols="30" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 h5">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" value="{{ old('address') }}" class="form-control form-control-lg @error('address') is-invalid @enderror" id="address" name="address" required>
                            @error('address')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 h5">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control form-control-lg @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
