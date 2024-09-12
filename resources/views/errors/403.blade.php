@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
<div class="container">
    <h1 class="mt-5">403 - Access Denied</h1>
    <p>You are not eligible to access this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
</div>
@endsection
