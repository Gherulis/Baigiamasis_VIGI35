<?php

namespace App\Http\Controllers;

use App\Models\declareWater;
use App\Models\flat;
use App\Models\house;
use App\Http\Controllers\Request;

//cia isiterpi FlatControlleri nes jame yra tas metodas

// use App\Http\Controllers\FlatController;


use App\Http\Requests\StoredeclareWaterRequest;
use App\Http\Requests\UpdatedeclareWaterRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DeclareWaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //na ir pvz cia

        {

        $flatController = new FlatController;

        $declareWater = declareWater::orderBy('created_at', 'desc')->get();

        foreach($declareWater as $listitem) {
            // $year = Carbon::parse($listitem->created_at)->format('Y');
            // $month = Carbon::parse($listitem->created_at)->format('F');
            // $month = str_replace(array_keys($ltMonths), array_values($ltMonths), $month);
            // $monthName = $year.'-'.$month;


            $listitem->formatedDate =  $flatController->dateToLt($listitem->created_at);


            //i skliaustelius pasiduoda pilna data kuria gauni is duombazes!!!
            //grizta paversta pagal tavo formatavima
            //pratestuok dabar pratestuok
            // bandom ? taip, tuojau
            //gramatine klaida dabar veikia super visaip bandziau :)
            //tai dabar kur tau reikia sito metodo
            //1. virsuje isimeti FLatControlleri
            //2. metodo virsuje         $flatController = new FlatController;
            //3. ir kvieties dateToLt perduodamas data
            // supratau o kodel flat kontroleryje tiek kartu tai naudojot tiek virsuj tiek apacioj ?
            // virsuje itraukiamaa KLASE
            //kad butu galima naudotis metodais reika sukurti OBJEKTA pagal itraukta klase
        }}

        return view('declare.index',['declareWater' => $declareWater]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {



    //     return view('declare.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredeclareWaterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredeclareWaterRequest $request)
    {

        $declareWater = new declareWater ();

        $declareWater->flat_id = request('flat_id');
        $declareWater->kitchen_cold = request('kitchen_cold');
        $declareWater->kitchen_hot = request('kitchen_hot');
        $declareWater->bath_cold = request('bath_cold');
        $declareWater->bath_hot = request('bath_hot');
        $declareWater->declaredBy = request('declaredBy');
        $declareWater->save();

        return redirect ('declare/index/flat')->with('mssg', 'Sėkmingai pridėta!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\declareWater  $declareWater
     * @return \Illuminate\Http\Response
     */
    public function show(declareWater $declareWater){
        {
            $lastData = declareWater::where('flat_id', Auth::user()->flat_id)
                ->orderBy('id', 'desc')
                ->first();



            return view('declare.create', [
                'declareWater' => $declareWater,
                'lastData' => $lastData
            ]);
        }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\declareWater  $declareWater
     * @return \Illuminate\Http\Response
     */
    public function edit(declareWater $declareWater)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedeclareWaterRequest  $request
     * @param  \App\Models\declareWater  $declareWater
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedeclareWaterRequest $request, declareWater $declareWater)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\declareWater  $declareWater
     * @return \Illuminate\Http\Response
     */
    public function destroy(declareWater $declareWater)
    {
        //
    }
    public function calculate(Request $request)
{
    // Retrieve the request parameter and the data needed for the calculation
    $value1 = $request->input('kitchen_cold');
    $value2 = $lastData->kitchen_cold;

    // Perform the calculation
    $result = $value1 - $value2;

    // Pass the result to the view
    return view('declare.show', ['result' => $result]);
}

public function indexFlat()
{

    {    $flatController = new FlatController;
    $declareWater = declareWater::where('flat_id', Auth::user()->flat_id)
    ->orderBy('id', 'desc')
    ->get();

    $declareWater = declareWater::where('flat_id', Auth::user()->flat_id)
    ->orderBy('created_at', 'desc')
    ->get();

    foreach($declareWater as $listitem) {

        $listitem->formatedDate =  $flatController->dateToLt($listitem->created_at);
    }}

    return view('declare.indexFlat',['declareWater' => $declareWater]);
}



// public function indexByMonth()
// {
//     {$houses = house::all(); // pasiemu visus namus
//     $house = '1';
//     $flats = flat::where('house_id', $house)->get();


//         $ltMonths = [
//         'January' => 'Sausis',
//         'February' => 'Vasaris',
//         'March' => 'Kovas',
//         'April' => 'Balandis',
//         'May' => 'Gegužė',
//         'June' => 'Birželis',
//         'July' => 'Liepa',
//         'August' => 'Rugpjūtis',
//         'September' => 'Rugsėjis',
//         'October' => 'Spalis',
//         'November' => 'Lapkritis',
//         'December' => 'Gruodis',
//     ];



//     $declareWater = declareWater::orderBy('created_at', 'desc')->get();

//     foreach($declareWater as $listitem) {
//         $year = Carbon::parse($listitem->created_at)->format('Y');
//         $month = Carbon::parse($listitem->created_at)->format('F');
//         $month = str_replace(array_keys($ltMonths), array_values($ltMonths), $month);
//         $monthName = $year.'-'.$month;
//         $listitem->formatedDate =  $monthName;
//     }}

//     return view('declare.indexByMonth',['declareWater' => $declareWater,'flats' =>$flats, 'houses' => $houses]);

    public function create(Request $request)
{
    // $new_kitchen_cold = $request->new_kitchen_cold;
    $old_value = $lastData->kitchen_cold;
    $result = $new_kitchen_cold - $old_value;
    return response()->json($result);
}



}
