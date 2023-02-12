<?php

namespace App\Http\Controllers;
use App\Models\flat;
use App\Models\pricelist;
use App\Models\contacts;
use App\Http\Requests\StorecontactsRequest;
use App\Http\Requests\UpdatecontactsRequest;
use Illuminate\Http\Request;



class ContactsController extends Controller
{    public function __construct(){
    $this->middleware('permission:contacts-view', ['only'=>['index']]);
    $this->middleware('permission:contacts-create', ['only'=>['create','store']]);
    $this->middleware('permission:contacts-edit', ['only'=>['edit','update']]);
    $this->middleware('permission:contacts-delete', ['only'=>['destroy']]);
    $this->middleware('permission:contacts-show', ['only'=>['show']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $title = 'Kontaktai';
        $contacts = Contacts::Sortable()->paginate(15);

        return view('Contacts/index', ['contacts' => $contacts, 'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecontactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecontactsRequest $request)
    {      $request->validate([
        'name'=>'required|regex:/^[A-Z][a-zA-Z]+$/',
        'email'=>'email|min:8',
        'phone'=>'required|min:9',
        'comment'=> 'required|string|min:5'
        ],[],[
            'name'=>'vartotojo vardas',
            'email'=>'vartotojo elektroninis paštas',
            'phone'=>'telefono numeris',
            'comment'=>'komentaras'

        ]);

        $contacts = new Contacts ();
        $contacts->vardas = request('name');
        $contacts->pastas = request('email');
        $contacts->tel = request('phone');
        $contacts->komentaras = request('comment');

        $contacts->save();
        return redirect ('contacts/index')->with('good_message', 'Naujas kontaktas sėkmingai pridėtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $contact = Contacts::findOrFail($id);
        return view ('Contacts/edit/',['contact' => $contact]);}
        // return view('editContact', ['id' => $id]);



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        return view('contacts.edit', ['contacts' => $contacts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecontactsRequest  $request
     * @param  \App\Models\contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecontactsRequest $request,contacts $contacts)
    {    $request->validate([
        'name'=>'required|regex:/^[A-Z][a-zA-Z]+$/',
        'email'=>'email|min:8',
        'phone'=>'required|min:9',
        'comment'=>'required|string|min:5',
        ],[],[
            'name'=>'vartotojo vardas',
            'email'=>'vartotojo elektroninis paštas',
            'phone'=>'telefono numeris',
            'comment'=> 'komentaras'
        ]);

        $contacts->vardas = $request->name;
        $contacts->pastas = $request->email;
        $contacts->tel = $request->phone;
        $contacts->komentaras = $request->comment;
        $contacts->save();
        return redirect()->route('contacts.index')->with('good_message', 'Kontaktas sėkmingai redaguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(contacts $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('good_message', 'Kontaktas sėkmingai ištrintas');
        }



}




