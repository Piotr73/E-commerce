<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /* Se está comentando esta funcion debido a que es constructora y necesita logeo para recién mandar al login*/
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /*

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $categorias = DB::table('t_categoria as t')
                  ->select('t.ID_Categoria','t.ID_General','t.ID_Nivel','t.ID_Nivel2','t.id_menu','t.Nombre')
                  ->orderBy('t.ID_Categoria','asc')
                  ->get();

        
        return view('welcome',["categorias"=>$categorias]);
        /*return view('home');*/
    }
}