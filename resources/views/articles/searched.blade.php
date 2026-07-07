<x-layout>
    <h1 class="mb-4">Risultati per: "{{ $query }}"</h1>

    <div class="row">
        @forelse ($articles as $article)
            <div class="col-md-4 mb-4">
                <x-card :article="$article" />
            </div>
        @empty
            <p>Nessun annuncio trovato per "{{ $query }}".</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $articles->withQueryString()->links() }}
    </div>

    <div class="mt-3">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Torna a tutti gli annunci</a>
    </div>
</x-layout>