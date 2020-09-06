<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class Pagecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckRole');
    }
    /*    public function index()
    {
        $q = request('q');

        $articles = Article::Recherche($q)->latest()->with('user')->paginate(20);
        //$articles->load('user');
        return view('pages/index', compact('articles'));
    }
*/

    public function about()
    {
        return view('pages.about');
    }

    public function showArticle($slug)
    {
        // $article = Article::where('slug', $slug)->first();

        // return view('articles.show', compact('article'));
    }
}