<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layout')]
class CreateArticle extends Component
{
    use WithFileUploads;

    public $title = '';
    public $price = '';
    public $description = '';
    public $category_id = '';
    public $images = [];
    public $temporary_images = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ];

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'max:6',
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function store()
    {
        $this->validate();

        $article = Article::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);

        if (count($this->images)) {
            foreach ($this->images as $image) {
                $article->images()->create([
                    'path' => $image->store('images', 'public'),
                ]);
            }
        }

        session()->flash('success', 'Annuncio inserito con successo');

        $this->cleanForm();
    }

    public function cleanForm()
    {
        $this->title = '';
        $this->price = '';
        $this->description = '';
        $this->category_id = '';
        $this->images = [];
        $this->temporary_images = [];
    }

    public function render()
    {
        return view('livewire.create-article', [
            'categories' => Category::all(),
        ]);
    }
}