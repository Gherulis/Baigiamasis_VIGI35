<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateuserRequest;
use App\Models\User;
use App\Models\House;
use App\Models\flat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

//Adresas
//kai reikia kintamuju
//use App\Models\Adresas;

//is kito modelio pvz reikia kazkokio vis metoda
// kita controleri



use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $user = User::where('id', '!=', auth()->user()->id)->where('id', '!=',1)->with('usersFlat.belongsHouse')->get();


        return view('user.index',['user' => $user ]);
    }


public function show(){

        $flat_id = Auth::user()->flat_id;
        $flats = flat::with('belongsHouse')->with('flatUsers')->findorfail($flat_id);






        return view('user.show', ['flats' => $flats]);
    }
    public function create(){
             $roles = Role::all()->skip(1);
             $flats = flat::with('belongsHouse')->get();

             return view('user.create', ['roles'=>$roles,'flats'=>$flats]);
    }
    public function store(request $request){

        $user = new User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = Hash::make($request->password);
        $user -> flat_id = $request->flat_id;
        $user -> save();

        $user->assignRole($request->role);
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai sukurtas!');



        return view('user.show', ['flats' => $flats]);
    }
    public function destroy(user $user)
    {

        $user->delete();
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai ištrintas!');
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
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai redaguotas!');;
    }

}
