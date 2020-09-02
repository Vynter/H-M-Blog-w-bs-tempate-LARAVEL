@extends('default')
@section('content')
    <div class="container">


        <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="" class="form-inline">
                <div class="form-group">
                    <input class="form-control" type="search" name="q" placeholder="Recherche..." value="{{request('q')}}">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
            @foreach ($articles as $article)
            <div class="post-preview">
            <a href="{{route('articles.show',$article->slug)}}">
                    <h2 class="post-title">
                    {{/*$loop->iteration*/$article->id}} -
                    {!!$article->title_searched!!}
                    </h2>
                    <h3 class="post-subtitle">
                        {!!$article->sub_title_searched!!}
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">{{ $article->user->name }}</a>
                on {{$article->PublishedAtFormated}}</p>
                </div>

                <hr>
            @endforeach



            <!--<div class="post-preview">
            <a href="post.html">
                <h2 class="post-title">
                I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
                </h2>
            </a>
            <p class="post-meta">Posted by
                <a href="#">Start Bootstrap</a>
                on September 18, 2019</p>
            </div>
            <hr>-->
            <!-- Pager -->
            <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
        </div>
    </div>

    <hr>
    <div class="text-center">{{$articles->appends(request()->all())->links()}}</div><!--$articles->appends(['q'=> request('q')])->links()-->


@endsection
