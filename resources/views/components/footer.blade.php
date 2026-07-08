<footer class="bg-dark text-light text-center py-3 mt-5">
    <div class="container">
        @auth
            <a href="{{ route('becomeRevisor') }}" class="btn btn-outline-light btn-sm">{{ __('ui.work_with_us') }}</a>
        @endauth
        <p class="mb-0 mt-2"><small>Presto © 2026</small></p>
    </div>
</footer>