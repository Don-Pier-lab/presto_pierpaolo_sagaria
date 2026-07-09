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
<div class="mb-3">
                <label for="images" class="form-label">Immagini (max 6)</label>
                <input type="file" id="images" wire:model="temporary_images" multiple
                    class="form-control @error('temporary_images.*') is-invalid @enderror @error('temporary_images') is-invalid @enderror">
                @error('temporary_images.*') <div class="text-danger small">{{ $message }}</div> @enderror
                @error('temporary_images') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            @if (!empty($images))
                <div class="row mb-3">
                    <p class="mb-2">Anteprima immagini:</p>
                    @foreach ($images as $key => $image)
                        <div class="col-md-3 mb-2" wire:key="img-{{ $key }}">
                            <div style="background-image: url('{{ $image->temporaryUrl() }}'); background-size: cover; background-position: center; height: 140px; border-radius: 6px;"></div>
                            <button type="button" wire:click="removeImage({{ $key }})" class="btn btn-sm btn-danger mt-1 w-100">Rimuovi</button>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <button type="submit" class="btn btn-primary">Pubblica annuncio</button>
        </form>
    </div>
</div>