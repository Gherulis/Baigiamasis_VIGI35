<?php

namespace App\Http\Controllers;

use App\Models\Nkf;
use App\Models\House;
use App\Http\Requests\StoreNkfRequest;
use App\Http\Requests\UpdateNkfRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NkfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {   $filterData = Nkf::join('houses', 'houses.id', '=', 'nkfs.house_id')
        ->select('nkfs.*', 'houses.address', 'houses.house_nr')
        ->get();
        $houseId = request('filter') ? request('filter') : '1' ;
        $nkfs = Nkf::sortable()->where('house_id',$houseId)->join('houses', 'houses.id', '=', 'nkfs.house_id')
        ->select('nkfs.*', 'houses.address', 'houses.house_nr')
        ->get();
        $totalMoney = Nkf::where('house_id',$houseId)->where('type','iplaukos')->get()->sum('amountPayed'); //susiskaiciuoju visas iplaukas
        $totalSpendings = Nkf::where('house_id',$houseId)->where('type','islaidos')->get()->sum('amountPayed'); //susiskaiciuoju visas islaidas
        $nkfs->totalPlanned = Nkf::where('house_id',$houseId)->where('type','Planuojamos išlaidos')->get()->sum('amountPayed'); //susiskaiciuoju visas planuojamas islaidas
        $nkfs->totalSaved = $totalMoney - $totalSpendings; // susiskaiciuoju likuti is sukauptu atimu islaidas

        return view('nkf.index', compact('nkfs','filterData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $houses=House::all();
        return view('nkf.create',['houses'=>$houses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNkfRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNkfRequest $request)
    {   $request->validate([

        'house_id'=>'required',
        'description'=>'required|min:4|string|',
        'type'=>'required',
        'amountPayed'=>'required|min:1|numeric|between:0,19999.99',


        ],[],[

            'house_id'=>'šaltas vanduo',
            'description'=>'aprašymas',
            'type'=>'tipas',
            'amountPayed'=>'pinigų suma',

        ]);
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
    { $request->validate([

        'house_id'=>'required',
        'description'=>'required|min:4|string|',
        'type'=>'required',
        'amountPayed'=>'required|min:1|numeric|between:0,19999.99',


        ],[],[

            'house_id'=>'šaltas vanduo',
            'description'=>'aprašymas',
            'type'=>'tipas',
            'amountPayed'=>'pinigų suma',

        ]);

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
