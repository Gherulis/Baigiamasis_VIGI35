<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateuserRequest;
use App\Models\User;
use App\Models\House;
use App\Models\flat;
use App\Models\declareWater;
use App\Models\Invoices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

//Adresas
//kai reikia kintamuju
//use App\Models\Adresas;

//is kito modelio pvz reikia kazkokio vis metoda
// kita controleri



use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('permission:user-view',['only' =>['index']]);
        $this->middleware('permission:user-create',['only' =>['create','store']]);
        $this->middleware('permission:user-edit',['only' =>['update','edit']]);
        $this->middleware('permission:user-delete',['only' =>['destroy']]);
        }

    public function index(){

        $user = User::where('id', '!=', auth()->user()->id)->where('id', '!=',1)->with('usersFlat.belongsHouse')->get();


        return view('user.index',['user' => $user ]);
    }


public function show(){

        $flat_id = Auth::user()->flat_id;
        $flats = flat::with('belongsHouse')->with('flatUsers')->findorfail($flat_id);
        $invoices = Invoices::where('flat_id',Auth::user()->flat_id)->orderBy('created_at','desc')->get();
        $declaration = declareWater::where('flat_id',Auth::user()->flat_id)->orderBy('created_at','desc')->first();
        $totalInvoicesSum = 0;
        $totalPaidSum = 0;
        foreach ($invoices as $invoice) {
        $invoice->suma=$invoice->sum = $invoice->saltas_vanduo + $invoice->karstas_vanduo + $invoice->sildymas + $invoice->silumos_mazg_prieziura+$invoice->gyvatukas+
        $invoice->salto_vandens_abon+$invoice->elektra_bendra+$invoice->ukio_islaid+$invoice->nkf+$invoice->Skola
        +$invoice->Delspinigiai-$invoice->Permoka-$invoice->Kompensacija;
        $totalInvoicesSum += $invoice->sum;
        $totalPaidSum += $invoice->Sumoketa; }
        $totalDifference = round( $totalPaidSum - $totalInvoicesSum,2);
        if($totalDifference>= 0){
            $difference ='<i class="fa-regular fa-face-grin-wide text-success"></i>'.'Permokų suma ';
            $differenceAmount = $totalDifference.' '.'Eur';
        }
        elseif ($totalDifference >= -0.01 && $totalDifference <= 0.01) {
            $difference ='<i class="fa-regular fa-face-grin-wide"> Whoop Whoop</i>';
            $differenceAmount = '0';}

        else {
            $difference ='<i class="fa-regular fa-face-frown-open text-danger"></i>'.'Skolų suma ';
            $differenceAmount = $totalDifference.' '.'Eur';
        }
        $lastInvoice = $invoices->first();
        if(!empty($lastInvoice->created_at)){
        $lastinvoiceCreated=date('Y-m-d',strtotime($lastInvoice->created_at));}
        else{
            $lastinvoiceCreated='Nėra duomenų';
        }
        $declarationLastDate=date('Y-m-d',strtotime( $declaration->created_at));


        return view('user.show', ['flats' => $flats, 'invoices'=>$invoices, 'lastinvoiceCreated'=>$lastinvoiceCreated,'lastInvoice'=>$lastInvoice,'difference'=>$difference, 'differenceAmount'=>$differenceAmount,'declarationLastDate'=>$declarationLastDate]);
    }
    public function create(){
             $roles = Role::all()->skip(1);
             $flats = flat::with('belongsHouse')->get();

             return view('user.create', ['roles'=>$roles,'flats'=>$flats]);
    }
    public function store(request $request){

        $user = new User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = Hash::make($request->password);
        $user -> flat_id = $request->flat_id;
        $user -> save();

        $user->assignRole($request->role);
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai sukurtas!');



        return view('user.show', ['flats' => $flats]);
    }
    public function destroy(user $user)
    {

        $user->delete();
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai ištrintas!');
}
public function edit(user $user)
    {
        return view('user.edit', ['user' => $user]);
    }


    public function update(UpdateuserRequest $request,user $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai redaguotas!');
    }


}
