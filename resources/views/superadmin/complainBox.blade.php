@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Complain Box</h1>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Complaints</h2>
                </div>
                <div class="card-body">
                    @forelse($complains as $complain)
                        <div class="mb-4 p-3 bg-light rounded border">
                            <h5 class="font-weight-bold mb-1">{{ $complain->name }} <small class="text-muted">({{ $complain->email }})</small></h5>
                            <p class="mb-0">{{ $complain->message }}</p>
                        </div>
                    @empty
                        <div class="alert alert-info" role="alert">
                            No complaints available.
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('superadmin.dashboard') }}" class="btn btn-secondary">Go Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
