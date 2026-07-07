<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class PublicController extends Controller
{
    public function homepage()
    {
        $articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact('articles'));
    }

    public function articleIndex()
    {
        $articles = Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('articles.index', compact('articles'));
    }

    public function articleShow(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()
            ->where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('articles.by-category', compact('category', 'articles'));
    }
}