@extends('includes.layout')

@section('content')
    <div class="table_container tabletransform1 contact_info">
        <form action="{{ route('flat.storeFlats') }}" method="POST">
            @csrf
        <table id="table">
            <thead>
                <tr>
                    <th colspan="2"><i class="fa-regular fa-envelope"></i>Buto Nr.</th>
                    <th colspan="2"><i class="fa-solid fa-mobile-screen-button"></i>Buto kvadratūra</th>
                    <th colspan="2"><i class="fa-solid fa-exclamation"></i>Gyvatuko mokamas procentas</th>
                    <th colspan="1"><i class="fa-solid fa-exclamation"></i>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                <div>

                        <tr>
                            <td colspan="2"><input type="text" name="inputs[0][flat_nr]" id=""></td>
                            <td colspan="2"><input type="text" name="inputs[0][flat_size]" id=""></td>
                            <td colspan="2"><input type="text" name="inputs[0][gyv_mok_suma]" id=""></td>
                            <input type="text" name="inputs[0][invitation]" value="{{ $houseID }}" id="invitation" hidden>
                            <input type="text" name="inputs[0][house_id]" value="{{ $houseID }}" id="house_id" hidden>
                            <td colspan="1">
                                <div class="flex-container">

                                    <button class="btn_medium btn_edit" type="button" name="add"
                                        id="add">Prideti</button>

                                </div>
                            </td>
                        </tr>

                </div>

            </tbody>
            <button class="btn_medium btn_edit" type="submit">Issaugoti</button>
        </form>
        </table>

    </div>
@endsection
