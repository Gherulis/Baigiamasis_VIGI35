@extends ('includes.layout')
@section('content')

    <div class="table_container tabletransform1 decl">

        <h3>Buto Nr. - {{ Auth::user()->flat_id }}</h3>

        <table>
            <thead>
                <tr>
                    <td colspan="1" class="left"><strong>Virtuvė</strong> </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nuo</td>
                    <td>Iki</td>
                    <td>Skirtumas</td>
                </tr>


            </thead>
            <form action="{{ route('declare.store') }}" method="POST" id="declare_form">
                @csrf
                <tbody>
                    <tr>
                        <td>Šaltas</td>
                        <td>
                            <input type="text" id="kitchen_cold_before" name="kitchen_cold_before"
                                value="{{ $lastData->kitchen_cold }}" hidden>
                            {{ $lastData->kitchen_cold }} m<sup>3</sup>
                        </td>
                        <td><input type="number" name="kitchen_cold"
                                onkeyup="calculateDifference('kitchen_cold', this.value);"></td>

                        <td name="kitchen_cold_result" id="kitchen_cold_result">0 m<sup>3</sup></td>
                    </tr>
                    <tr>
                        <td>Karštas</td>
                        <td>
                            <input type="text" id="kitchen_hot_before" name="kitchen_hot_before"
                                value="{{ $lastData->kitchen_hot }}" hidden>
                            {{ $lastData->kitchen_hot }} m<sup>3</sup>
                        </td>
                        <td><input type="number" name="kitchen_hot"
                                onkeyup="calculateDifference('kitchen_hot', this.value);"></td>
                        <td name="kitchen_hot_result" id="kitchen_hot_result">0 m<sup>3</sup></td>
                    </tr>
        </table>
    </div>

    <div class="table_container tabletransform1 decl decl1">
        <table>
            <thead>
                <td colspan="1" class="left"><strong>Vonia</strong></td>
                <td colspan="3"></td>
                <tr>
                    <td></td>
                    <td>Nuo</td>
                    <td>Iki</td>
                    <td>Skirtumas</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                <tr>
                    <td>Šaltas</td>
                    <td>
                        <input type="text" id="bath_cold_before" name="bath_cold_before"
                            value="{{ $lastData->bath_cold }}" hidden>
                        {{ $lastData->bath_cold }} m<sup>3</sup>
                    </td>
                    <td><input type="number" name="bath_cold" onkeyup="calculateDifference('bath_cold', this.value);"></td>
                    <td name="bath_cold_result" id="bath_cold_result">0 m<sup>3</sup></td>
                </tr>
                <tr>
                    <td>Karštas</td>
                    <td> <input type="text" id="bath_hot_before" name="bath_hot_before" value="{{ $lastData->bath_hot }}"
                            hidden>
                        {{ $lastData->bath_hot }} m<sup>3</sup></td>
                    <td><input type="number" name="bath_hot" onkeyup="calculateDifference('bath_hot', this.value);"></td>
                    <td name="bath_hot_result" id="bath_hot_result">0 m<sup>3</sup></td>
                </tr>
                <input type="number" name="flat_id" value="{{ Auth::user()->flat_id }}" hidden>
                <input type="text" name="declaredBy" value="{{ Auth::user()->name }}" hidden>
        </table>
    </div>
    <div class="client"><button class="btn-pateikti btn" >Pateikti</button></div>
    </form>




    <script src="{{ asset('js/declare_calc.js') }}" defer></script>
@endsection
