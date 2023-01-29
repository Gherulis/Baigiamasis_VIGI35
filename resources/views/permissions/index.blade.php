
@extends('includes.layout')

@section('content')



   <div class="table_container tabletransform1 contact_info">

        <table >

            <thead>

                <tr>


                    <th colspan="4" class="right"><a href="{{route('permissions.create')}}"><button class="btn_medium btn_create"><i class="fa-regular fa-pen-to-square"></i>Sukurti</button></a></th>



            </tr>
                <tr>

                <th><i class="fa-solid fa-hashtag"></i>Id</th>
                <th><i class="fa-regular fa-eye"></i>Teisė</th>
                <th><i class="fa-solid fa-shield-dog"></i>Guard</th>
                <th><i class="fa-solid fa-exclamation"></i>Veiksmai</th>

                </tr>



            </thead>
            <tbody>


                    @foreach ( $permissions as $permission )
                       <div>
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->guard_name}}</td>

                            <td >
                                <div class="flex-container">

                                <a href="{{route('permissions.show', $permission->id)}}"><button class="btn_small btn_show" type="submit"><i class="fa-regular fa-eye"></i></button></a>

                                @can('permission-edit')
                                <a href="{{route('permissions.edit', $permission->id)}}"><button class="btn_small btn_edit" type="submit"><i class="fa-solid fa-pen-clip"></i></button></a>
                                @endcan
                                @can('permission-delete')
                                <form action="{{route('permissions.destroy',$permission->id)}}" method="POST">
                                    @csrf
                                    <button class="btn_small btn_delete" value="submit"><i class="fa-solid fa-trash-can red"></i></button>
                                </form>
                                @endcan
                            </div>
                            </td>


                        </tr>

                       </div>
                    @endforeach





            </tbody>
        </table>

    </div>


@endsection
