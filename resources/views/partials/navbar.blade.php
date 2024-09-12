<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">E-Commerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if(!Auth::guard('admin')->check() && !Auth::guard('superadmin')->check() && !Auth::guard('web')->check())
                    <!-- Links for guests (not logged in) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-primary text-white mr-2" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu" aria-labelledby="loginDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">User Login</a>
                            <a class="dropdown-item" href="{{ route('admin.login.form') }}">Admin Login</a>
                            <a class="dropdown-item" href="{{ route('superadmin.login.form') }}">Super Admin Login</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-success text-white" href="#" id="registerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="registerDropdown">
                            <a class="dropdown-item" href="{{ route('register') }}">User Register</a>
                            <a class="dropdown-item" href="{{ route('admin.register.form') }}">Admin Register</a>
                        </div>
                    </li>
                @else
                    <!-- Links for logged-in users -->
                    @if (Auth::guard('superadmin')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('superadmin.dashboard') }}">SuperAdmin Dashboard</a>
                        </li>
                    @elseif (Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard', ['id' => Auth::guard('admin')->user()->id]) }}">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index', Auth::guard('admin')->user()->id) }}">Products</a>
                        </li>
                    @elseif (Auth::guard('web')->check())
                        <li class="nav-item">
                            <a class="btn btn-success ml-2" href="{{ route('user_dashboard', ['id' => Auth::user()->id]) }}">User Dashboard</a>
                            <a href="{{ route('cart.index') }}" class="btn btn-warning ml-2">View Cart</a>
                        </li>
                    @endif
                    <!-- Search Form -->
                    <form class="form-inline my-2 my-lg-0 mx-3" action="{{ route('products.search') }}" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search Products" aria-label="Search" name="query" value="{{ request()->query('query') }}">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white ml-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="
                            @if (Auth::guard('superadmin')->check())
                                {{ route('superadmin.logout') }}
                            @elseif (Auth::guard('admin')->check())
                                {{ route('admin.logout') }}
                            @else
                                {{ route('logout') }}
                            @endif" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>  
    </div>
</nav>
