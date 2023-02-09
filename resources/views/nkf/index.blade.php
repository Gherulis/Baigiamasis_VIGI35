@extends('includes.layout')

@section('content')

        <div class="table_container filter">
            <form action="{{ route('nkf.index') }}" method="GET">
                <table>
                    <thead>
                        <tr>

                            <th>Namo sukaupta suma : {{ $nkfs->totalSaved }} Eur</th>
                            <th>Planuojamų darbų suma: {{ $nkfs->totalPlanned }} Eur</th>

                            <th><label for="filter">Adresas : </label>
                                <select name="filter" id="" value="{{ request()->input('filter') }}">
                                    @foreach ($filterData as $filter)

                                        <option value="{{ $filter->id}}"
                                            {{ request()->input('filter') == $filter->id ? 'selected' : '' }}>
                                            {{ $filter->address }} g. {{ $filter->house_nr }}

                                        </option>
                                 @endforeach

                                </select>
                            <th><button class="btn_medium btn_edit" type="submit">Filtruoti</button></th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>



    <div class="table_container tabletransform1 nkfInfo">

        <table>
            <thead>
                <tr>
                    <th colspan='8'>
                        <p class="mssg">{{ session('mssg') }}{{ session('mssg_edit') }}</p>
                    </th>
                    <th colspan="2">
                        @can('nkf-create')
                        <a href="{{ route('nkf.create') }}">
                            <button class="btn_medium btn_create"><iclass="fa-regular fa-pen-to-square"></i>Pridėti</button>
                        </a>
                        @endcan
                    </th>
                </tr>
                <tr>
                    <th colspan="1"><i class="fa-thin fa-hashtag"></i>@sortablelink('id', 'ID')</th>
                    <th colspan="1"><i class="fa-solid fa-house"></i>@sortablelink('house_id', 'Namas')</th>
                    <th colspan="5"><i class="fa-solid fa-regular fa-comment"></i>@sortablelink('description', 'Aprašymas')</th>
                    <th colspan="1"><i class="fa-solid fa-right-left"></i>@sortablelink('type', 'Tipas')</th>
                    <th colspan="1"><i class="fa-solid fa-money-bill-wave"></i>@sortablelink('amountPayed', 'Suma')</th>
                    <th colspan="1"><i class="fa-solid fa-globe"></i>Veiksmai</th>
                </tr>
            </thead>
            <tbody>

                @if ($nkfs->count() > 0)
                @foreach ($nkfs as $nkf)
                    <div>
                        <tr>
                            <td colspan="1">{{ $nkf->id }}</td>
                            <td colspan="1"> {{ $nkf->address }} g. {{ $nkf->house_nr }} </td>
                            <td colspan="5">{{ $nkf->description }}</td>
                            <td colspan="1">{{ $nkf->type }} </td>
                            <td colspan="1">{{ $nkf->amountPayed }} Eur</td>
                            <td colspan="1">
                                <div class="flex-container">
                                    @can('nkf-edit')
                                    <a href="{{ route('nkf.edit', $nkf) }}">
                                        <button class="btn_small btn_edit" type="submit" title="Redaguoti butą"><i
                                                class="fa-solid fa-pen-clip"></i></button>
                                    </a>
                                    @endcan
                                    @can('nkf-delete')
                                    <form action="{{ route('nkf.destroy', $nkf) }}" method="POST">
                                        @csrf
                                        <button data-title="{{ $nkf }}" type="submit"
                                            class="btn_small btn_delete" title="Ištrinti butą" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" value="{{ $nkf }}">
                                            <i class="fa-solid fa-trash-can red"></i>
                                        </button>
                                    @endcan
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </div>
                @endforeach
                @else
                <tr>
                    <td colspan="10">Įrašų nėra</td>
                </tr>
                @endif
            </tbody>
        </table>
        {{-- <div class="center">{{$nkf->appends(\Request::except('page'))->links()}} </div> --}}
    </div>
@endsection
