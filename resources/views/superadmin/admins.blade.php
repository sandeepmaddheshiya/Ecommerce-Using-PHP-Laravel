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
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminlist as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone }}</td>
                    <td>{{ $admin->address }}</td>
                    <td>
                        <form action="{{ route('superadmin.updateSalary', $admin->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT') <!-- Changed from PATCH to PUT -->
                            <input type="number" name="salary" value="{{ $admin->salary }}" class="form-control" style="width: 100px; display: inline;" required>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                    <td>
                        <!-- Ensure these routes are defined for SuperAdmin actions -->
                        {{-- <a href="{{ route('superadmin.adminlist', ['id' => $admin->id]) }}" class="btn btn-info">View</a> --}}
                        {{-- <a href="{{ route('superadmin.editAdmin', ['id' => $admin->id]) }}" class="btn btn-warning">Edit</a> --}}
                        <form action="{{ route('superadmin.destroyAdmin', ['id' => $admin->id]) }}" method="POST" style="display:inline;">
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
