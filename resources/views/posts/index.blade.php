@extends('includes.layout')



@section('content')
    <section>
        <div class="news-container">
        <button class="btn_medium btn_edit "><a href="{{ route('post.create') }}"> Naujas Skelbimas</a></button></div>
        <div class="news-container">

            @foreach($posts as $post)


            <div class="news-item"><a href="{{ route('post.show',$post) }}">
                <p class="newsHeader">{{$post->postName}}</p>
                <hr>
                <div> <img class="newsPhoto"
                        src="/storage/cover_images/{{$post->postImage}}"
                        alt="IMG"></div>
                <div >
                    <p class="newsText" >{{substr($post->postBody, 0,300 )}}</p>
                </div>
                <hr>
                <div>
                    <small><a href="{{$post->postLink}}">Šaltinis : {{$post->postLink}}</a></small>
                    <br>
                    <small>Ikelta {{$post->created_at}}</small>
                </div>

            </div></a>

            @endforeach



        </div>



    </section>

@endsection
