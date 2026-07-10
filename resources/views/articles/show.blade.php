<x-layout>
    <div class="row">
        <div class="col-md-7">
            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if ($article->images->isNotEmpty())
                        @foreach ($article->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                               <img src="{{ $image->getUrl(600, 600) }}" class="d-block w-100 rounded" alt="{{ $article->title }}">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="https://placehold.co/600x400?text=Nessuna+foto" class="d-block w-100 rounded" alt="Nessuna foto">
                        </div>
                    @endif
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <div class="col-md-5">
            <h1>{{ $article->title }}</h1>

            <p class="fs-3 text-primary fw-bold">€ {{ number_format($article->price, 2, ',', '.') }}</p>

            <a href="{{ route('articles.byCategory', $article->category) }}" class="badge bg-secondary text-decoration-none mb-3">
                {{ $article->category->name }}
            </a>

            <p>{{ $article->description }}</p>

            <hr>
            <small class="text-muted">Inserito da {{ $article->user->name }}</small>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Torna agli annunci</a>
    </div>
</x-layout>