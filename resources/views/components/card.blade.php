@props(['article'])

<div class="card h-100">
    <img src="{{ $article->images->isNotEmpty() ? \Illuminate\Support\Facades\Storage::url($article->images->first()->path) : 'https://placehold.co/400x250?text=Nessuna+foto' }}"
        class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $article->title }}">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $article->title }}</h5>

        <p class="card-text text-primary fw-bold mb-1">€ {{ number_format($article->price, 2, ',', '.') }}</p>

        <a href="{{ route('articles.byCategory', $article->category) }}" class="badge bg-secondary text-decoration-none mb-2 align-self-start">
            {{ $article->category->name }}
        </a>

        <p class="card-text flex-grow-1">{{ Str::limit($article->description, 80) }}</p>

        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary mt-2">Vedi dettaglio</a>
    </div>
</div>