@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h1">Orders</h1>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Order List</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Unknown User' }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="Pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </form>
                            </td>                            
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="pagination">
                    {{ $orders->links('pagination::bootstrap-5') }} <!-- Use Bootstrap 5 pagination view -->
                </div>

                <a class="btn btn-dark" href="{{ route('admin.dashboard', ['id' => Auth::guard('admin')->user()->id]) }}">
                    Go Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
