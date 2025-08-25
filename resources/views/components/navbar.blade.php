<!-- navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Creative Coder</a>
        <div class="d-flex">
            <a href="/#blogs" class="nav-link">Blogs</a>
            @auth
                <img src="{{ auth()->user()->avatar }}" alt="profile" class="rounded-circle" width="40" height="40">
                <a href="" class="nav-link">
                    {{ auth()->user()->name }}
                </a>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                </form>
            @else
                <a href="/register" class="nav-link">Register</a>
                <a href="/login" class="nav-link">Login</a>
            @endauth

            <a href="#subscribe" class="nav-link">Subscribe</a>
        </div>
    </div>
</nav>
