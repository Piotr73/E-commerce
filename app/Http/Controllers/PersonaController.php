<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;

class PersonaController extends Controller
{
    /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $idp=2;
        $iduser=Auth::id();

        $r= $this->ValidarPermiso($iduser);
        $p= $this->ObtenerRolesxPermiso($idp);
        $c1=count($p);
        $c2=count($r);

        $cant = 0;
        for ($i=0; $i < $c1; $i++) {
            for ($j=0; $j < $c2; $j++) {
                if($p[$i]["role_id"]==$r[$j]["idrol"]){
                    $cant = $cant + 1;
                }
            }
        }

        if($cant==0){
            return view('errors.700');
        }

        $tipo=DB::table('t_tipo_persona')
            ->select('ID_Tipo')
            ->where('Descripcion','=','Personal')
            ->get();
        $tipo = $tipo[0]->ID_Tipo;
        return view('usuarios.trabajador.index',compact('tipo'));
    }

    public function get_trabajador_info(Request $request)
    {
        if($request->ajax())
        {
            $trabajadores=$this->listatrabajadores($request['search']);
            if(!empty($request['search']))
            {
                $search=$request['search'];
                $view=view('usuarios.trabajador.listatrabajadores',compact('trabajadores','search'))->render();
                return response($view);
            }else{
                $view=view('usuarios.trabajador.listatrabajadores',compact('trabajadores'))->render();
                return response($view);
            }
        }
    }

    public function listatrabajadores($search)
    {
        return  $trabajadores=DB::table('t_persona as p')
            ->join('t_tipo_persona as tp','p.ID_Tipo','=','tp.ID_Tipo')
            ->select(DB::raw('CONCAT(p.Nombre," ",p.Ap_Paterno," ",p.Ap_Materno) as Datos'),'p.ID_Persona','tp.Descripcion as desc','p.DNI','p.RUC')
            ->where('p.ID_Tipo','=',1)
            ->where('p.Nombre','LIKE','%'.$search.'%')
            ->orderBy('ID_Persona','DESC')
            ->paginate(10);
    }

    public function gettrabajadoresinfosearch(Request $request)
    {
        if ($request->ajax()) {
            $trabajadores = $this->listatrabajadores($request['search']);
            return view('usuarios.trabajador.listatrabajadores', compact('trabajadores'))->render();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaFormRequest $request)
    {
        if ($request->ajax())
        {
            $trabajador = new Persona;
            $trabajador->DNI=$request->get('DNI');
            $trabajador->Nombre=$request->get('Nombre');
            $trabajador->Ap_Paterno=$request->get('Ap_Paterno');
            $trabajador->Ap_Materno=$request->get('Ap_Materno');
            $trabajador->RUC =$request->get('RUC');
            $trabajador->ID_Tipo=$request->get('ID_Tipo');
            $trabajador->save();
            if ($trabajador) {
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    public function edit($id)
    {
        $trabajador = Persona::FindOrFail($id);
        if ($trabajador)
        {
            return response()->json($trabajador);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaFormRequest $request, $id)
    {
        if ($request->ajax())
        {
            $trabajador=Persona::FindOrFail($id);
            $trabajador->DNI=$request->get('DNI');
            $trabajador->Nombre=$request->get('Nombre');
            $trabajador->Ap_Paterno=$request->get('Ap_Paterno');
            $trabajador->Ap_Materno = $request->get('Ap_Materno');
            $trabajador->RUC=$request->get('RUC');
            $trabajador->update();
            if ($trabajador){
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    public function destroy($id)
    {
        $trabajador=Persona::FindOrFail($id);
        $trabajador->delete();

        if($trabajador)
        {
            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success'=>'false']);
        }
    }

    public function ValidarPermiso($id)
    {
        $permiso = DB::select('call sp_ObtenerRol(?)',array($id));
        $permiso = json_decode(json_encode($permiso), true);
        return $permiso;
    }

    public function ObtenerRolesxPermiso($id)
    {
        $roles = DB::select('call sp_ObtenerRolesxPermiso(?)',array($id));
        $roles = json_decode(json_encode($roles), true);
        return $roles;
    }
}