<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo='/personas/trabajador/';*/  /* Se comentó para que a la hora de redireccionar el sistema envíe a plantillas segñun el tipo de usuario*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        $categorias = DB::table('t_categoria as t')
                  ->select('t.ID_Categoria','t.ID_General','ID_Nivel','ID_Nivel2','id_menu','Nombre')
                  ->where('t.id_menu','=',1)
                  ->orderBy('t.ID_Categoria','asc')
                  ->get();

        return view('store.login',["categorias"=>$categorias]);
    }

}
