@extends('includes.layout')



@section('content')
<div class="table_container">

    <table>
        <thead>
            <tr>
            <th colspan="9">Planuojami darbai</th>
            <tr>
                <th colspan="7">Aprašymas</th>
                <th colspan="1">Numatyta kaina</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($nkfLastFive as $lastFive)
            <tr>
                <td colspan="7">{{ $lastFive->description }}</td>
                <td colspan="1">{{ $lastFive->amountPayed }} Eur,</td>
                <td  colspan="1">
                <div class="flex-container">
                <form action="{{route('nkf.updateLikes', ['nkf'=>$lastFive])}}" method="POST">
                    @csrf
                    <input type="hidden" name="vote_type" value="like">
                   <button name="like_vote" class="btn_small btn_edit" type="submit" value="1"><i class="fa fa-thumbs-up"></i><sup>{{ $lastFive->likes }}</sup></button>
                </form>
                <form action="{{route('nkf.updateLikes', ['nkf'=>$lastFive])}}" method="POST">
                        @csrf
                    <input type="hidden" name="vote_type" value="dislike">

                        <button name="dislike_vote" class="btn_small btn_delete" type="submit" value="1"><i class="fa fa-thumbs-down"></i><sub>{{ $lastFive->dislikes }}</sub></button></td>
                </form>
                </div>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>

    <section>

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
