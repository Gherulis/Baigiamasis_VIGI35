<?php

namespace App\Http\Controllers;




use App\Models\pricelist;
use App\Models\flat;
use App\Models\house;
use App\Models\declareWater;
use App\Http\Requests\StorepricelistRequest;
use App\Http\Requests\UpdatepricelistRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ltMonths = [
            'January' => 'Sausis',
            'February' => 'Vasaris',
            'March' => 'Kovas',
            'April' => 'Balandis',
            'May' => 'Gegužė',
            'June' => 'Birželis',
            'July' => 'Liepa',
            'August' => 'Rugpjūtis',
            'September' => 'Rugsėjis',
            'October' => 'Spalis',
            'November' => 'Lapkritis',
            'December' => 'Gruodis',
        ];



        $pricelist = pricelist::orderBy('created_at', 'desc')->get();

        foreach($pricelist as $listitem) {
            $year = Carbon::parse($listitem->created_at)->format('Y');
            $month = Carbon::parse($listitem->created_at)->format('F');
            $month = str_replace(array_keys($ltMonths), array_values($ltMonths), $month);
            $monthName = $year.'-'.$month;
            $listitem->formatedDate =  $monthName;
        }

        return view('pricelist.index',['pricelist' => $pricelist]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $houses = house::all();
        return view('pricelist.create',['houses' => $houses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepricelistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {   $userFlat = Auth::user()->flat_id;
        $houseNr = flat::where('flat_nr',$userFlat)->get('house_id');

        // dd($houses);
        // dd( $houseNr);

        $pricelist = new pricelist ();
        $pricelist->house_id = request('house_nr');
        $pricelist->saltas_vanduo = request('saltas_vanduo');
        $pricelist->karstas_vanduo = request('karstas_vanduo');
        $pricelist->sildymas = request('sildymas');
        $pricelist->silumos_mazg_prieziura = request('silumos_mazg_prieziura');
        $pricelist->gyvatukas = request('gyvatukas');
        $pricelist->salto_vandens_abon = request('salto_vandens_abon');
        $pricelist->elektra_bendra = request('elektra_bendra');
        $pricelist->ukio_islaid = request('ukio_islaid');
        $pricelist->nkf = request('nkf');


        $pricelist->save();
        return redirect ('pricelist/index',)->with('mssg', 'Naujos sumos pridetos');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pricelist = Pricelist::findOrFail($id);
        return view ('pricelist/edit/');}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function edit (pricelist $pricelist)
    {
        return view('pricelist.edit', ['pricelist' => $pricelist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepricelistRequest  $request
     * @param  \App\Models\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepricelistRequest $request,pricelist $pricelist)
    {


        $pricelist->saltas_vanduo = $request->saltas_vanduo;
        $pricelist->karstas_vanduo = $request-> karstas_vanduo;
        $pricelist->sildymas = $request->sildymas;
        $pricelist->silumos_mazg_prieziura = $request->silumos_mazg_prieziura;
        $pricelist->gyvatukas = $request->gyvatukas;
        $pricelist->salto_vandens_abon = $request->salto_vandens_abon;
        $pricelist->elektra_bendra = $request->elektra_bendra;
        $pricelist->ukio_islaid = $request->ukio_islaid;
        $pricelist->nkf = $request->nkf;

        $pricelist->save();
        return redirect()->route('pricelist.index')->with('mssg_edit', 'Įrašas sėkmingai redaguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(pricelist $pricelist)
    {
        //
    }
    public function lastBill()
        // gauti paskutine vandens deklarcija pagal vartotoja
        //is jos minusuoti pries paskutines vandens deklaracijos rodmenis pagal vartotoja
        //pasiimti namo duomenis
        //suskaiciuoti butus is namo valdiklio
        //gauti bendra namo kvadratura
        //pasidaryti mokama procenta kadangi ne visi moka vienodai del kompensaciju
        //gauti kainas uz kv.m
        //pasiimti permokas
        //pasiimti skolas
        //atvaizduoti kiekviena eilute
        //visa tai turi veikti pasirenkant menesi
        //Hmmm ? idomuuuu


{       $flat_nr = flat::findorfail(Auth::user()->flat_id);
        $flats_nr_total = flat::all()->count();
        $flats_total_size = flat::all()->sum('flat_size');
        $flats_total_payable = flat::all()->sum('gyv_mok_suma'); //gyventoju bendras mokamas procentas, kadangi kai kurie turi kompensacijas


        // pasiimti namo bendra plota ir tada paskaidyti sumas pagal buto kvadratura
    {    $ltMonths = [
        'January' => 'Sausis',
        'February' => 'Vasaris',
        'March' => 'Kovas',
        'April' => 'Balandis',
        'May' => 'Gegužė',
        'June' => 'Birželis',
        'July' => 'Liepa',
        'August' => 'Rugpjūtis',
        'September' => 'Rugsėjis',
        'October' => 'Spalis',
        'November' => 'Lapkritis',
        'December' => 'Gruodis',
    ];
    $flatDeclatationTotal = declareWater::where('flat_id', Auth::user()->flat_id)->count();

    $lastFlatDeclaration = declareWater::where('flat_id', Auth::user()->flat_id)
    ->orderBy('created_at', 'desc')
    ->first();
    $oneBeforeLastFlatDeclaration = declareWater::where('flat_id', Auth::user()->flat_id)
    ->orderBy('created_at', 'desc')
    ->skip(1)
    ->first();
    $kitchen_cold_sum = $lastFlatDeclaration->kitchen_cold - $oneBeforeLastFlatDeclaration-> kitchen_cold;
    $kitchen_hot_sum = $lastFlatDeclaration->kitchen_hot - $oneBeforeLastFlatDeclaration-> kitchen_hot;
    $bath_cold_sum = $lastFlatDeclaration->bath_cold - $oneBeforeLastFlatDeclaration-> bath_cold;
    $bath_hot_sum = $lastFlatDeclaration->bath_hot - $oneBeforeLastFlatDeclaration-> bath_hot;


    dd( $bath_cold_sum);


    foreach($declareWater as $listitem) {
        $year = Carbon::parse($listitem->created_at)->format('Y');
        $month = Carbon::parse($listitem->created_at)->format('F');
        $month = str_replace(array_keys($ltMonths), array_values($ltMonths), $month);
        $monthName = $year.'-'.$month;
        $listitem->formatedDate =  $monthName;
    }

    return view('declare.indexFlat',['declareWater' => $declareWater]);
}
}}
