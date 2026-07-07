<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use App\Livewire\CreateArticle;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/articles', [PublicController::class, 'articleIndex'])->name('articles.index');

Route::get('/articles/create', CreateArticle::class)
    ->middleware('auth')
    ->name('articles.create');

Route::get('/categories/{category}', [PublicController::class, 'byCategory'])->name('articles.byCategory');

Route::get('/become-revisor', [RevisorController::class, 'becomeRevisor'])
    ->middleware('auth')
    ->name('becomeRevisor');

Route::get('/make-revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

Route::get('/revisor/dashboard', [RevisorController::class, 'index'])
    ->middleware('isRevisor')
    ->name('revisor.dashboard');

Route::patch('/revisor/accept/{article}', [RevisorController::class, 'accept'])->name('revisor.accept');

Route::patch('/revisor/reject/{article}', [RevisorController::class, 'reject'])->name('revisor.reject');

Route::get('/articles/{article}', [PublicController::class, 'articleShow'])->name('articles.show');