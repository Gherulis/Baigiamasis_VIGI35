<?php

namespace App\Http\Controllers;

use App\Models\house;
use App\Models\Nkf;
use App\Models\flat;
use App\Models\user;
use App\Models\Role;
use App\Http\Requests\StorehouseRequest;
use App\Http\Requests\UpdatehouseRequest;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{    public function __construct(){
    $this->middleware('permission:house-view', ['only'=>['index']]);
    $this->middleware('permission:house-create', ['only'=>['create','store']]);
    $this->middleware('permission:house-edit', ['only'=>['edit','update']]);
    $this->middleware('permission:house-delete', ['only'=>['destroy']]);
    $this->middleware('permission:house-show', ['only'=>['show']]);
    $this->middleware('permission:house-showUserHouse', ['only'=>['showUserHouse']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {   $title='Visi namai';
        $houses=house::with('houseFlat')->with('pricelists')->get();
        foreach ($houses as $house){

            $house->nkfIplaukuSuma = Nkf::where('house_id', $house->id)->where('type','iplaukos')->sum('amountPayed');
            $house->nkfIslaiduSuma = Nkf::where('house_id', $house->id)->where('type','islaidos')->sum('amountPayed');
            $house->nkfPlanuSuma = Nkf::where('house_id', $house->id)->where('type','planas')->sum('amountPayed');
            $house->nkfSukaupta = $house->nkfIplaukuSuma-$house->nkfIslaiduSuma;
            $house->pirmininkasName = user::where('id',$house->admin_id)->pluck('name')->first();
            $house->pirmininkasEmail = user::where('id',$house->admin_id)->pluck('email')->first();
        };

        return view ('house.index',['houses' =>$houses, 'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $title='Sukurti nama';
        $houseAdmins= User::role('Pirmininkas')->get();


        return view('house.create',['title'=>$title, 'houseAdmins'=>$houseAdmins]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorehouseRequest $request)
    {           $title='Sukurti butus';
                $request->validate([
                'address'=> 'required|min:4|string',
                'house_nr'=>'required|min:1|max:999|integer',
                'city'=>'required|min:3|string',
                'house_size'=>'required|numeric|between:0,19999.99',
                ],[],[
                    'address'=>'gatvės pavadinimas',
                    'house_nr'=>'namo numeris',
                    'city'=>'miestas',
                    'house_size'=>'namo kvadratūra',
                ]);


                $house = new house ();
                $house->address = request('address');
                $house->house_nr= request('house_nr');
                $house->city = request('city');
                $house->house_size = request('house_size');
                $house->admin_id = request('houseAdmin');
                $house->save();


                return redirect()->route('flat.createFlats',['title'=>$title])->with('good_message', 'Naujas namas sėkmingai pridėtas !!! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\house  $house
     * @return \Illuminate\Http\Response
     */
    public function show(house $house)
    {
        $house =house::where('id',$house)->get();
        $house->nkfIplaukuSuma = Nkf::where('house_id', $house->id)->where('type','iplaukos')->sum('amountPayed');
        $house->nkfIslaiduSuma = Nkf::where('house_id', $house->id)->where('type','islaidos')->sum('amountPayed');
        $house->nkfPlanuSuma = Nkf::where('house_id', $house->id)->where('type','planas')->sum('amountPayed');
        $house->nkfSukaupta = $house->nkfIplaukuSuma-$house->nkfIslaiduSuma;
        return view ('house.show', ['house' => $house]);
    }

    public function showUserHouse(house $house)
    {   $userFlat=flat::where('id',auth::user()->flat_id)->first();
         $house=house::where('id',$userFlat->house_id)->with('houseFlat')->with('pricelists')->first();
         $house->nkfIplaukuSuma = Nkf::where('house_id', $house->id)->where('type','iplaukos')->sum('amountPayed');
         $house->nkfIslaiduSuma = Nkf::where('house_id', $house->id)->where('type','islaidos')->sum('amountPayed');
         $house->nkfPlanuSuma = Nkf::where('house_id', $house->id)->where('type','planas')->sum('amountPayed');
         $house->nkfSukaupta = $house->nkfIplaukuSuma-$house->nkfIslaiduSuma;
        $title='Vartotojo namas';
        $house->pirmininkasName = user::where('id',$house->admin_id)->pluck('name')->first();
        $house->pirmininkasEmail = user::where('id',$house->admin_id)->pluck('email')->first();

        return view ('house.userHouse', ['house' => $house, 'title'=>$title]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\house  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(house $house)
    {   $title = 'Redaguoti nama';
        $houseAdmins= User::role('Pirmininkas')->get();
        return view ('house.edit',['house'=>$house, 'title'=>$title,'houseAdmins'=>$houseAdmins]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatehouseRequest  $request
     * @param  \App\Models\house  $house
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatehouseRequest $request, house $house)
    {      $request->validate([
        'address'=> 'required|min:4|string',
        'house_nr'=>'required|min:1|max:999|integer',
        'city'=>'required|min:3|string',
        'house_size'=>'required|numeric|between:0,19999.99',
        ],[],[
            'address'=>'gatvės pavadinimas',
            'house_nr'=>'namo numeris',
            'city'=>'miestas',
            'house_size'=>'namo kvadratūra',
        ]);

        $house->address = $request->address;
        $house->house_nr= $request->house_nr;
        $house->city = $request->city;
        $house->house_size = $request->house_size;
        $house->admin_id = $request->houseAdmin;
        $house->save();

        return redirect()->route('house.index')->with('good_message', 'Sėkmingai redaguotas namas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\house  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(house $house)
    {
        $house -> delete();
        return redirect()->route('house.index')->with('good_message', 'Dėkui, Jūs sėkmingai ištrynėte namą!');
    }
}
