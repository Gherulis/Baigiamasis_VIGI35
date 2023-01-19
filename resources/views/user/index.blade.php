
@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">

        <table >

            <thead>

                <tr>
                    <th colspan='4'><p class="mssg">{{session('mssg')}}{{session('mssg_edit')}}</p></th>

                    <th><a href="{{route('contacts.create')}}"><button class="btn_new"><i class="fa-regular fa-pen-to-square"></i>Pridėti</button></a></th>



            </tr>
                <tr>
                <th>ID</th>
                <th><i class="fa-solid fa-person"></i>Vardas</th>
                <th><i class="fa-regular fa-envelope"></i>El.Pastas</th>
                <th><i class="fa-solid fa-mobile-screen-button"></i>Buto Nr.</th>
                <th><i class="fa-solid fa-mobile-screen-button"></i>Veiksmai</th>
                </tr>



            </thead>
            <tbody>


                    @foreach ( $user as $user )
                       <div>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>Butas : {{$user->flat_id}}</td>
                            <td>
                                <p class="mssg"><a href="{{route('user.edit',$user)}}"><button class="btn btn_edit">Redaguoti</button></a></p>
                                <form action="{{route('user.destroy',$user)}}" method="POST">
                                @csrf
                            <button class="btn btn_delete">Istrinti</button> </form>
                        </td>


                        </tr>

                       </div>
                    @endforeach





            </tbody>
        </table>

    </div>

@endsection
