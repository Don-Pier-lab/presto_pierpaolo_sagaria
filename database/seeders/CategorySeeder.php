<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Motori',
            'Elettronica',
            'Arredamento',
            'Moda',
            'Sport',
            'Libri e Riviste',
            'Fumetti',
            'Musica',
            'Film',
            'Videogame',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}