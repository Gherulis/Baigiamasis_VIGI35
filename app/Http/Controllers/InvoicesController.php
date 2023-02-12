<?php

namespace App\Http\Controllers;
use App\Models\flat;
use App\Models\House;
use App\Models\invoices;
use App\Models\declareWater;
use App\Models\pricelist;
use App\Http\Requests\StoreinvoicesRequest;
use App\Http\Requests\UpdateinvoicesRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{    public function __construct(){
    $this->middleware('permission:invoices-view', ['only'=>['index']]);
    $this->middleware('permission:invoices-show', ['only'=>['show']]);
    $this->middleware('permission:invoices-indexFlat', ['only'=>['indexFlat']]);
    $this->middleware('permission:invoices-create', ['only'=>['create','store']]);
    $this->middleware('permission:invoices-edit', ['only'=>['edit','update','editInvoices','invoicesUpdate']]);
    $this->middleware('permission:invoices-delete', ['only'=>['destroy']]);
    $this->middleware('bills-indexLast', ['only'=>["showLast"]]);


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
    public function index(request $request)
    {
        $filterDates = invoices::orderBy('created_at', 'desc')->get();//persiduodu visus duomenis i filtra
        $filterDate = $filterDates->first();
        $filterData = request ('filter') ? request ('filter') : $filterDate->created_at ;
        if ($filterData == "*") {
            $invoices = invoices::all();
        } else {
            $filterYear = date('Y',strtotime($filterData));
            $filterMonth = date('m',strtotime($filterData));
            $invoices = invoices::whereYear('created_at',$filterYear)
            ->whereMonth('created_at',$filterMonth)
            ->get();}

        $totalInvoicesSum = 0;
        $totalPaidSum = 0;
        // $invoices = invoices::all();
        $houses = House::all();
        foreach ($invoices as $invoice){
        $invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
        $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf+$invoice->Skola
        +$invoice->Delspinigiai-$invoice->Permoka-$invoice->Kompensacija;
        $totalInvoicesSum += $invoice->sum;
        $totalPaidSum += $invoice->Sumoketa; }
        $totalDifference =  $totalPaidSum - $totalInvoicesSum;
        if($totalDifference>= 0){
            $difference = '<i class="fa-regular fa-face-grin-wide text-success"></i>'.'Permokų suma: '.' '.$totalDifference.' '.'Eur';
        }
        elseif ($totalDifference >= -0.01 && $totalDifference <= 0.01) {
            $difference = '<i class="fa-regular fa-face-grin-wide"> Whoop Whoop</i>';}

        else {
            $difference = '<i class="fa-regular fa-face-frown-open text-danger"></i>'.'Skolų suma: '.' '.$totalDifference.' '.'Eur';
        }


        return view ('invoices.index ',compact('invoices','filterDates','totalInvoicesSum','totalPaidSum','difference','filterData'));
    }
    public function indexFlat()
    {
        $invoices = invoices::where('flat_id', Auth::user()->flat_id)->orderBy('created_at','desc')->get();

        foreach ($invoices as $invoice){
            $invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
            $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf+$invoice->Skola
            +$invoice->Delspinigiai-$invoice->Permoka-$invoice->Kompensacija;}

        return view ('invoices.indexFlat ',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // Sitas metodas ivyksta automatiskai pateikus saskaita namui.Pricelist create !!!  Atskirai saskaitu butui kurti negalima !!!

        $invoicesData = $this->calculateInvoices();

        foreach ($invoicesData as $index =>$invoice) {
            $invoice = new invoices();
            $invoice->flat_id=$invoicesData[$index]['flatId']  ;
            $invoice->data=$invoicesData[$index]['ltdate']  ;
            $invoice->saltas_vanduo=$invoicesData[$index]['coldWaterBill']   ;
            $invoice->karstas_vanduo= $invoicesData[$index]['hotWaterBill'] ;
            $invoice->sildymas=$invoicesData[$index]['heatingBill']  ;
            $invoice->silumos_mazg_prieziura=$invoicesData[$index]['heatingServiceMonthlyBill']  ;
            $invoice->gyvatukas=$invoicesData[$index]['bathHeaterBill']   ;
            $invoice->salto_vandens_abon= $invoicesData[$index]['coldWaterMonthlyBill']  ;
            $invoice->elektra_bendra= $invoicesData[$index]['electricityForAllBill']  ;
            $invoice->ukio_islaid=  $invoicesData[$index]['houseSpendingsBill'] ;
            $invoice->nkf= $invoicesData[$index]['houseSavingBill']  ;
            $invoice->save();


        }
        return redirect()->route('invoices.index')->with('good_message', 'Jūs sėkmingai sukūrėte sąskaitą!');
        // return redirect()->route('house.index', ['invoicesData'=>$invoicesData])->with('good_message', 'Dėkui, Jūs sėkmingai pateikėte sąskaitą');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreinvoicesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreinvoicesRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        $lastInvoice = invoices::where('flat_id', Auth::user()->flat_id)->orderBy('created_at', 'desc')->first();
        if(!$lastInvoice){
            return redirect()->route('posts.index')->with('bad_message','Paskutinė sąskaita nerasta');
        } else {
            $suma=$lastInvoice->sum = $lastInvoice->saltas_vanduo + $lastInvoice->karstas_vanduo + $lastInvoice->sildymas + $lastInvoice->silumos_mazg_prieziura+$lastInvoice->gyvatukas+
            $lastInvoice->salto_vandens_abon+$lastInvoice->elektra_bendra+$lastInvoice->ukio_islaid+$lastInvoice->nkf-$lastInvoice->Kompensacija+$lastInvoice->Skola-$lastInvoice->Permoka
            +$lastInvoice->Delspinigiai;
            }






        return view ('flat.bill_index',['lastInvoice'=>$lastInvoice, 'suma'=>$suma]);
    }




    public function showLast(invoices $invoices)
    {
        $lastInvoice = invoices::where('flat_id', Auth::user()->flat_id)->orderBy('created_at', 'desc')->first();
        $invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
        $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf+$invoice->Skola
        +$invoice->Delspinigiai-$invoice->Permoka-$invoice->Kompensacija;

        return view ('flat.bill_index',['lastInvoice'=>$lastInvoice, 'suma'=>$suma]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */


    public function editInvoices(invoices $invoices)
    {
        $filterDates = invoices::orderBy('created_at', 'desc')->get();//persiduodu visus duomenis i filtra
        $filterDate = $filterDates->first();
        $filterData = request ('filter') ? request ('filter') : $filterDate->created_at ;
        if ($filterData == "*") {
            $invoices = invoices::all();
        } else {
            $filterYear = date('Y',strtotime($filterData));
            $filterMonth = date('m',strtotime($filterData));
            $invoices = invoices::whereYear('created_at',$filterYear)
            ->whereMonth('created_at',$filterMonth)
            ->get();}

        foreach ($invoices as $invoice){
        $invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
        $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf-$invoice->Kompensacija+$invoice->Skola-$invoice->Permoka
        +$invoice->Delspinigiai;}

        return view ('invoices.editInvoice ',compact('invoices','filterDates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateinvoicesRequest  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateinvoicesRequest $request, invoices $invoices)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
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

    public function calculateInvoices() {
        $lastRecord=PriceList::latest('created_at')->first();
        $userHouse=$lastRecord->house_id;
        $flats = flat::where('house_id',$userHouse)->get();

        $invoicesData = [];
        foreach ($flats as $flat) {
            $flatData = $flat;
            $flatSize = $flat->flat_size;
            $flatId = $flat->id;
            $bathHeaterPayable = $flat->gyv_mok_suma;
            $flatWater_declaration = declareWater::where('flat_id', $flatId)->orderBy('created_at','desc')->first(); // passiemu paskutines vandens deklaracija
            $lastFlat_Declatarion_Date = new Carbon ($flatWater_declaration->created_at); //pasidarau carbon objekta
            $startOfNextMonth = $lastFlat_Declatarion_Date->copy()->addMonth()->startOfMonth(); //susigeneruoju kito menesio pradzia pagal kuria ieskoti
            $endOfNextMonth = $lastFlat_Declatarion_Date->copy()->addMonth()->endOfMonth(); //susigeneruoju kito menesio gala pagal kuri ieskoti

            $nextMonthBill=PriceList::where('house_id',$userHouse)->orderBy('created_at','desc')->first();
            $hotAll = $flatWater_declaration->kitchen_hot_usage+$flatWater_declaration->bath_hot_usage;   // SUsiskaiciuoju bendra karsto vandens suvartota kieki bute
            $waterAll = $flatWater_declaration->kitchen_cold_usage+$flatWater_declaration->bath_cold_usage + $hotAll; // Susiskaiciuoju bendra salto vandens suvartota kieki bute

            // //Saskaitos skaiciavimai
            $date = $nextMonthBill->created_at;

            $coldWaterBill = round( $waterAll * $nextMonthBill->saltas_vanduo_price ,2);   //saltas vanduo
            $hotWaterBill = round( $hotAll * $nextMonthBill->karstas_vanduo_price  ,2);  // susiskaiciuoju karsto vandens pasildyma
            $heatingBill = round( $nextMonthBill->sildymas_price * $flat->flat_size ,2);   // susiskaiciuoju sildymo mokesti Suma / Butu bendras plotas * buto plotas
            $heatingServiceMonthlyBill = round($nextMonthBill->silumos_mazg_prieziura_price  * $flat->flat_size ,2);   // susiskaiciuoju silumos mazgo prieziuros mokesti Suma / Butu bendras plotas * buto plotas
            $bathHeaterBill = round($nextMonthBill->gyvatukas_price * $bathHeaterPayable ,2); // gyvatuko mokestis Suma dalinta is bendro mokamo procento padauginta is buto procento
            $coldWaterMonthlyBill = round( $nextMonthBill->salto_vandens_abon_price ,2) ;  // susiskaiciuoju salto vandens abonimento mokesti   Suma / Butu skaiciaus
            $electricityForAllBill = round( $nextMonthBill-> elektra_bendra_price  ,2) ; // susiskaiciuoju bendros elektros mokesti   Suma / Butu skaiciaus
            $houseSpendingsBill = round( $nextMonthBill-> ukio_islaid_price  ,2); // susiskaiciuoju namo ukio islaidu mokesti  Suma / Butu skaiciaus
            $houseSavingBill = round(  $nextMonthBill->nkf_price  * $flat->flat_size ,2); // namo kaupimo fondas
            $flatSum=$coldWaterBill + $hotWaterBill + $heatingBill + $heatingServiceMonthlyBill + $bathHeaterBill + $coldWaterMonthlyBill +  $electricityForAllBill +  $houseSpendingsBill +  $houseSavingBill; // bendra saskaitos suma

            $ltdate = $this->dateToLt($date);
            $invoicesData[] = [
                'userHouse' => $userHouse,
                'flatId' => $flatId,
                'hotAll'=>$hotAll,
                'waterAll'=>$waterAll,
                'ltdate'=>$ltdate,
                'flatSum'=>$flatSum,
                'coldWaterBill'=>$coldWaterBill,
                'hotWaterBill'=>$hotWaterBill,
                'heatingBill'=>$heatingBill,
                'heatingServiceMonthlyBill'=>$heatingServiceMonthlyBill,
                'bathHeaterBill'=>$bathHeaterBill,
                'coldWaterMonthlyBill'=>$coldWaterMonthlyBill,
                'electricityForAllBill'=>$electricityForAllBill,
                'houseSpendingsBill'=>$houseSpendingsBill,
                'houseSavingBill'=>$houseSavingBill,
            ];
        }
        return $invoicesData;
    }
        public function invoicesUpdate(Request $request){
            {
                $invoiceData = $request->all();
                $invoiceIds = $invoiceData['invoice_id'];
                $kompensacija = $invoiceData['kompensacija'];
                $skola = $invoiceData['skola'];
                $permoka = $invoiceData['permoka'];
                $delspinigiai = $invoiceData['delspinigiai'];
                $sumoketa = $invoiceData['sumoketa'];
                foreach ($invoiceIds as $i => $invoiceId) {
                  $invoice = Invoices::find($invoiceId);
                  $invoice->Kompensacija = $kompensacija[$i] ?? 0;
                  $invoice->Skola = $skola[$i] ?? 0;
                  $invoice->Permoka = $permoka[$i] ?? 0;
                  $invoice->Delspinigiai = $delspinigiai[$i] ?? 0;
                  $invoice->Sumoketa = $sumoketa[$i] ?? 0;

                  $invoice->save();
                }

   return redirect(route('invoices.index'))->with('good_message', 'Whoop Whoop sėkmingai pridėta');
}

        }

}
