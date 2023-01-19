
@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">

        <table >

            <thead>

                <tr>
                    <th colspan='8'><p class="mssg">{{session('mssg')}}{{session('mssg_edit')}}</p></th>

                    <th colspan="2"><a href="{{route('contacts.create')}}"><button class="btn_new"><i class="fa-regular fa-pen-to-square"></i>Pridėti</button></a></th>



            </tr>
                <tr>

                <th colspan="1"><i class="fa-solid fa-person"></i>ID</th>
                <th colspan="2"><i class="fa-regular fa-envelope"></i>Buto Numeris</th>
                <th colspan="2"><i class="fa-solid fa-mobile-screen-button"></i>Buto Dydis</th>
                <th colspan="2"><i class="fa-solid fa-exclamation"></i>Gyvatuko Mokama Suma</th>
                <th colspan="3"><i class="fa-solid fa-exclamation"></i>Veiksmai</th>
                </tr>



            </thead>
            <tbody>


                    @foreach ( $flat as $flat )
                       <div>
                        <tr>
                            <td colspan="1">{{$flat->id}}</td>
                            <td colspan="2">Butas : {{$flat->flat_id}} Nr.</td>
                            <td colspan="2">{{$flat->flat_size}}</td>
                            <td colspan="2">{{$flat->gyv_mok_suma}} %</td>
                            <td colspan="3"></td>


                        </tr>

                       </div>
                    @endforeach





            </tbody>
        </table>

    </div>

@endsection
