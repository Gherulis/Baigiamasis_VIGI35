<?php

namespace App\Http\Controllers;

use App\Models\house;
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
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $house=house::with('houseFlat')->with('pricelists')->get();
        // $getData=$house->pricelists->last()->created_at;
        // $last_house_bill = Carbon::parse($getData)->format('Y', 'F');
        return view ('house.index',['house' =>$house,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorehouseRequest $request)
    {           $request->validate([
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
                $house->save();


                return redirect()->route('flat.createFlats')->with('good_message', 'Naujas namas sėkmingai pridėtas !!! ');
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
        return view ('house.show', ['house' => $house]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\house  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(house $house)
    {
        return view ('house.edit',['house'=>$house]);
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
