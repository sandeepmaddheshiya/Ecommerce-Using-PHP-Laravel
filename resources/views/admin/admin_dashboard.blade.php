@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="display-4">{{ Auth::guard('admin')->user()->name }}'s Dashboard</h1>
            <p class="lead">Admin ID: {{ Auth::guard('admin')->user()->id }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Admin Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ Auth::guard('admin')->user()->name }}</td>
                        <td>{{ Auth::guard('admin')->user()->email }}</td>
                        <td>{{ Auth::guard('admin')->user()->phone }}</td>
                        <td>{{ Auth::guard('admin')->user()->address }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.products.create', ['admin' => Auth::guard('admin')->user()->id]) }}" class="btn btn-dark me-2">
                                Create Product
                            </a>
                            <a href="{{ route('admin.products.index', ['admin' => Auth::guard('admin')->user()->id]) }}" class="btn btn-dark me-2">
                                Products
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-info me-2">
                                Orders
                            </a>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary me-2">
                                Categories
                            </a>

                            {{-- Uncomment if needed
                            <a href="{{ route('notification') }}" class="btn btn-warning me-2">
                                Notifications
                            </a>
                            --}}

                            {{-- Uncomment if needed
                            <a href="{{ route('admin.logout') }}" class="btn btn-danger"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
