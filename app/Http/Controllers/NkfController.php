<?php

namespace App\Http\Controllers;

use App\Models\Nkf;
use App\Models\House;
use App\Http\Requests\StoreNkfRequest;
use App\Http\Requests\UpdateNkfRequest;

class NkfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nkf = Nkf::sortable()->get();
        // $nkfHouse = $nkf->house_id;
        // foreach ($nkfs as $nkf){
        //     $nkf->houseAddress = House::where('id',$nkf->house_id)->get('address');
        //     $nkf->houseNr= House::where('id',$nkf->house_id)->get('house_nr');
        // }
        // dd($nkf);
        return view ('nkf.index',['nkf'=>$nkf]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $houses=House::all();
        return view('nkf.create',['houses'=>$houses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNkfRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNkfRequest $request)
    {
        $nkf = new nkf();
        $nkf->house_id=request('house_id');
        $nkf->description=request('description');
        $nkf->type=request('type');
        $nkf->amountPayed=request('amountPayed');
        $nkf->save();
        return redirect()->route('nkf.index')->with('good_message', 'Dėkui, Jūs sėkmingai pridėjote NKF įrašą');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nkf  $nkf
     * @return \Illuminate\Http\Response
     */
    public function show(Nkf $nkf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nkf  $nkf
     * @return \Illuminate\Http\Response
     */
    public function edit(Nkf $nkf)
    {
        $houses=House::all();
        return view('nkf.edit',['houses'=>$houses, 'nkf'=>$nkf]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNkfRequest  $request
     * @param  \App\Models\Nkf  $nkf
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNkfRequest $request, Nkf $nkf)
    {

        $nkf->house_id=$request->house_id;
        $nkf->description=$request->description;
        $nkf->type=$request->type;
        $nkf->amountPayed=$request->amountPayed;
        $nkf->save();
        return redirect()->route('nkf.index')->with('good_message', 'Dėkui, Jūs sėkmingai redagavote įrašą');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nkf  $nkf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nkf $nkf)
    {
        $nkf->delete();
        return redirect()->route('nkf.index')->with('good_message', 'Sėkmingai ištrynėte įrašą');
    }
}
