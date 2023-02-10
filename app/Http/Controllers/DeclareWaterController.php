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
        //na ir pvz cia

        {

        $flatController = new FlatController;

        $declareWater = declareWater::sortable()->orderBy('created_at','desc')->paginate(30);

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
    public function create()
    {
        $deklaruotaCreated = declareWater::where('flat_id',auth::user()->flat_id)->orderBy('created_at','desc')->pluck('created_at')->first();
        $deklaruota=$deklaruotaCreated->format('Y-m');
        $today = date('Y-m');
        if($deklaruota!=$today){
        return view('declare.create',['deklaruota'=>$deklaruota]);}
        else{
            return redirect()->route('declare.indexFlat')->with('bad_message','Šio mėnesio rodmenys jau buvo pateikti sėkmingai');}

        }


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
        return view ('declareWater.index')->with('good_message', 'Deklaracija sėkmingai ištrinta');;
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
