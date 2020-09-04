<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $q = request('q');

        $articles = Article::Recherche($q)->latest()->with('user')->paginate(20);
        //$articles->load('user');
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