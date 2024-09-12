<!-- resources/views/superadmin/login.blade.php -->

@extends('layouts.app')

@section('title', 'Super Admin Login')

@section('content')
<div class="container">
    <h1 class="h1">Login as Super Admin</h1>
    <form method="POST" action="{{ route('superadmin.login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
