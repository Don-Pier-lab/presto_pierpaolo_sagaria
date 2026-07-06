<?php

use App\Http\Controllers\PublicController;
use App\Livewire\CreateArticle;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/articles/create', CreateArticle::class)
    ->middleware('auth')
    ->name('articles.create');