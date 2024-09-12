@extends('layouts.app')

@section('title', 'Confirm Order')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">Confirm Order</h1>

    <form action="{{ route('checkout.finalize') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Finalize Order</button>
    </form>
</div>
@endsection
