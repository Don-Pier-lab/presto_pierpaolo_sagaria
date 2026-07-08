<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homepage') }}">Presto</a>

        <div class="dropdown me-3">
            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                {{ __('ui.categories') }}
            </button>
            <ul class="dropdown-menu">
                @foreach ($categories as $category)
                    <li>
                        <a class="dropdown-item" href="{{ route('articles.byCategory', $category) }}">
                            {{ __("ui.$category->name") }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <form action="{{ route('articles.search') }}" method="GET" class="d-flex mx-auto">
            <input type="search" name="query" class="form-control form-control-sm" placeholder="{{ __('ui.search_placeholder') }}">
            <button type="submit" class="btn btn-sm btn-outline-light ms-2">{{ __('ui.search') }}</button>
        </form>

        <div class="d-flex align-items-center">
            <x-locale lang="it" flag="it" />
            <x-locale lang="en" flag="gb" />
            <x-locale lang="es" flag="es" />
        </div>

        <div class="navbar-nav ms-auto">
            @guest
                <a class="nav-link" href="{{ route('login') }}">{{ __('ui.login') }}</a>
                <a class="nav-link" href="{{ route('register') }}">{{ __('ui.register') }}</a>
            @endguest

            @auth
                @if (auth()->user()->is_revisor)
                    <a class="nav-link position-relative" href="{{ route('revisor.dashboard') }}">
                        {{ __('ui.revisor_dashboard') }}
                        @if (\App\Models\Article::toBeRevisedCount() > 0)
                            <span class="badge bg-danger">{{ \App\Models\Article::toBeRevisedCount() }}</span>
                        @endif
                    </a>
                @endif

                <span class="navbar-text me-3">Ciao, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">{{ __('ui.logout') }}</button>
                </form>
            @endauth
        </div>
    </div>
</nav>