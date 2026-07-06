<div class="row justify-content-center">
    <div class="col-md-7">
        <h1 class="mb-4">Inserisci un annuncio</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form wire:submit="store">
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" id="title" wire:model="title" class="form-control @error('title') is-invalid @enderror">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo (€)</label>
                <input type="number" step="0.01" id="price" wire:model="price" class="form-control @error('price') is-invalid @enderror">
                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea id="description" rows="5" wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select id="category_id" wire:model="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Scegli una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Pubblica annuncio</button>
        </form>
    </div>
</div>