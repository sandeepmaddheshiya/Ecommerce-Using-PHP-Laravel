@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Role to User</h2>
    <form method="POST" action="{{ route('user.assignRole', $user->id) }}">
        @csrf
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Role</button>
    </form>
</div>
@endsection
