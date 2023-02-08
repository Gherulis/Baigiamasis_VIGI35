@extends('includes.layout')



@section('content')
    <section>
        <div class="news-button">
            @can('post-create')
                <a href="{{ route('post.create') }}"><button class="btn_medium btn_edit FloatRight"> Naujas Skelbimas</button></a>
            @endcan
        </div>
        <div class="news-container">

            @foreach ($posts as $post)
                <div class="news-item">
                        <p class="newsHeader">{{ $post->postName }}</p>
                        <hr>
                        <div> <img class="newsPhoto" src="/storage/cover_images/{{ $post->postImage }}" alt="IMG"></div>
                        <div>
                            <p class="newsText">{{ substr($post->postBody, 0, 300) }}</p>
                        </div>
                        <hr>
                        <div>
                            <small><a href="{{ $post->postLink }}">Šaltinis {{substr( $post->postLink,0,35) }}</a></small>
                            <br>
                            <small>Ikelta {{ $post->created_at }}</small>
                            @can('post-show')
                                <a  href="{{ route('post.show', $post) }}"><button class="btn_medium btn_edit FloatRight">Skaityti</button></a>
                            @endcan
                        </div>

                </div>
            @endforeach



        </div>



    </section>
@endsection
