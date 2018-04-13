<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;

class ClienteController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $idp=3;
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
            ->where('Descripcion','=','Cliente')
            ->get();
        $tipo = $tipo[0]->ID_Tipo;
        return view('usuarios.cliente.index',compact('tipo'));
    }

    public function get_cliente_info(Request $request)
    {
        if($request->ajax())
        {
            $clientes=$this->listaclientes($request['search']);
            if(!empty($request['search']))
            {
                $search=$request['search'];
                $view=view('usuarios.cliente.listaclientes',compact('clientes','search'))->render();
                return response($view);
            }else{
                $view=view('usuarios.cliente.listaclientes',compact('clientes'))->render();
                return response($view);
            }
        }
    }

    public function listaclientes($search)
    {
        return  $clientes=DB::table('t_persona as p')
            ->join('t_tipo_persona as tp','p.ID_Tipo','=','tp.ID_Tipo')
            ->select(DB::raw('CONCAT(p.Nombre," ",p.Ap_Paterno," ",p.Ap_Materno) as Datos'),'p.ID_Persona','tp.Descripcion as desc','p.DNI','p.RUC')
            ->where('p.ID_Tipo','=',2)
            ->where('p.Nombre','LIKE','%'.$search.'%')
            ->orderBy('ID_Persona','DESC')
            ->paginate(10);
    }

    public function getclientesinfosearch(Request $request)
    {
        if ($request->ajax()) {
            $clientes = $this->listaclientes($request['search']);
            return view('usuarios.cliente.listaclientes', compact('clientes'))->render();
        }
    }

    public function destroy($id)
    {
        $cliente=Cliente::FindOrFail($id);
        $cliente->delete();

        if($cliente)
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
