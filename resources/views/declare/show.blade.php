@extends ('includes.layout')
@section('content')
    <div class="client">

    <!-- <h3>Buto Nr : 3</h3> -->
</div>

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
            <form action="{{route('declare.store')}}" method="POST">
                @csrf
            <tbody>
                <tr>

                    <td>Šaltas</td>
                    <td >{{$lastData->kitchen_cold}}</td>
                    <input type="number" name="flat" value="{{ Auth::user()->flat_id }}" hidden>
                    <input type="text" name="declaredBy" value="{{ Auth::user()->name }}" hidden>
                    <td class="hidn">m<sup>3</sup></td>
                    <td><input type="number" name="kitchen_cold" ></td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td>Hmm</td>
                    <td class="hidn">m<sup>3</sup></td>
                </tr>
                <tr>
                    <td>Karštas</td>
                    <td>{{$lastData->kitchen_hot}}</td>
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
                    <td>{{$lastData->bath_cold}}</td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td><input type="number" name="bath_cold"></td>
                    <td class="hidn">m<sup>3</sup></td>
                    <td>Skirtumas</td>
                    <td class="hidn">m<sup>3</sup></td>
                </tr>
                <tr>
                    <td>Karštas</td>
                    <td>{{$lastData->bath_hot}}</td>
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


 @endsection
