<!-- resources/views/admin/products/index.blade.php -->

@extends('layouts.app')

@section('title', 'Approved Admins List')

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
<div class="container mt-5">
    <h1>Approved Admins</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>User_id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userslist as $users)
                <tr>
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->email }}</td>
                    
                    <td>
                        <!-- Ensure these routes are defined for SuperAdmin actions -->
                       <form action="{{ route('superadmin.destroyUser', ['id' => $users->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a class="btn btn-dark" href="{{ route('superadmin.dashboard', ['id' => Auth::guard('superadmin')->user()->id]) }}">Go Back to Dashboard</a>
</div>
@endsection
