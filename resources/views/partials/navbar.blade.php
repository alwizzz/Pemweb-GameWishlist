<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand fs-2" href="{{ route('product.index') }}">Wishlister</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ ($title == 'Home') ? 'active':'' }}" href="{{ route('product.index') }}">Home</a>
                <a class="nav-link {{ ($title == 'About') ? 'active':'' }}" href="/about">About</a>
            </div>

            @guest
            <div class="navbar-nav ms-auto">
                <a class="nav-link {{ ($title == 'Login') ? 'active':'' }}" href="/login">
                    <i class="bi-box-arrow-in-up-right "></i> Login</a>
            </div>
            @endguest

            @auth
            <div class="navbar-nav ms-auto mt-2">
                <p class="text-white" style="margin-top:5px"><i class="bi-person "></i> {{ auth()->user()->username }}</p>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item text-white"
                        onclick="return confirm('Are you sure you want to logout?')">
                        <i class="bi-box-arrow-up-right"></i> Logout
                    </button>
                </form>
                
                {{-- <p></p> --}}
            </div>
            @endauth
        </div>
    </div>
</nav>