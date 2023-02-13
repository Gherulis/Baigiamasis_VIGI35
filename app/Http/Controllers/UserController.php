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
        $this->middleware('permission:user-show',['only' =>['show']]);
        }

    public function index(){
        $house_id = request('house_id');
        if (empty($house_id)){
        $flat_id = auth::user()->flat_id;
        $flat = flat::where('id', $flat_id)->first();
        $house_id = $flat->house_id;}


        $user = User::where('id', '!=', auth()->user()->id)->where('id', '!=',1)->whereHas('usersFlat.belongsHouse', function($house) use ($house_id) {
            $house->where('id', $house_id);
        })->get();


        return view('user.index',['user' => $user ]);
    }


public function show(){
        $title = 'Apie mane';
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


        return view('user.show', ['flats' => $flats, 'invoices'=>$invoices, 'lastinvoiceCreated'=>$lastinvoiceCreated,'lastInvoice'=>$lastInvoice,'difference'=>$difference, 'differenceAmount'=>$differenceAmount,'declarationLastDate'=>$declarationLastDate,'title'=>$title]);
    }
    public function create(){


             $roles = Role::all()->skip(1)->sortByDesc('id');
             $flats = flat::with('belongsHouse')->get();

             return view('user.create', ['roles'=>$roles,'flats'=>$flats]);
    }
    public function store(request $request){
        $request->validate([
            'name'=>'required|regex:/^[A-Z][a-zA-Z]+$/',
            'email'=>'required|email|min:4',
            'password'=>'required|min:8',
            'phone'=>'min:9',

            ],[],[
                'name'=>'vartotojo vardas',
                'email'=>'vartotojo elektroninis paštas',
                'password'=>'slaptažodis',
                'phone'=>'vartotojo telefono numeris'
            ]);
            $emailExists = User::where('email', $request->email)
            ->exists();

            if ($emailExists) {
            return redirect()->back()
                ->with('bad_message','Toks elektroninis paštas egzistuoja');
        } else {


        $user = new User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> phone = $request->phone;
        $user -> password = Hash::make($request->password);
        $user -> flat_id = $request->flat_id;
        $user -> save();

        $user->assignRole($request->role);
        return redirect()->route('user.index')->with('good_message', 'Vartotojas sėkmingai sukurtas!');
    }
    return view('user.show', ['flats' => $flats,'house_id'=>$house_id]);}
    public function destroy(user $user)
    {   $flat_id=auth::user()->flat_id;
        $house_id=flat::where('id',$flat_id)->pluck('house_id');

        $user->delete();
        return back()->with('good_message', 'Vartotojas sėkmingai ištrintas!');
}
public function edit(user $user)
    {
        return view('user.edit', ['user' => $user]);
    }


    public function update(UpdateuserRequest $request,user $user)
    {    $request->validate([
        'name'=>'required|string',
        'email'=>'required|email|min:4',

        ],[],[
            'name'=>'vartotojo vardas',
            'email'=>'vartotojo elektroninis paštas',
            'phone'=>'vartotojo telefono numeris'
        ]);



        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->color = $request->color;

        $user->save();
        return redirect()->route('user.show')->with('good_message', 'Vartotojas sėkmingai redaguotas!');
    }


}
