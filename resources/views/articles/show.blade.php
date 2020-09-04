@extends('default')





@section('title')
{{$article->title}}
@endsection

@section('sub_title')
{{$article->sub_title}}
@endsection

@section('image')
/storage/{{$article->image}}
@endsection
@section('content')

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>{{$article->body}}</p>
            {{$article->PublishedAtFormated}}
          <h2 class="section-heading">The Final Frontier</h2>


        </div>
      </div>
    </div>
  </article>

  <hr>

  @endsection

