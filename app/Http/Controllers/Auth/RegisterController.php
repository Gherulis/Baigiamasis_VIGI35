<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\flat;
use App\Models\House;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'flat_id' => ['required', 'integer'],
            // 'flat_nr' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       $invitation = $data['invitation'];
       $flat_invitation = Flat::where('invitation', $invitation)->get('id');

       if ($flat_invitation->count() > 0) {
          $user = new User;
          $user->name = $data['name'];
          $user->email = $data['email'];
          $user->password = Hash::make($data['password']);
          $user->flat_id = $flat_invitation->first()->id;

          $user->save();
          $user->assignRole([4]);

          return $user;
       } else {
        abort(redirect('/register')->with('bad_message', 'Ups, pakvietimas nerastas!'));
       }
    }










    public function showRegistrationForm()
    {   $flats=flat::all();
        return view('auth.register',['flats' =>$flats]);
    }
}
