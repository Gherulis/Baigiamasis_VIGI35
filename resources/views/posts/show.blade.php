@extends('includes.layout')

@section('content')

<div class="postShowContainer">
    <div class="postShowPost">
        <p class="newsHeader">{{$posts->postName}}</p>
        <hr>
        <div class="postImage_container"> <a href="/storage/cover_images/{{$posts->postImage}}"><img class="newsPhoto"
                src="/storage/cover_images/{{$posts->postImage}}"
                alt="IMG"></a></div>
        <div >
            <p class="newsText">{{$posts->postBody}}</p>
        </div>
        <div>
            <hr>
            <small class="created_at"><a href="{{$posts->postLink}}">Šaltinis : {{$posts->postLink}}</a> <br> Ikelta {{$posts->created_at}} </small>
            
            <form action="{{route('post.delete',$posts)}}" method="POST">
                @csrf
            <button class="btn btn_delete">Istrinti</button> </form>
            <a href="{{route('post.edit',$posts)}}"><button class="btn btn_edit">Redaguoti</button></a>
        </div>
    
    </div>
    </div>

@endsection
