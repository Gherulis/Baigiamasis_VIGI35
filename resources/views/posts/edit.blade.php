@extends('includes.layout')

@section('content')
    <div class="login-form store-form">

        <h3>Redaguoti skelbima</h3>

        <form action="{{route('post.update',$posts)}}" method="POST", enctype="multipart/form-data">
        @csrf
        <div >

        <div class="login-text">
            <input type="text" name="postName" value="{{$posts->postName}}" >
            <label for="postName">Antraštė</label>
        </div>
        <div >

            <textarea name="postBody" cols="35" rows="4" placeholder="Straispnis"> {{$posts->postBody}}</textarea>

        </div>

        <div class="login-text">
            <input type="text" name="postLink" value="{{$posts->postLink}}">
            <label for="postLink">Nuoroda</label>
        </div>
        <div>
           <input type="file" id="postImage" name="postImage" value="{{$posts->postImage}}">
        </div>
        @can('post-edit')
        <input class="btn" type="submit" value="Pridėti">
        @endcan


        </form>
    </div>

@endsection
