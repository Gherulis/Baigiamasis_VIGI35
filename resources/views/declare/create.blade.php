@extends ('includes.layout')
@section('content')

    <div class="table_container tabletransform1 decl">
        <h3>Buto Nr. - {{ Auth::user()->flat_id }}</h3>

        <table>
            <thead>
                <tr>
                    <td>Virtuvė</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>


                </tr>
                <tr>

                    <td></td>
                    <td>Nuo</td>
                    <td></td>
                    <td>Iki</td>
                    <td></td>
                    <td>Skirtumas</td>
                    <td></td>

                </tr>


            </thead>
            <form action="{{ route('declare.store') }}" method="POST">
                @csrf
                <tbody>
                    <tr>

                        <td>Šaltas</td>
                        <td name="old_value">{{ $lastData->kitchen_cold }}</td>
                        <td class="hidn">m<sup>3</sup></td>
                        <td><input type="number" name="new_kitchen_cold"></td>
                        <td class="hidn">m<sup>3</sup></td>
                        <td name="result">Hmm</td>
                        <td class="hidn">m<sup>3</sup></td>
                        <input type="number" name="flat_id" value="{{ Auth::user()->flat_id }}" hidden>
                        <input type="text" name="declaredBy" value="{{ Auth::user()->name }}" hidden>
                    </tr>
                    <tr>
                        <td>Karštas</td>
                        <td>{{ $lastData->kitchen_hot }}</td>
                        <td class="hidn">m<sup>3</sup></td>
                        <td><input type="number" name="kitchen_hot"></td>
                        <td class="hidn">m<sup>3</sup></td>
                        <td>Skirtumas</td>
                        <td class="hidn">m<sup>3</sup></td>
                    </tr>
        </table>
    </div>

    <div class="table_container tabletransform1 decl decl1">
        <table>
            <thead>
                <tr>
                    <td>Vonia</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>



                </tr>
                <tr>

                    <td></td>
                    <td>Nuo</td>
                    <td></td>
                    <td>Iki</td>
                    <td></td>
                    <td>Skirtumas</td>
                    <td></td>

                </tr>


            </thead>
            <tbody>
                <tr>
                    <td>Šaltas</td>
                    <td>{{ $lastData->bath_cold }}</td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td><input type="number" name="bath_cold"></td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td>Skirtumas</td>
                    <td class="hidn">m<sup>3</sup></td>
                </tr>
                <tr>
                    <td>Karštas</td>
                    <td>{{ $lastData->bath_hot }}</td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td><input type="number" name="bath_hot"></td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td>Skirtumas</td>
                    <td class="hidn">m<sup>3</sup></td>
                </tr>
        </table>
    </div>
    <div class="client"><button class="btn-pateikti btn">Pateikti</button></div>
    </form>
    <script src="/public/js/declare-ajax.js"></script>
@endsection
