@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        <h3>Naujas skelbimas</h3>

        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="login-text">
            <input type="text" name="postName"  >
            <label for="postName">Antraštė</label>
        </div>
        <div >

            <textarea name="postBody" cols="35" rows="4" placeholder="Straispnis"></textarea>

        </div>
        <div class="login-text">
            <input type="text" name="postLink" >
            <label for="postLink">Nuoroda</label>
        </div>
        <div>
           <input type="file" id="postImage" name="postImage" >
        </div>

        @can('post-create')
        <input class="btn" type="submit" value="Įkelti skelbima">
        @endcan
        </form>
    </div>

@endsection
