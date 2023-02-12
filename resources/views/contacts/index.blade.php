@extends('includes.layout')

@section('content')
    <div class="table_container tabletransform1 contact_info">

        <table>
            <thead>
                <tr>
                    <th colspan="9" class="right"><a href="{{ route('contacts.create') }}"><button
                                class="btn_medium btn_create" title="Pridėti naują kontaktą"><i
                                    class="fa-regular fa-pen-to-square"></i>Pridėti</button></a></th>
                </tr>
                <tr>
                    <th colspan="2"><i class="fa-solid fa-person"></i>@sortablelink('vardas', 'Vardas')</th>
                    <th colspan="2"><i class="fa-regular fa-envelope"></i>@sortablelink('vardas', 'El.Pastas')</th>
                    <th colspan="2"><i class="fa-solid fa-mobile-screen-button"></i>@sortablelink('tel', 'Telefono Numeris')</th>
                    <th colspan="2"><i class="fa-regular fa-comment"></i>@sortablelink('komentaras', 'Komentaras')</th>
                    <th colspan="1"><i class="fa-solid fa-exclamation"></i>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <div>
                        <tr>
                            <td colspan="2"><a href="{{ route('contact.edit', $contact) }}">{{ $contact->vardas }}</a></td>
                            <td colspan="2">{{ $contact->pastas }}</td>
                            <td colspan="2">{{ $contact->tel }}</td>
                            <td colspan="2">{{ $contact->komentaras }}</td>
                            <td colspan="1">
                                <div class="flex-container just-center">
                                    @can('contacts-edit')
                                    <a href="{{ route('contact.edit', $contact) }}">
                                        <button class="btn_small btn_edit" type="submit" title="Redaguoti kontaktą"><i
                                                class="fa-solid fa-pen-clip"></i></button>
                                    </a>
                                    @endcan

                                    <form action="{{ route('contact.destroy', $contact) }}" method="POST">
                                        @csrf
                                        <button class="btn_small btn_delete" value="submit" title="Trinti kontaktą"><i
                                                class="fa-solid fa-trash-can red"></i></button>
                                    </form>
                                </div>
                            </td>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="center">{{ $contacts->appends(\Request::except('page'))->links() }} </div>
    </div>
@endsection
