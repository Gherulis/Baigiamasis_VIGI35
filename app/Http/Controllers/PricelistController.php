<?php

namespace App\Http\Controllers;




use App\Models\pricelist;
use App\Models\flat;
use App\Models\house;
use App\Models\declareWater;
use App\Models\invoices;
use App\Models\Nkf;
use App\Http\Requests\StorepricelistRequest;
use App\Http\Requests\UpdatepricelistRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PricelistController extends Controller
{    public function __construct(){
    $this->middleware('permission:pricelist-view', ['only'=>['index',"showLast"]]);
    $this->middleware('permission:pricelist-create', ['only'=>['create','store']]);
    $this->middleware('permission:pricelist-edit', ['only'=>['edit','update']]);
    $this->middleware('permission:pricelist-delete', ['only'=>['destroy']]);
    $this->middleware('permission:pricelist-lastbill', ['only'=>['lastbill']]);
    $this->middleware('permission:pricelist-showPrices', ['only'=>['showPrices','showPrices']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
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
        $filter = $request->filter ;

        if(!empty($filter )){
            $pricelist = pricelist::sortable()->where('house_id', $filter)->paginate(30);
        }
             else {$pricelist = pricelist::sortable()->get();};

        foreach($pricelist as $listitem) {
            $year = Carbon::parse($listitem->created_at)->format('Y');
            $month = Carbon::parse($listitem->created_at)->format('F');
            $month = str_replace(array_keys($ltMonths), array_values($ltMonths), $month);
            $monthName = $year.'-'.$month;
            $listitem->formatedDate =  $monthName;
        }
        $houses = house::all();

        return view('pricelist.index',['pricelist' => $pricelist, 'houses'=>$houses]);

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
    public function store(StorepricelistRequest $request)
    {
        $request->validate([
            'house_nr'=> 'required|min:1|numeric|between:0,19999.99',
            'saltas_vanduo'=>'required|min:1|numeric|between:0,19999.99',
            'karstas_vanduo'=>'required|min:1|numeric|between:0,19999.99',
            'sildymas'=>'required|min:1|numeric|between:0,19999.99',
            'silumos_mazg_prieziura'=>'required|min:1|numeric|between:0,19999.99',
            'gyvatukas'=>'required|min:1|numeric|between:0,19999.99',
            'salto_vandens_abon'=>'required|min:1|numeric|between:0,19999.99',
            'elektra_bendra'=>'required|min:1|numeric|between:0,19999.99',
            'ukio_islaid'=>'required|min:1|numeric|between:0,19999.99',
            'nkf'=>'required|min:1|numeric|between:0,19999.99',

            ],[],[
                'house_nr'=> 'namo numeris',
                'saltas_vanduo'=>'šaltas vanduo',
                'karstas_vanduo'=>'karštas vanduo',
                'sildymas'=>'šildymas',
                'silumos_mazg_prieziura'=>'šilumos mazgo priežiūra',
                'gyvatukas'=>'gyvatukas',
                'salto_vandens_abon'=>'šalto vandens abonimentas',
                'elektra_bendra'=>'elektra bendroms reikmėms',
                'ukio_islaid'=>'ūkio išlaidos',
                'nkf'=>'namo kaupimo fondas',
            ]);

        $house_id = request('house_nr');
        $saltas_vanduo = request('saltas_vanduo');
        $karstas_vanduo = request('karstas_vanduo');
        $sildymas = request('sildymas');
        $silumos_mazg_prieziura = request('silumos_mazg_prieziura');
        $gyvatukas = request('gyvatukas');
        $salto_vandens_abon = request('salto_vandens_abon');
        $elektra_bendra = request('elektra_bendra');
        $ukio_islaid = request('ukio_islaid');
        $nkf = request('nkf');
        $nkfForNkf=$nkf;
        $house_idForNkf=$house_id;

        $userFlat = Auth::user()->flat_id;
        $houseNr =$house_id;//reikes perdaryti i request kuriam namui bus skirta saskaita
        $flat_count = flat::where('house_id',$houseNr)->count('flat_nr');    //suzinau kiek name yra butu (30);
        $flat_total_sq_m = flat::where('house_id',$houseNr)->sum('flat_size');   // suzinau bendra butu kvadratura viso namo !!!
        $gyv_mok_suma_total = flat::where('house_id',$houseNr)->sum('gyv_mok_suma');  //suzinau bendra procenta kiek visi moka uz gyvatuka

        //Menesio pries vandens suvartojimo sumos
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth(); // sugeneruoju paskutinio menesio pradzia
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();  // sugeneruoju paskutinio menesio pradzia


        $kitchen_cold_sum = DeclareWater::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                    ->whereHas('forFlat.belongsHouse', function($query) use($houseNr) {
                        $query->where('id', '=', $houseNr);
                    })->sum('kitchen_cold_usage');   // susirandu deklaracijas paskutinio menesio kurios priklauso sitam namui ir susumuoju salto virtuvej vandens sunaudojima

                    $bath_cold_sum = DeclareWater::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                    ->whereHas('forFlat.belongsHouse', function($query) use($houseNr) {
                        $query->where('id', '=', $houseNr);
                    })->sum('bath_cold_usage');   // susirandu deklaracijas paskutinio menesio kurios priklauso sitam namui ir susumuoju salto vonioj vandens sunaudojima

                    $kitchen_hot_sum = DeclareWater::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                    ->whereHas('forFlat.belongsHouse', function($query) use($houseNr) {
                        $query->where('id', '=', $houseNr);
                    })->sum('kitchen_hot_usage');   // susirandu deklaracijas paskutinio menesio kurios priklauso sitam namui ir susumuoju karsto  virtuves vandens sunaudojima

                    $bath_hot_sum = DeclareWater::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                    ->whereHas('forFlat.belongsHouse', function($query) use($houseNr) {
                        $query->where('id', '=', $houseNr);
                    })->sum('bath_hot_usage');   // susirandu deklaracijas paskutinio menesio kurios priklauso sitam namui ir susumuoju vonioj karsto vandens sunaudojima

        $totalWater = $kitchen_cold_sum + $bath_cold_sum +  $kitchen_hot_sum +   $bath_hot_sum; // susiskaiciuoju bendra vandens suvartojima
        $totalHot = $kitchen_hot_sum +   $bath_hot_sum; // susiskaiciuoju bendra karsto vandens suvartojima





        $pricelist = new pricelist ();
        $pricelist->house_id = $house_id;
        $pricelist->saltas_vanduo = $saltas_vanduo;
        $pricelist->karstas_vanduo =  $karstas_vanduo;
        $pricelist->sildymas = $sildymas;
        $pricelist->silumos_mazg_prieziura = $silumos_mazg_prieziura;
        $pricelist->gyvatukas = $gyvatukas;
        $pricelist->salto_vandens_abon =  $salto_vandens_abon;
        $pricelist->elektra_bendra = $elektra_bendra ;
        $pricelist->ukio_islaid = $ukio_islaid ;
        $pricelist->nkf =  $nkf;
        $pricelist->saltas_vanduo_price = $saltas_vanduo/$totalWater;  // padalinu is bendro vandens suvartojimo
        $pricelist->karstas_vanduo_price  =  $karstas_vanduo/$totalHot; // padalinu is bendro karsto vandens suvartojimo ir suzinau pasildymo kaina
        $pricelist->sildymas_price  =$sildymas/$flat_total_sq_m ; // padalinu is bendros butu kvadraturos
        $pricelist->silumos_mazg_prieziura_price  = $silumos_mazg_prieziura/$flat_total_sq_m; // padalinu is bendros butu kvadraturos
        $pricelist->gyvatukas_price  = $gyvatukas/$gyv_mok_suma_total;  //padalinu is bendro mokamo procento
        $pricelist->salto_vandens_abon_price  = $salto_vandens_abon/$flat_count; // padalinu is bendro butu skaiciaus
        $pricelist->elektra_bendra_price  = $elektra_bendra/$flat_count; // padalinu is bendro butu skaiciaus
        $pricelist->ukio_islaid_price  = $ukio_islaid/$flat_count; // padalinu is bendro butu skaiciaus
        $pricelist->nkf_price  =  $nkf/$flat_total_sq_m; // padalinu is bendros butu kvadraturos

        $pricelist->save();

        $nkf = new Nkf();
        $nkf->house_id=$house_idForNkf;
        $nkf->description="Mėnesinė namo kaupimo iplauka";
        $nkf->type="Įplaukos";
        $nkf->amountPayed=$nkfForNkf;
        $nkf->save();

        return redirect()->route('invoices.create')->with('good_message', 'Jūs sėkmingai sukūrėte saskaitą!');;



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
    {   $request->validate([

        'saltas_vanduo'=>'required|min:1|numeric|between:0,19999.99',
        'karstas_vanduo'=>'required|min:1|numeric|between:0,19999.99',
        'sildymas'=>'required|min:1|numeric|between:0,19999.99',
        'silumos_mazg_prieziura'=>'required|min:1|numeric|between:0,19999.99',
        'gyvatukas'=>'required|min:1|numeric|between:0,19999.99',
        'salto_vandens_abon'=>'required|min:1|numeric|between:0,19999.99',
        'elektra_bendra'=>'required|min:1|numeric|between:0,19999.99',
        'ukio_islaid'=>'required|min:1|numeric|between:0,19999.99',
        'nkf'=>'required|min:1|numeric|between:0,19999.99',

        ],[],[

            'saltas_vanduo'=>'šaltas vanduo',
            'karstas_vanduo'=>'karštas vanduo',
            'sildymas'=>'šildymas',
            'silumos_mazg_prieziura'=>'šilumos mazgo priežiūra',
            'gyvatukas'=>'gyvatukas',
            'salto_vandens_abon'=>'šalto vandens abonimentas',
            'elektra_bendra'=>'elektra bendroms reikmėms',
            'ukio_islaid'=>'ūkio išlaidos',
            'nkf'=>'namo kaupimo fondas',
        ]);


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
        return redirect()->route('pricelist.index')->with('good_message', 'Įrašas sėkmingai redaguotas!');;
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
}
public function showPrices($id)
{
    $pricelist = Pricelist::findOrFail($id);
    return view ('pricelist.show', ['pricelist'=>$pricelist]);}

}
