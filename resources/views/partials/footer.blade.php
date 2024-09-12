<footer class="bg-dark text-white mt-5 p-4 text-center">
    <div class="container">
        <p>&copy; {{ date('Y') }} E-Commerce. All Rights Reserved.</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="{{route('policy.show') }}" class="text-white">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="{{ route('terms.show') }}" class="text-white">Terms of Service</a></li>
            <li class="list-inline-item"><a href="{{ route('contact') }}" class="text-white">Contact Us</a></li>
        </ul>
    </div>
</footer>
