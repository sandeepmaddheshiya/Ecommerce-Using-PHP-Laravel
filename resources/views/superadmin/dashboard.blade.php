@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<head>
    <!-- Other head elements -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<div class="container mt-4">
    <h1 class="display-4">Super Admin Dashboard <i class="fas fa-arrow-down small-icon"></i></h1>
    <p class="lead">Manage user and admin registration requests.</p>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Pending Admin Registrations <i class="fas fa-arrow-down small-icon"></i></h5>
        </div>
        <div class="card-body">
            @if($admins->isEmpty())
                <p>No pending admin registrations.</p>
            @else
                @foreach($admins as $admin)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="mb-0">{{ $admin->name }} ({{ $admin->email }})</p>
                        <div>
                            <form action="{{ route('superadmin.admins.approve', $admin->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('superadmin.admins.reject', $admin->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                {{ $admins->links() }}
            @endif
        </div>
    </div>

    {{-- Approved Lists --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Approved Lists <i class="fas fa-arrow-down small-icon"></i></h5>
        </div>
        <div class="card-body">
            <a href="{{ route('superadmin.adminlist') }}" class="btn btn-primary">Approved Admins List</a>
            <a href="{{ route('superadmin.userslist') }}" class="btn btn-primary">Approved Users List</a>
            <a href="{{ route('complain.show') }}" class="btn btn-warning">Complain Box</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-info">Manage Permissions</a> <!-- Added button for Permissions page -->
        </div>
    </div>
</div>
@endsection
