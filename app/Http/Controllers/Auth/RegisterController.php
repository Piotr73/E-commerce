<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'pat' => 'required|max:255',
            'mat' => 'required|max:255',
            'doi' => 'required|max:255',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $nombre = $data['name']." ".$data['pat']." ".$data['mat'];
        $trabajador = new Persona;
        $trabajador->DNI=$data['doi'];
        $trabajador->Nombre=$data['name'];
        $trabajador->Ap_Paterno=$data['pat'];
        $trabajador->Ap_Materno=$data['mat'];
        $trabajador->RUC =$data['doi'];
        $trabajador->ID_Tipo=2;
        $trabajador->save();



        return User::create([
            'name' => $nombre,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'ID_Persona' =>$trabajador->ID_Persona,
            'remember_token'=>$data['_token'],
        ]);
    }

    /***Modificando ruta de registro para acoplar con plantilla */
    public function showRegistrationForm()
    {
        return view('store.register');
    }
}
