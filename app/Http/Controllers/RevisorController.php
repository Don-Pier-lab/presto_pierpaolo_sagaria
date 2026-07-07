<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Article;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::where('is_accepted', null)->first();

        return view('revisor.index', compact('article_to_check'));
    }

    public function accept(Article $article)
    {
        $article->setAccepted(true);

        return redirect()->route('revisor.dashboard')->with('success', 'Articolo accettato');
    }

    public function reject(Article $article)
    {
        $article->setAccepted(false);

        return redirect()->route('revisor.dashboard')->with('success', 'Articolo rifiutato');
    }

    public function becomeRevisor()
    {
        Mail::to('admin@presto.test')->send(new BecomeRevisor(auth()->user()));

        return redirect()->route('homepage')->with('success', 'Richiesta inviata! Ti faremo sapere presto.');
    }
}