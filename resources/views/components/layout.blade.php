<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('homepage') }}">Presto</a>

            <form action="{{ route('articles.search') }}" method="GET" class="d-flex mx-auto">
                <input type="search" name="query" class="form-control form-control-sm" placeholder="Cerca annunci...">
                <button type="submit" class="btn btn-sm btn-outline-light ms-2">Cerca</button>
            </form>

            <div class="navbar-nav ms-auto">
                @guest
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                @endguest

                @auth
                    <span class="navbar-text me-3">Ciao, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4">
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<footer class="bg-dark text-light text-center py-3 mt-5">
        <div class="container">
            @auth
                <a href="{{ route('becomeRevisor') }}" class="btn btn-outline-light btn-sm">Lavora con noi</a>
            @endauth
            <p class="mb-0 mt-2"><small>Presto © 2026</small></p>
        </div>
    </footer>
</body>
</html>