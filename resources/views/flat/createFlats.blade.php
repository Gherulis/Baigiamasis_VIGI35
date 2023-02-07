@extends('includes.layout')

@section('content')
    <div class="table_container tabletransform1 contact_info">
        <form action="{{ route('flat.storeFlats') }}" method="POST">
            @csrf
        <table id="table">
            <thead>
                <tr>
                    <th colspan="7"></th>
                    <th><div><button class="btn_medium btn_edit" type="submit">Išsaugoti</button></div></th>
                </tr>
                <tr>
                    <th><i class="fa-regular fa-hashtag"></i>Nr.</th>
                    <th colspan="2"><i class="fa-solid fa-suitcase"></i>Buto Nr.</th>
                    <th colspan="2"><i class="fa-solid fa-cube"></i>Buto kvadratūra</th>
                    <th colspan="2"><i class="fa-solid fa-staff-snake"></i>Gyvatuko mokamas procentas</th>
                    <th colspan="1"><i class="fa-solid fa-list-check"></i>Veiksmai</th>
                </tr>
            </thead>
            <tbody>

                <div>

                        <tr>
                            <td>1</td>
                            <td colspan="2">Nr. <input type="text" name="inputs[0][flat_nr]" value="1" class="textCenter"></td>
                            <td colspan="2"><input type="text" name="inputs[0][flat_size]" class="textCenter"> m<sup>2</sup></td>
                            <td colspan="2"><input type="text" name="inputs[0][gyv_mok_suma]" value="100" class="textCenter"> %</td>
                            <input type="text" name="inputs[0][invitation]" value="{{ $random_number }}" id="invitation" hidden>
                            <input type="text" name="inputs[0][house_id]" value="{{ $houseID }}" id="house_id" hidden >
                            <td colspan="1">
                                <div class="flex-container">

                                    <button class="btn_medium btn_edit" type="button" name="add"
                                        id="add"><i class="fa-solid fa-plus"></i> Prideti</button>

                                </div>
                            </td>
                        </tr>

                </div>

            </tbody>

        </form>
        </table>

    </div>



@endsection
