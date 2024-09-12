@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container mt-4">
    <h1 class="display-4">Notifications</h1>
    @if ($notifications->isEmpty())
        <p>You have no notifications.</p>
    @else
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item">
                    {{ $notification->message }}
                    <span class="text-muted float-right">{{ $notification->created_at }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
