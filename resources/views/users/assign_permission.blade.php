@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Permission to User</h2>
    <form method="POST" action="{{ route('user.assignPermission', $user->id) }}">
        @csrf
        <div class="form-group">
            <label for="permission">Permission</label>
            <select class="form-control" id="permission" name="permission" required>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Permission</button>
    </form>
</div>
@endsection
