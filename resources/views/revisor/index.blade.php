<x-layout>
    <h1 class="mb-4">Area revisore</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($article_to_check)
        <div class="row">
            <div class="col-md-7">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if ($article_to_check->images->count() > 0)
                            @foreach ($article_to_check->images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}" class="d-block w-100 rounded" alt="Immagine">
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
                <h2>{{ $article_to_check->title }}</h2>
                <p class="fs-4 text-primary fw-bold">€ {{ number_format($article_to_check->price, 2, ',', '.') }}</p>
                <p><span class="badge bg-secondary">{{ $article_to_check->category->name }}</span></p>
                <p>{{ $article_to_check->description }}</p>
                <p class="text-muted"><small>Inserito da {{ $article_to_check->user->name }}</small></p>

               <div class="d-flex gap-2 mt-4">
                    <form method="POST" action="{{ route('revisor.accept', $article_to_check) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Accetta</button>
                    </form>

                    <form method="POST" action="{{ route('revisor.reject', $article_to_check) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Rifiuta</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <p class="fs-4">Nessun articolo da revisionare</p>
            <a href="{{ route('homepage') }}" class="btn btn-primary">Torna alla homepage</a>
        </div>
    @endif
</x-layout>