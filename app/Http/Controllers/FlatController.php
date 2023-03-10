<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\flat;
use App\Models\declareWater;
use App\Models\House;
use App\Models\pricelist;
use App\Http\Requests\StoreflatRequest;
use App\Http\Requests\UpdateflatRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class FlatController extends Controller
{    public function __construct(){
    $this->middleware('permission:flat-view', ['only'=>['index']]);
    $this->middleware('permission:flat-create', ['only'=>['create','store']]);
    $this->middleware('permission:flat-edit', ['only'=>['edit','update']]);
    $this->middleware('permission:flat-delete', ['only'=>['destroy']]);
    $this->middleware('permission:flat-show', ['only'=>['show']]);
}


    public $ltMonths = [
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $filterData = house::all();
        $houseId = request('filter') ? request('filter') : '1' ;
        $flatCount=flat::where('house_id', $houseId )->count();
        $house=house::where('id', $houseId)->first();

        $flat=flat::sortable()->where('house_id',$houseId)->paginate(10);
        return view ('flat.index',['flat' =>$flat, 'filterData'=>$filterData, 'flatCount'=>$flatCount,'house'=>$house]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($flat)
    {
        return view('flat.create',['flat'=>$flat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreflatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreflatRequest $request)
    {  $request->validate([
        'flat_nr'=>'required|min:1|string|',
        'flat_size'=>'required',
        'gyv_mok_suma'=>'required|min:1|integer|between:0,100',
        ],[],[
            'flat_nr'=>'buto numeris',
            'flat_size'=>'buto kvadratūra',
            'gyv_mok_suma'=>'gyvatuko mokamas procentas',
        ]);
        $random_number = mt_rand(100,999);
        $random_invitation = 'A'.$random_number;
       $flat = new flat;
       $flat->house_id=request('house_id');
       $flat->flat_nr=request('flat_nr');
       $flat->flat_size=request('flat_size');
       $flat->gyv_mok_suma=request('gyv_mok_suma');
       $flat->invitation=$random_invitation;
       $flat-> save();

       return redirect()->route('flat.index')->with('good_message', 'Dėkui, Jūs sėkmingai sukūrėte naują butą! Linkime gerų kaimynų !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(flat $flat)
    {
        return view('flat.edit', ['flat' => $flat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateflatRequest  $request
     * @param  \App\Models\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateflatRequest $request, flat $flat)
    {   $request->validate([
        'flat_size'=>'required',
        'gyv_mok_suma'=>'required|min:1|integer|between:0,100',
        ],[],[
            'flat_size'=>'buto kvadratūra',
            'gyv_mok_suma'=>'gyvatuko mokamas procentas',
        ]);
        $flat->flat_size=request('flat_size');
        $flat->gyv_mok_suma = $request->gyv_mok_suma;
        $flat->save();
        return redirect()->route('flat.index')->with('good_message', 'Butas sėkmingai redaguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(flat $flat)

    {
       $declarations=DeclareWater::where('flat_id', $flat->id)->get();
        foreach ($declarations as $declaration)
        $declaration->softDelete();
        $users=user::where('flat_id', $flat->id)->get();

        foreach ($users as $user)
        $user->softDelete();
        $flat->forceDelete();
        return redirect()->route('flat.index')->with('good_message', 'Jūs sėkmingai ištrynėte butą!');
        }

    public function billsIndex()
{
    // Pasiemu duomenis is duombazes
        $userData = flat::where('id',Auth::user()->flat_id)->first();  //pasiimu vartotojo buto duomenis
        $flatSize = $userData -> flat_size; // pasiimu buto kvadratura
        $userHouse = $userData -> house_id; // pasiimu namo id
        $flatId = $userData -> id;   //pasiimu buto id
        $bathHeaterPayable = $userData ->gyv_mok_suma;     // pasiimu kiek procentu moka uz gyvatuka
        $flatWater_declaration = declareWater::where('flat_id', $flatId)->orderBy('created_at','desc')->first(); // passiemu paskutines vandens deklaracija
        $lastFlat_Declatarion_Date = new Carbon ($flatWater_declaration->created_at); //pasidarau carbon objekta
        $startOfNextMonth = $lastFlat_Declatarion_Date->copy()->addMonth()->startOfMonth(); //susigeneruoju kito menesio pradzia pagal kuria ieskoti
        $endOfNextMonth = $lastFlat_Declatarion_Date->copy()->addMonth()->endOfMonth(); //susigeneruoju kito menesio gala pagal kuri ieskoti
        $nextMonthBill = PriceList::whereBetween('created_at', [$startOfNextMonth, $endOfNextMonth])->orderBy('created_at','desc')->first(); // pasiimu paskutine to menesio saskaita nors ji turi but viena bet del vias pikto

        $hotAll = $flatWater_declaration->kitchen_hot_usage+$flatWater_declaration->bath_hot_usage;   // SUsiskaiciuoju bendra karsto vandens suvartota kieki bute
        $waterAll = $flatWater_declaration->kitchen_cold_usage+$flatWater_declaration->bath_cold_usage + $hotAll; // Susiskaiciuoju bendra salto vandens suvartota kieki bute

    // dd($bathHeaterTotalPayable);

        // //Saskaitos skaiciavimai
        $date = $nextMonthBill->created_at;

        $coldWaterBill = round( $waterAll * $nextMonthBill->saltas_vanduo_price ,2);   //saltas vanduo
        $hotWaterBill = round( $hotAll * $nextMonthBill->karstas_vanduo_price  ,2);  // susiskaiciuoju karsto vandens pasildyma
        $heatingBill = round( $nextMonthBill->sildymas_price * $userData->flat_size ,2);   // susiskaiciuoju sildymo mokesti Suma / Butu bendras plotas * buto plotas
        $heatingServiceMonthlyBill = round($nextMonthBill->silumos_mazg_prieziura_price  * $userData->flat_size ,2);   // susiskaiciuoju silumos mazgo prieziuros mokesti Suma / Butu bendras plotas * buto plotas
        $bathHeaterBill = round($nextMonthBill->gyvatukas_price * $bathHeaterPayable ,2); // gyvatuko mokestis Suma dalinta is bendro mokamo procento padauginta is buto procento
        $coldWaterMonthlyBill = round( $nextMonthBill->salto_vandens_abon_price ,2) ;  // susiskaiciuoju salto vandens abonimento mokesti   Suma / Butu skaiciaus
        $electricityForAllBill = round( $nextMonthBill-> elektra_bendra_price  ,2) ; // susiskaiciuoju bendros elektros mokesti   Suma / Butu skaiciaus
        $houseSpendingsBill = round( $nextMonthBill-> ukio_islaid_price  ,2); // susiskaiciuoju namo ukio islaidu mokesti  Suma / Butu skaiciaus
        $test=$houseSavingBill = round(  $nextMonthBill->nkf_price  * $userData->flat_size ,2); // namo kaupimo fondas

    $ltdate = $this->dateToLt($date);
    //pratestuok
    // veikia dekui o
    //o dabar jei nori naudoti kazkur kitur pvz atidaryk kur reikia

return view('flat.bill_index',compact(
    'coldWaterBill',
    'hotWaterBill',
    'heatingBill',
    'heatingServiceMonthlyBill',
    'bathHeaterBill',
    'coldWaterMonthlyBill',
    'electricityForAllBill',
    'houseSpendingsBill',
    'houseSavingBill',
    'ltdate',

));
}

public function dateToLt($date) {

    //menesius isverstus tiesiog nukeliau i virsu kad jie globaliai matytusi visoje klaseje
    //suprtau dekui man pasirode kad visa funkcija ten nukelet ir po to apacioj raset vel . Aciu

    $year = Carbon::parse($date)->format('Y');
    $month = Carbon::parse($date)->format('F');
    $month = str_replace(array_keys($this->ltMonths), array_values($this->ltMonths), $month);
    $monthName = $year.'-'.$month;
    $date =  $monthName;

    return $date;
}


public function createFlats(){
    $lastHouse=house::all()->last();
    $random_number = mt_rand(1000,9999);

    $houseID=$lastHouse->id;

    return view ('flat.createFlats',['houseID'=>$houseID, 'random_number'=>$random_number ]);
}
public function storeFlats(Request $request){

    foreach ($request->inputs as $key => $value) {
        flat::create($value);
    }
    return redirect(route('flat.index'))->with('good_message', 'Butai sėkmingai pridėti');
}
}
