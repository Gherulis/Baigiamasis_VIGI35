<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateuserRequest;
use App\Models\User;
use App\Models\House;
use App\Models\flat;
use Illuminate\Support\Facades\Auth;
//Adresas
//kai reikia kintamuju
//use App\Models\Adresas;

//is kito modelio pvz reikia kazkokio vis metoda
// kita controleri



use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::all();


        return view('user.index',['user' => $user ]);
    }


public function show(){

        $flat_id = Auth::user()->flat_id;
        $flats = flat::with('belongsHouse')->with('flatUsers')->findorfail($flat_id);






        return view('user.show', ['flats' => $flats]);
    }

    public function destroy(user $user)
    {

        $user->delete();
        return redirect()->route('user.index');
}
public function edit(user $user)
    {
        return view('user.edit', ['user' => $user]);
    }


    public function update(UpdateuserRequest $request,user $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        return redirect()->route('user.index')->with('mssg_edit', 'Įrašas sėkmingai redaguotas');
    }

}
