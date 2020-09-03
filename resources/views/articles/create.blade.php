@extends('default')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h2>Crée votre article</h2>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
      @if ($errors->any())

      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>

      @endif
        <form method="POST" action="{{route('articles.store')}}" name="sentMessage" id="contactForm" >
        @csrf
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Titre</label>
                <input type="text" class="form-control" placeholder="Name" id="name" name="title" value="{{old('title')}}"  >
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Sous titre</label>
                <textarea rows="2" class="form-control" name="sub_title" placeholder="Sous titre" id="message">{{old('sub_title')}}</textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Date de publication</label>
                <input type="date" class="form-control" id="name" name="published_at"   value="{{old('published_at')}}" >
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                <label>Contenu</label>
                <textarea rows="5" class="form-control" name="body" placeholder="Message"  >{{old('body')}}</textarea>

                </div>
            </div>
            <br>
            {{-- <input type="hidden" name="user_id" value="1"> --}}
            {{-- <input type="hidden" name="slug" value="1"> --}}
            <div id="success"></div>
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Ajoutée</button>
        </form>
      </div>
    </div>
  </div>
  @endsection
