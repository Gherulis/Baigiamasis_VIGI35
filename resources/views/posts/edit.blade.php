@extends('includes.layout')

@section('content')
    <div class="login-form store-form">
        
        <h3>Redaguoti skelbima</h3>
     
        <form action="{{route('post.update',$posts)}}" method="POST", enctype="multipart/form-data">
        @csrf
        <div >
      
        <div class="login-text">
            <input type="text" name="postName" value="{{$posts->postName}}" >
            <label for="postName">Pavadinimas</label>
        </div>
        <div class="login-text">
            <input type="text" name="postBody" value="{{$posts->postBody}}">
            <label for="postBody">Tekstas</label>
        </div>
        <div class="login-text">
            <input type="text" name="postLink" value="{{$posts->postLink}}">
            <label for="postLink">Nuoroda</label>
        </div>
        <div>
           <input type="file" id="postImage" name="postImage" value="{{$posts->postImage}}">
        </div>
    
        <input class="btn" type="submit" value="Pridėti">
        
        </form>
    </div>

@endsection
