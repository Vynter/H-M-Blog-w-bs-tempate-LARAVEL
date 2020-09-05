
@extends('default')


@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
<form method="post" class="form" action="{{ route('articles.update', $article->id) }}" name="sentMessage" id="contactForm" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
        <label>Titre</label>
        <input type="text" class="form-control" placeholder="Name" id="name" name="title" value="{{$article->title}}"  >
        </div>
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
        <label>Sous titre</label>
        <textarea rows="2" class="form-control" name="sub_title" placeholder="Sous titre" id="message">{{$article->sub_title}}</textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
        <label>Date de publication</label>
        <input type="date" class="form-control" id="name" name="published_at"   value="{{date('Y-m-d' ,strtotime(($article->published_at)))}}" >
        </div>
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
        <label>Contenu</label>
        <textarea rows="5" class="form-control" name="body" placeholder="Message"  >{{$article->body}}</textarea>

        </div>
    </div>
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
        <label>Image</label>
        <input class="form-control-file" type="file" name="image" value="{{$article->image}}" >

        </div>
    </div>
    <br>
    {{-- <input type="hidden" name="user_id" value="1"> --}}
    {{-- <input type="hidden" name="slug" value="1"> --}}
    <div id="success"></div>
    <button type="submit" class="btn btn-primary" id="sendMessageButton">Ajoutée</button>
</form>
      </div></div></div>
@endsection
