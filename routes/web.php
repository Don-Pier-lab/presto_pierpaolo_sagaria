<?php

use App\Http\Controllers\PublicController;
use App\Livewire\CreateArticle;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/articles', [PublicController::class, 'articleIndex'])->name('articles.index');

Route::get('/articles/create', CreateArticle::class)
    ->middleware('auth')
    ->name('articles.create');

Route::get('/articles/{article}', [PublicController::class, 'articleShow'])->name('articles.show');

Route::get('/categories/{category}', [PublicController::class, 'byCategory'])->name('articles.byCategory');