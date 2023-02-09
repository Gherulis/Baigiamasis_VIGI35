
@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 userInfo">

        <table >

            <thead>
                <tr>
                <th colspan="7" class="right">
                    <a href="{{route('user.create')}}">
                        @can('user-create')
                        <button class="btn_medium btn_create">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Sukurti vartotoją
                        </button>
                        @endcan
                    </a>
                </th>
                </tr>

                <tr>
                <th>ID</th>
                <th><i class="fa-solid fa-person"></i>Vardas</th>
                <th><i class="fa-regular fa-envelope"></i>El.Pastas</th>
                <th><i class="fa-solid fa-house"></i>Adresas</th>
                <th><i class="fa-solid fa-suitcase"></i>Buto Nr.</th>
                <th><i class="fa-solid fa-palette"></i>Rolė</th>
                <th><i class="fa-solid fa-plane"></i>Veiksmai</th>
                </tr>



            </thead>
            <tbody>


                    @foreach ( $user as $user )
                       <div>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ $user->usersFlat->belongsHouse->address }} g. {{ $user->usersFlat->belongsHouse->house_nr }}</td>
                            <td>Butas : {{$user->flat_id}}</td>

                            <td>
                                @if(isset( $user->roles->pluck('name')[0]))
                                {{ $user->roles->pluck('name')[0] }}</td>
                                @endif
                            <td >
                                <div class="flex-container">
                                @can('user-show')
                                <a href="{{route('user.show', $user)}}"><button class="btn_small btn_show" type="submit"><i class="fa-regular fa-eye"></i></button></a>
                                @endcan
                                @can('user-edit')
                                <a href="{{route('user.edit', $user)}}"><button class="btn_small btn_edit" type="submit"><i class="fa-solid fa-pen-clip"></i></button></a>
                                @endcan
                                @can('user-delete')
                                <form action="{{route('user.destroy',$user)}}" method="POST">
                                    @csrf

                                    <button class="btn_small btn_delete" value="submit"><i class="fa-solid fa-trash-can red"></i></button>
                                    @endcan
                                </form>
                            </div>
                            </td>


                        </tr>

                       </div>
                    @endforeach





            </tbody>
        </table>

    </div>


@endsection
