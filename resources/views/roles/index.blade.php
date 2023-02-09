@extends('includes.layout')

@section('content')
    <div class="table_container tabletransform1 roleInfo">
        <table>
            <thead>
                <tr>
                    <th colspan="3" class="right"><a href="{{ route('roles.create') }}">
                        @can('role-create')
                        <button class="btn_medium btn_create"><i class="fa-regular fa-pen-to-square"></i>Sukurti rolę</button></a>
                        @endcan
                    </th>
                </tr>
                <tr>
                    <th><i class="fa-solid fa-hashtag"></i>Id</th>
                    <th><i class="fa-regular fa-eye"></i>Pavadinimas</th>
                    <th><i class="fa-solid fa-exclamation"></i>Veiksmai</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($roles as $role)
                    <div>
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="flex-container">
                                    @can('role-view')
                                    <a href="{{ route('roles.show', $role->id) }}"><button class="btn_small btn_show"
                                            type="submit"><i class="fa-regular fa-eye"></i></button></a>
                                    @endcan
                                    @can('role-edit')
                                        <a href="{{ route('roles.edit', $role->id) }}"><button class="btn_small btn_edit"
                                                type="submit"><i class="fa-solid fa-pen-clip"></i></button></a>
                                    @endcan
                                    @can('role-delete')
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            <button class="btn_small btn_delete" value="submit"><i
                                                    class="fa-solid fa-trash-can red"></i></button>
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
