<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'CheckRole'])->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $q = request('q');
        $page = request('page', 1);

        // $articles =  Cache::tags(['articles', 'homepage'])->remember("homepage-$q-$page", 60 * 20, function () use ($q) { //tags c juste un nom pour use dans le cache ca ne marche pas avec file en cache il faut passer sous redis
        $articles =  Cache::remember("homepage-$q-$page", 60 * 20, function () use ($q) { //tags c juste un nom pour use dans le cache
            return Article::Recherche($q)->latest('id')->with('user')->paginate(20);
        });

        // solution classique
        //$articles = Article::Recherche($q)->latest('id')->with('user')->paginate(20);
        //$articles->load('user');

        // using cache in the score
        //$articles = Article::home();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3',
            'sub_title' => 'required',
            'published_at' => 'required',
            'body' => 'required',
            'image' => 'image|max:100000'

        ]);
        //2eme solution pour rajotué le slug
        $article = auth()->user()->articles()->create(request()->all() + [
            'slug' => Str::slug(request('title')),

        ]);

        /*$article = Article::create(request()->all() + [ //2eme solution pour rajotué le slug
            'slug' => Str::slug(request('title')),
            'user_id' => auth()->id()
        ]);
        */
        //Cache::flush(); raw technique
        return redirect()->route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'sub_title' => 'required',
            'published_at' => 'required',
            'body' => 'required',
            'image' => 'image|max:100000'

        ]);

        $article = Article::find($id);

        $article->update($request->all() + [
            'slug' => Str::slug(request('title')),

        ]);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}