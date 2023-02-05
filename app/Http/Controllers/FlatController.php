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

class FlatController extends Controller
{


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
    {
        $flat=flat::sortable()->paginate(10);
        return view ('flat.index',['flat' =>$flat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreflatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreflatRequest $request)
    {
       $flat = new flat;
       $flat->house_id=request('house_id');
       $flat->flat_nr=request('flat_nr');
       $flat->flat_size=request('flat_size');
       $flat->gyv_mok_suma=request('gyv_mok_suma');
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
    {

        $flat->flat_size = $request ->flat_size;
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



}

// kopija
// public function billsIndex()
// // gauti paskutine vandens deklarcija pagal vartotoja
// //is jos minusuoti pries paskutines vandens deklaracijos rodmenis pagal vartotoja
// //pasiimti namo duomenis
// //suskaiciuoti butus is namo valdiklio
// //gauti bendra namo kvadratura
// //pasidaryti mokama procenta kadangi ne visi moka vienodai del kompensaciju
// //gauti kainas uz kv.m
// //pasiimti permokas
// //pasiimti skolas
// //atvaizduoti kiekviena eilute
// //visa tai turi veikti pasirenkant menesi
// //Hmmm ? idomuuuu


// {
// // Pasiemu duomenis is duombazes
// $userData = flat::where('id',Auth::user()->flat_id)->first();  //pasiimu vartotojo buto duomenis
// $userHouse = $userData -> house_id; // pasiimu namo id
// $flatId = $userData -> id;   //pasiimu buto id
// $bathHeaterPayable = $userData ->gyv_mok_suma;     // pasiimu kiek procentu moka uz gyvatuka
// $lastHouseBill = pricelist::where('house_id', $userHouse)->orderBy('created_at', 'desc')->first(); //pasiimu paskutine namo saskaita
// $houseFlatsTotal = flat::where('house_id', $userHouse)->count(); // susiskaiciuoju bendra butu skaiciu
// $houseLivingSpace = flat::where('house_id', $userHouse)->sum('flat_size'); // susiskaiciuoju bendra namo butu kvadratura
// $bathHeaterTotalPayable = flat::where('house_id', $userHouse)->sum('gyv_mok_suma'); // susiskaiciuoju bendra procenta uz gyvatuka nes kai kurie turi kompensacijas
// $lastHouseBillDate = new Carbon($lastHouseBill->created_at); // pasiemu paskutines saskaitos data

// $lastHouseBillMonth = $lastHouseBillDate->month-1; // sugeneruoju menesio skaiciuka pvz 1
// if($lastHouseBillMonth == 0 ){ $lastHouseBillMonth = 12 ;}

// $lastHouseBillYear = $lastHouseBillDate->year; // sugeneruoju metu skaiciuka pvz 2021
// if($lastHouseBillMonth == 12 ){ $lastHouseBillYear -=1;}
// //   <<<<<< Nuo >>>>>
// $userHouseDeclarationFiltered = declareWater::with(['forFlat'=> function($thishouse) use ($userHouse)
// {
//     $thishouse->where('house_id', $userHouse);
// }])
// ->whereYear('created_at', $lastHouseBillYear)
// ->whereMonth('created_at',  $lastHouseBillMonth )
// ->get();
// $userFlatBelongs = $userHouseDeclarationFiltered->where('forFlat.house_id', $userHouse); //pasiimu deklaracija pagal visa nama kuriam priklauso gyventojas ir filtruota pagal metus ir menesi.
// // $kitchenColdArray = array($userFlatBelongs['kitchen_cold'] );
// // $totalKitchenCold = array_sum($kitchenColdArray);

// $kitchen_cold_this_month = $userFlatBelongs->sum('kitchen_cold');
// $kitchen_hot_this_month = $userFlatBelongs->sum('kitchen_hot');
// $bath_cold_this_month =$userFlatBelongs->sum('bath_cold');
// $bath_hot_this_month = $userFlatBelongs->sum('bath_hot');


// $userHouseDeclarationFilteredBefore = declareWater::with(['forFlat'=> function($thishouse) use ($userHouse)
// {
//     $thishouse->where('house_id', $userHouse);
// }])
// ->whereYear('created_at', $lastHouseBillYear)
// ->whereMonth('created_at',  $lastHouseBillMonth-1 )
// ->get();
// $userFlatBelongsBefore = $userHouseDeclarationFilteredBefore->where('forFlat.house_id', $userHouse); //pasiimu deklaracija pagal visa nama kuriam priklauso gyventojas ir filtruota pagal metus ir menesi.
// // $kitchenColdArray = array($userFlatBelongs['kitchen_cold'] );
// // $totalKitchenCold = array_sum($kitchenColdArray);

// $kitchen_cold_month_before = $userFlatBelongsBefore->sum('kitchen_cold');
// $kitchen_hot_month_before = $userFlatBelongsBefore->sum('kitchen_hot');
// $bath_cold_month_before =$userFlatBelongsBefore->sum('bath_cold');
// $bath_hot_month_before = $userFlatBelongsBefore->sum('bath_hot');




// // testavimai
// $test = $lastHouseBillMonth;
// $test1 = $kitchen_hot_this_month-$kitchen_hot_month_before ;
// $test2 = $kitchen_cold_this_month - $kitchen_cold_month_before ;
// $test3 = $bath_hot_this_month - $bath_hot_month_before ;
// $test4 = $bath_cold_this_month - $bath_cold_month_before ;
// $test5 = $kitchen_hot_this_month - $kitchen_hot_month_before ;
// // testavimai baigiasi




// //    <<<<<  Iki  >>>>>

// $lastFlatDeclaration = declareWater::where('flat_id', $flatId) // pasiimu paskutine vandens deklaracija buto
// ->orderBy('created_at', 'desc')
// ->first();

// $oneBeforeLastFlatDeclaration = declareWater::where('flat_id', Auth::user()->flat_id) // pasiimu pries paskutine vandens deklaracija buto
// ->orderBy('created_at', 'desc')
// ->skip(1)
// ->first();

// // Vandens bute suvartojimo skaiciavimai
// $kitchen_cold_sum = $lastFlatDeclaration->kitchen_cold - $oneBeforeLastFlatDeclaration-> kitchen_cold; // susiskaiciuoju virtuves salto skirtuma
// $kitchen_hot_sum = $lastFlatDeclaration->kitchen_hot - $oneBeforeLastFlatDeclaration-> kitchen_hot; // susiskaiciuoju virtuves karsto skirtuma
// $bath_cold_sum = $lastFlatDeclaration->bath_cold - $oneBeforeLastFlatDeclaration-> bath_cold;  // susiskaiciuoju vonios salto skirtuma
// $bath_hot_sum = $lastFlatDeclaration->bath_hot - $oneBeforeLastFlatDeclaration-> bath_hot;  // susiskaiciuoju vonios karsto skirtuma
// $hotAll = $kitchen_hot_sum + $bath_hot_sum;   // SUsiskaiciuoju bendra karsto vandens suvartota kieki bute
// $waterAll = $kitchen_cold_sum + $bath_cold_sum + $hotAll; // Susiskaiciuoju bendra salto vandens suvartota kieki bute



// // dd($bathHeaterTotalPayable);

// //Saskaitos skaiciavimai
// $date = $lastHouseBill->created_at;

// $coldWaterBill = round( $lastHouseBill-> saltas_vanduo * $waterAll ,2);
// $hotWaterBill = round( $lastHouseBill-> karstas_vanduo * $hotAll ,2);  // susiskaiciuoju karsto vandens pasildyma
// $heatingBill = round( $lastHouseBill-> sildymas / $houseLivingSpace  * $userData->flat_size ,2);   // susiskaiciuoju sildymo mokesti Suma / Butu bendras plotas * buto plotas
// $heatingServiceMonthlyBill = round( $lastHouseBill-> silumos_mazg_prieziura / $houseLivingSpace  * $userData->flat_size ,2);   // susiskaiciuoju silumos mazgo prieziuros mokesti Suma / Butu bendras plotas * buto plotas
// $bathHeaterBill = round($lastHouseBill-> gyvatukas / $bathHeaterTotalPayable * $bathHeaterPayable ,2); // gyvatuko mokestis Suma dalinta is bendro mokamo procento padauginta is buto procento
// $coldWaterMonthlyBill = round( $lastHouseBill-> salto_vandens_abon /  $houseFlatsTotal ,2) ;  // susiskaiciuoju salto vandens abonimento mokesti   Suma / Butu skaiciaus
// $electricityForAllBill = round( $lastHouseBill-> elektra_bendra /  $houseFlatsTotal ,2) ; // susiskaiciuoju bendros elektros mokesti   Suma / Butu skaiciaus
// $houseSpendingsBill = round( $lastHouseBill-> ukio_islaid /  $houseFlatsTotal ,2); // susiskaiciuoju namo ukio islaidu mokesti  Suma / Butu skaiciaus
// $houseSavingBill = round(  $lastHouseBill-> nkf / $houseLivingSpace  * $userData->flat_size ,2); // namo kaupimo fondas


// $ltdate = $this->dateToLt($date);
// //pratestuok
// // veikia dekui o
// //o dabar jei nori naudoti kazkur kitur pvz atidaryk kur reikia



// return view('flat.bill_index',compact(
// 'coldWaterBill',
// 'hotWaterBill',
// 'heatingBill',
// 'heatingServiceMonthlyBill',
// 'bathHeaterBill',
// 'coldWaterMonthlyBill',
// 'electricityForAllBill',
// 'houseSpendingsBill',
// 'houseSavingBill',
// 'ltdate',
// 'test',
// 'test1',
// 'test2',
// 'test3',
// 'test4',
// 'test5',
// 'userFlatBelongs'
// ));
