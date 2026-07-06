<x-layout>
    <div class="text-center py-5">
        <h1>Benvenuto su Presto</h1>
        <p class="lead">Il portale per comprare e vendere di tutto.</p>

        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-lg mt-3">Inserisci annuncio</a>
    </div>

    <h2 class="mb-4">Ultimi annunci</h2>

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
        <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">Vedi tutti gli annunci</a>
    </div>
</x-layout>