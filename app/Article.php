<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [ // les champs qui vont etre sauvegarder dans la db
        'title', 'sub_title', 'published_at',  'body', 'slug', 'user_id'
    ];

    protected $guard = [ // les champs qui ne vont pas etre sauvegarder dans la db
        ''
    ];

    protected $cast = [
        'published_at' => 'datetime:d/m/Y',
    ];

    protected $with = ['user']; //2eme technique pour géré eagre loading ou bien utilise with('user') dans le controller
    /*
    |----------------------------------------------------------------------------------------------------
    | Accesors //mutators
    |----------------------------------------------------------------------------------------------------
    */
    //accesors
    public function getPublishedAtFormatedAttribute()
    {
        return Carbon::parse($this->published_at);
    }

    public function getTitleSearchedAttribute()
    {
        return str_replace(request('q'), '<mark class="bg-danger">' . request('q') . '</mark>', $this->title);
    }

    public function getSubTitleSearchedAttribute()
    {
        return str_replace(request('q'), '<mark class="bg-danger"' . request('q') . '</mark>', $this->sub_title);
    }
    //mutatos

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->title);
    }
    /*
    |----------------------------------------------------------------------------------------------------
    | Scop
    |----------------------------------------------------------------------------------------------------
    */
    public function scopeRecherche($query, $word)
    {
        return $query->where('title', 'like', "%$word%")
            ->orWhere('sub_title', 'like', "%$word%")
            ->orWhere('body', 'like', "%$word%");
    }
    /*
    |----------------------------------------------------------------------------------------------------
    |orm relation
    |----------------------------------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //inorder to get slug in url
    public function getRouteKeyName() // 1er solution pour rajouté le slug en rajoutant aussi une input hiden pour le slug
    {
        return 'slug';
    }
}