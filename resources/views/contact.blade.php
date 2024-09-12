@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4 h1">Contact Us</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Contact Information</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Address:</strong></p>
                    <p>123 Business Rd., Suite 456<br>
                    Business City, BC 78901<br>
                    DenMark</p>
                    
                    <p class="mb-1"><strong>Phone:</strong></p>
                    <p>(123) 456-7890</p>

                    <p class="mb-1"><strong>Email:</strong></p>
                    <p><a href="mailto:info@yourcompany.com">info@bindia.com</a></p>

                    <p class="mb-1"><strong>Business Hours:</strong></p>
                    <p>Monday - Friday: 9:00 AM - 5:00 PM<br>
                    Saturday: 10:00 AM - 3:00 PM<br>
                    Sunday: Closed</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Send Us a Message</h5>
                </div>
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('complain.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
