<x-layout>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-center py-5">
        <h1>{{ __('ui.welcome_title') }}</h1>
        <p class="lead">{{ __('ui.welcome_subtitle') }}</p>

        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-lg mt-3">{{ __('ui.insert_article') }}</a>
    </div>

    <h2 class="mb-4">{{ __('ui.latest_articles') }}</h2>

    <div class="row">
        @forelse ($articles as $article)
            <div class="col-md-4 mb-4">
                <x-card :article="$article" />
            </div>
        @empty
            <p>Nessun annuncio presente al momento.</p>
        @endforelse
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">{{ __('ui.all_articles') }}</a>
    </div>
</x-layout>