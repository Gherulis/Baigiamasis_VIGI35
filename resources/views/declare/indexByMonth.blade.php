@extends('includes.layout')

@section('content')


   <div class="table_container tabletransform1 contact_info">
        <table class="lentele">
            <thead>
                <tr>
                    <td colspan="8">Vandens deklaravimasa</td>
                </tr>
                <tr>
                    <td colspan="8">
                        <form action="{{route('month.index')}}" method="get", enctype="multipart/form-data">
                            @csrf
                        <select name="house" id="">
                            @foreach ($houses  as $house)
                            <option value="{{ $house->id }}">{{ $house -> address }} g. {{ $house -> house_nr }}</option>
                            @endforeach
                        </select>
                        <select name="date" id="">
                            @foreach ($declareWater  as $declareWater)
                            <option value="{{ $declareWater->formatedDate }}">{{ $declareWater->formatedDate }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn_edit">Redaguoti</button>
                    </form>
                    </td>
                </tr>


            </thead>
            <tbody>
                <tr>

                    <td>Buto Nr.</td>
                    <td>Virtuvė šaltas</td>
                    <td>Virtuvė karštas</td>
                    <td>Vonia šaltas</td>
                    <td>Vonia karštas</td>
                    <td>Vartotojas</td>
                    <td colspan="2">Veiksmai</td>


                </tr>
              @foreach ($flats as $flat )
                  <tr>

                    <td> {{ $flat->flat_nr }}</td>
                    <td>{{ $flat->kitchen_cold }} m<sup>3</sup></td>
                    <td>{{ $flat->kitchen_hot }} m<sup>3</sup></td>
                    <td>{{ $flat->bath_cold }} m<sup>3</sup></td>
                    <td> {{ $flat->bath_hot }}m<sup>3</sup></td>
                    <td colspan="2"></td>

                    <td> </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>

@endsection
