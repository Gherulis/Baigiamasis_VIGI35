
@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">

        <table >

            <thead>

                <tr>
                    <th colspan='6'><p class="mssg">{{session('mssg')}}{{session('mssg_edit')}}</p></th>

                    <th colspan="2"><a href="{{route('flat.create')}}"><button class="btn_medium btn_create"><i class="fa-regular fa-pen-to-square"></i>Pridėti</button></a></th>



            </tr>
                <tr>

                <th colspan="1"><i class="fa-solid fa-person"></i>@sortablelink('id', 'ID')</th>
                <th colspan="2"><i class="fa-regular fa-envelope"></i>@sortablelink('flat_nr', 'Buto Nr.')</th>
                <th colspan="2"><i class="fa-solid fa-mobile-screen-button"></i>@sortablelink('flat_size', 'Buto kvadratūra')</th>
                <th colspan="2"><i class="fa-solid fa-exclamation"></i>@sortablelink('gyv_mok_suma','Gyvatuko mokamas procentas')</th>
                <th colspan="1"><i class="fa-solid fa-exclamation"></i>Veiksmai</th>
                </tr>



            </thead>
            <tbody>


                    @foreach ( $flat as $butas )
                       <div>
                        <tr>
                            <td colspan="1">{{$butas->id}}</td>
                            <td colspan="2">Butas : {{$butas->flat_nr}} Nr.</td>
                            <td colspan="2">{{$butas->flat_size}}</td>
                            <td colspan="2">{{$butas->gyv_mok_suma}} %</td>
                            <td colspan="1">
                                <div class="flex-container">
                                    <a href="{{route('flat.edit',$butas)}}">
                                        <button class="btn_small btn_edit"  type="submit"><i class="fa-solid fa-pen-clip"></i></button>
                                    </a>

                                    <form action="{{route('flat.destroy',$butas)}}" method="POST">
                                        @csrf
                                        <button data-title="{{ $butas }}" type="button" class="btn_small btn_delete" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{ $butas }}">
                                            <i class="fa-solid fa-trash-can red"></i>
                                          </button>
                                    </form>
                                </div>
                            </td>


                        </tr>

                       </div>
                    @endforeach





            </tbody>
        </table>
        <div class="center">{{$flat->appends(\Request::except('page'))->links()}} </div>
    </div>
    @extends('flat.modals')
@endsection
