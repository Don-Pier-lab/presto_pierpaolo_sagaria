<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout')]
class CreateArticle extends Component
{
    public $title = '';
    public $price = '';
    public $description = '';
    public $category_id = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ];

    public function store()
    {
        $this->validate();

        Article::create([
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);

        session()->flash('success', 'Annuncio inserito con successo');

        $this->reset(['title', 'price', 'description', 'category_id']);
    }

    public function render()
    {
        return view('livewire.create-article', [
            'categories' => Category::all(),
        ]);
    }
}