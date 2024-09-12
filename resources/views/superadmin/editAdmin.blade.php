@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="container mt-5">
    <h1>Edit Admin</h1>

    <form action="{{ route('superadmin.updateAdmin', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin->phone }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>{{ $admin->address }}</textarea>
        </div>

        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" class="form-control" id="salary" name="salary" value="{{ $admin->salary }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-secondary" href="{{ route('superadmin.adminlist') }}">Cancel</a>
    </form>
</div>
@endsection