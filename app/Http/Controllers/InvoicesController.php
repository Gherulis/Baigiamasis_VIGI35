<?php

namespace App\Http\Controllers;
use App\Models\flat;
use App\Models\invoices;
use App\Models\declareWater;
use App\Models\pricelist;
use App\Http\Requests\StoreinvoicesRequest;
use App\Http\Requests\UpdateinvoicesRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
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
        $invoices = invoices::all();

        foreach ($invoices as $invoice){
        $invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
        $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf-$invoice->kompensacija+$invoice->skola-$invoice->permoka
        +$invoice->delspinigiai;}

        return view ('invoices.index ',compact('invoices'));
    }
    public function indexFlat()





    {
        $invoices = invoices::where('flat_id', Auth::user()->flat_id)->orderBy('created_at','desc')->get();

        foreach ($invoices as $invoice){
        $invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
        $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf-$invoice->kompensacija+$invoice->skola-$invoice->permoka
        +$invoice->delspinigiai;}

        return view ('invoices.index ',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
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
        return redirect()->route('house.index', ['invoicesData'=>$invoicesData]);
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
        $suma=$lastInvoice->sum = $lastInvoice->saltas_vanduo + $lastInvoice->karstas_vanduo + $lastInvoice->sildymas + $lastInvoice->silumos_mazg_prieziura+$lastInvoice->gyvatukas+
        $lastInvoice->salto_vandens_abon+$lastInvoice->elektra_bendra+$lastInvoice->ukio_islaid+$lastInvoice->nkf-$lastInvoice->kompensacija+$lastInvoice->skola-$lastInvoice->permoka
        +$lastInvoice->delspinigiai;

        return view ('flat.bill_index',['lastInvoice'=>$lastInvoice, 'suma'=>$suma]);
    }




    public function showLast(invoices $invoices)
    {
        $lastInvoice = invoices::where('flat_id', Auth::user()->flat_id)->orderBy('created_at', 'desc')->first();
        $suma=$lastInvoice->sum = $lastInvoice->saltas_vanduo + $lastInvoice->karstas_vanduo + $lastInvoice->sildymas + $lastInvoice->silumos_mazg_prieziura+$lastInvoice->gyvatukas+
        $lastInvoice->salto_vandens_abon+$lastInvoice->elektra_bendra+$lastInvoice->ukio_islaid+$lastInvoice->nkf-$lastInvoice->kompensacija+$lastInvoice->skola-$lastInvoice->permoka
        +$lastInvoice->delspinigiai;

        return view ('flat.bill_index',['lastInvoice'=>$lastInvoice, 'suma'=>$suma]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
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
        //
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
            // $userHouse = $flat->house_id;
            $flatId = $flat->id;
            $bathHeaterPayable = $flat->gyv_mok_suma;
            $flatWater_declaration = declareWater::where('flat_id', $flatId)->orderBy('created_at','desc')->first(); // passiemu paskutines vandens deklaracija
            $lastFlat_Declatarion_Date = new Carbon ($flatWater_declaration->created_at); //pasidarau carbon objekta
            $startOfNextMonth = $lastFlat_Declatarion_Date->copy()->addMonth()->startOfMonth(); //susigeneruoju kito menesio pradzia pagal kuria ieskoti
            $endOfNextMonth = $lastFlat_Declatarion_Date->copy()->addMonth()->endOfMonth(); //susigeneruoju kito menesio gala pagal kuri ieskoti
            // if(  $nextMonthBill = PriceList::whereBetween('created_at', [$startOfNextMonth, $endOfNextMonth])->orderBy('created_at','desc')->first()){
            // $nextMonthBill = PriceList::whereBetween('created_at', [$startOfNextMonth, $endOfNextMonth])->orderBy('created_at','desc')->first();} // pasiimu paskutine to menesio saskaita nors ji turi but viena bet del vias pikto
            // else { $nextMonthBill=PriceList::where('house_id',$userHouse)->orderBy('created_at','desc')->first(); }

            $nextMonthBill=PriceList::where('house_id',$userHouse)->orderBy('created_at','desc')->first();
            $hotAll = $flatWater_declaration->kitchen_hot_usage+$flatWater_declaration->bath_hot_usage;   // SUsiskaiciuoju bendra karsto vandens suvartota kieki bute
            $waterAll = $flatWater_declaration->kitchen_cold_usage+$flatWater_declaration->bath_cold_usage + $hotAll; // Susiskaiciuoju bendra salto vandens suvartota kieki bute
            // dd($flatWater_declaration);



            // $date = date('Y-m');

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


}
