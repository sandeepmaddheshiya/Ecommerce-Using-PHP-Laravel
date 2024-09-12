@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="display-4">{{ Auth::guard('web')->user()->name }}'s Dashboard</h1>
            <p class="lead">ID: {{ Auth::guard('web')->user()->id }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">User Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ Auth::guard('web')->user()->name }}</td>
                        <td>{{ Auth::guard('web')->user()->email }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <a href="{{ route('cart.index', Auth::guard('web')->user()->id) }}" class="btn btn-info">
                                    Your Orders
                                </a>
                                <a href="{{ route('cart.index') }}" class="btn btn-warning">View Cart</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
