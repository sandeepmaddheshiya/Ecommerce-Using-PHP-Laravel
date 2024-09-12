@extends('layouts.app')

@section('title', 'Manage Permissions')

@section('content')
<div class="container mt-4">
    <h1 class="display-4">Manage Permissions</h1>
    <p class="lead">Assign permissions to admins.</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Assign Permissions</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.assign') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="admin_id">Select Admin:</label>
                    <select name="admin_id" id="admin_id" class="form-control">
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="permissions">Select Permissions:</label>
                    <select name="permissions[]" id="permissions" class="form-control" multiple>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Permissions</button>
            </form>
        </div>
    </div>
</div>
@endsection
