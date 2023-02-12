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
{   public function __construct(){
    $this->middleware('permission:declare-view', ['only'=>['index']]);
    $this->middleware('permission:declare-indexFlat', ['only'=>['indexFlat']]);
    $this->middleware('permission:declare-create', ['only'=>['create','store']]);
    $this->middleware('permission:declare-edit', ['only'=>['edit','update']]);
    $this->middleware('permission:declare-delete', ['only'=>['destroy']]);
    $this->middleware('permission:declare-show', ['only'=>['show']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {   $house_id = request('filter');

            $dateFilter = request ('dateFilter');
            if($dateFilter== null){
                $dateFilter = today();
                $year = Carbon::parse($dateFilter)->format('Y');
                $month = Carbon::parse($dateFilter)->format('m');
                $month = $month-1;
                $dateFilter = $year.'-'.$month;
            }
            $yearFilter = Carbon::parse($dateFilter)->format('Y');
            $monthFilter = Carbon::parse($dateFilter)->format('m');

            $declareWater = declareWater::whereHas('forFlat', function($query) use ($house_id) {
            $query->whereHas('belongsHouse', function($query) use ($house_id) {
                $query->where('house_id', $house_id);
            });
        })->whereYear('created_at',$yearFilter)->whereMonth('created_at',$monthFilter)->sortable()->orderBy('created_at','desc')->paginate();

        $flatController = new FlatController;

        // $declareWater = declareWater::sortable()->orderBy('created_at','desc')->paginate(30);

        foreach($declareWater as $listitem) {
            // $year = Carbon::parse($listitem->created_at)->format('Y');
            // $month = Carbon::parse($listitem->created_at)->format('F');
            // $month = str_replace(array_keys($ltMonths), array_values($ltMonths), $month);
            // $monthName = $year.'-'.$month;
            $listitem->formatedDate =  $flatController->dateToLt($listitem->created_at);
            $listitem->waterUsage = $listitem->kitchen_cold_usage + $listitem->kitchen_hot_usage + $listitem->bath_cold_usage + $listitem->bath_hot_usage;
            $listitem->hotWaterUsage = $listitem->kitchen_hot_usage + $listitem->bath_hot_usage;
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
        }
        $filterDateData = declareWater::whereHas('forFlat', function($query) use ($house_id) {
            $query->whereHas('belongsHouse', function($query) use ($house_id) {
                $query->where('house_id', $house_id);
            });})->get();
        foreach ($filterDateData as $dataItem){
            $dataItem->formatedDate =  $flatController->dateToLt($dataItem->created_at);

        }}
        $filterDateData=$filterDateData->unique('formatedDate');
        $totalWater = $declareWater->sum('waterUsage');
        $totalHotWater = $declareWater->sum('hotWaterUsage');




        return view('declare.index',['declareWater' => $declareWater, 'filterDateData'=>$filterDateData, 'totalWater'=>$totalWater, 'totalHotWater'=>$totalHotWater ]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $todaysDay = date('d');

        if($todaysDay<24||$todaysDay>31){
            return redirect()->route('declare.indexFlat')->with('bad_message','Rodmenis galima deklaruoti nuo 24 dienos iki mėnesio pabaigos!');}
         else{
        $deklaruotaCreated = declareWater::where('flat_id',auth::user()->flat_id)->orderBy('created_at','desc')->pluck('created_at')->first();
        $deklaruotaCreator = declareWater::where('flat_id',auth::user()->flat_id)->orderBy('created_at','desc')->pluck('declaredBy')->first();
        $deklaruota=$deklaruotaCreated->format('Y-m');
        $today = date('Y-m');
        if($deklaruota!=$today){
        return view('declare.create',['deklaruota'=>$deklaruota]);}
        else{
            return redirect()->route('declare.indexFlat')->with('good_message','Vartotojas'.' '.$deklaruotaCreator.' '.'jau deklaravęs šio mėnesio rodmenis. Gražios dienos!');}

        }}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredeclareWaterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredeclareWaterRequest $request)
    {    $request->validate([
        'kitchen_cold'=>'required|integer|min:0',
        'kitchen_hot'=>'required|integer|min:0',
        'bath_cold'=>'required|integer|min:0',
        'bath_hot'=>'required|integer|min:0',
        ],[],[
            'kitchen_cold'=>'virtuvės šaltas vanduo',
            'kitchen_hot'=>'virtuvės karštas vanduo',
            'bath_cold'=>'vonios šaltas vanduo',
            'bath_hot'=>'vonios karštas vanduo',
        ]);

        $declareWater = new declareWater ();

        $declareWater->flat_id = request('flat_id');
        $declareWater->kitchen_cold = $kitchen_cold =request('kitchen_cold');
        $declareWater->kitchen_cold_usage =$kitchen_cold_usage=$kitchen_cold - request('kitchen_cold_before');
        $declareWater->kitchen_hot =$kitchen_hot= request('kitchen_hot');
        $declareWater->kitchen_hot_usage = $kitchen_hot_usage =$kitchen_hot- request('kitchen_hot_before');
        $declareWater->bath_cold = $bath_cold= request('bath_cold');
        $declareWater->bath_cold_usage = $bath_cold_usage= $bath_cold - request('bath_cold_before');
        $declareWater->bath_hot = $bath_hot= request('bath_hot');
        $declareWater->bath_hot_usage =$bath_hot_usage=$bath_hot - request('bath_hot_before');
        $declareWater->declaredBy = request('declaredBy');
        if($kitchen_cold_usage <0 || $kitchen_hot_usage <0 || $bath_hot_usage <0 || $bath_cold_usage <0 ){
            return redirect (route('declare.create'))->with('bad_message', 'Oooops Skirtumas negali būti neigiamas');
        } else {
        $declareWater->save();
        return redirect ('declare/index/flat')->with('good_message', 'Dėkui, Jūs sėkmingai deklaravote rodmenis!');}
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
        return view('declare.edit', ['declareWater' => $declareWater]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedeclareWaterRequest  $request
     * @param  \App\Models\declareWater  $declareWater
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedeclareWaterRequest $request, declareWater $declareWater)
    {   $request->validate([
        'kitchen_cold'=>'required|integer|min:0',
        'kitchen_hot'=>'required|integer|min:0',
        'bath_cold'=>'required|integer|min:0',
        'bath_hot'=>'required|integer|min:0',
        ],[],[
            'kitchen_cold'=>'virtuvės šaltas vanduo',
            'kitchen_hot'=>'virtuvės karštas vanduo',
            'bath_cold'=>'vonios šaltas vanduo',
            'bath_hot'=>'vonios karštas vanduo',
        ]);
        // skaiciuoju skirtumus suvartojimu jei daromas update
        $kitchen_cold_before = $declareWater->kitchen_cold;
        $kitchen_cold_now = $request ->kitchen_cold;
        $kitchen_cold_diference = $kitchen_cold_now - $kitchen_cold_before;
        $kitchen_cold_usage = $declareWater->kitchen_hot_usage+$kitchen_cold_diference;
        $kitchen_hot_before = $declareWater->kitchen_hot;
        $kitchen_hot_now = $request ->kitchen_hot;
        $kitchen_hot_diference = $kitchen_hot_now - $kitchen_hot_before;
        $kitchen_hot_usage = $declareWater->kitchen_hot_usage+$kitchen_hot_diference;

        $bath_cold_before = $declareWater->bath_cold;
        $bath_cold_now = $request ->bath_cold;
        $bath_cold_diference = $bath_cold_now - $bath_cold_before;
        $bath_cold_usage = $declareWater->bath_hot_usage+$bath_cold_diference;
        $bath_hot_before = $declareWater->bath_hot;
        $bath_hot_now = $request ->bath_hot;
        $bath_hot_diference = $bath_hot_now - $bath_hot_before;
        $bath_hot_usage = $declareWater->bath_hot_usage+$bath_hot_diference;

        $declareWater->kitchen_cold =  $kitchen_cold_now;
        $declareWater->kitchen_hot = $request->kitchen_hot;
        $declareWater->bath_cold = $request->bath_cold;
        $declareWater->bath_hot = $request->bath_hot;
        $declareWater->declaredBy = Auth::user()->name ;
        $declareWater->kitchen_cold_usage=$kitchen_cold_usage;
        $declareWater->kitchen_hot_usage=$kitchen_hot_usage;
        $declareWater->bath_cold_usage=$bath_cold_usage;
        $declareWater->bath_hot_usage=$bath_hot_usage;

        $declareWater->update();
        return redirect()->route('declare.indexFlat')->with('good_message', 'Sėkmingai redaguoti rodmenys');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\declareWater  $declareWater
     * @return \Illuminate\Http\Response
     */
    public function destroy(declareWater $declareWater)
    {
        $declareWater->delete();
        return back()->with('good_message', 'Deklaracija sėkmingai ištrinta');;
    }
    public function calculate(Request $request)
{
    $value1 = $request->input('kitchen_cold');
    $value2 = $lastData->kitchen_cold;
    $result = $value1 - $value2;

    return view('declare.show', ['result' => $result]);
}

public function indexFlat()
{
    {    $flatController = new FlatController;
    $declareWater = declareWater::sortable()->where('flat_id', Auth::user()->flat_id)
    ->orderBy('created_at', 'desc')
    ->paginate(25);
    foreach($declareWater as $listitem) {

        $listitem->formatedDate =  $flatController->dateToLt($listitem->created_at);
    }}

    return view('declare.indexFlat',['declareWater' => $declareWater]);
}

}
