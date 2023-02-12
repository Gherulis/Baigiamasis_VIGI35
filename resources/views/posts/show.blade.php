@extends('includes.layout')

@section('content')

<div class="postShowContainer">
    <div class="postShowPost">
        <p class="newsHeader">{{$posts->postName}}</p>
        <hr>
        <div class="postImage_container" > <a href="/storage/cover_images/{{$posts->postImage}}"><img class="newsPhoto" id="postImage"
                src="/storage/cover_images/{{$posts->postImage}}"
                alt="IMG"></a></div>
        <div >
            <p class="newsText">{{$posts->postBody}}</p>
        </div>
        <hr>
        <div>

            <small class="created_at "><a href="{{$posts->postLink}}">Šaltinis : {{$posts->postLink}}</a> <br> Ikelta {{$posts->created_at}} </small>
           <div class="FloatRight">
            @can('post-edit')
            <a href="{{route('post.edit',$posts)}}"><button class="btn_medium btn_edit">Redaguoti</button></a>
            @endcan
            @can('post-delete')
            <form action="{{route('post.delete',$posts)}}" method="POST">
                @csrf
            <button class="btn_medium btn_delete ">Istrinti</button> </form>
            @endcan

        </div>
        </div>

    </div>
    </div>

@endsection
