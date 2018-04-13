<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Marca;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MarcaFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;

class MarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('almacen.marca.index');
    }

    public function get_marca_info(Request $request)
    {
        if($request->ajax())
        {
            $marcas=$this->listamarcas($request['search']);
            if(!empty($request['search']))
            {
                $search=$request['search'];
                $view=view('almacen.marca.listamarcas',compact('marcas','search'))->render();
                return response($view);
            }else{
                $view=view('almacen.marca.listamarcas',compact('marcas'))->render();
                return response($view);
            }
        }
    }

    public function listamarcas($search)
    {
        return  $marcas=DB::table('t_marca')->where('Nombre','LIKE','%'.$search.'%')
            ->orderBy('ID_Marca','DESC')
            ->paginate(10);
    }

    public function getmarcasinfosearch(Request $request)
    {
        if($request->ajax())
        {
            $marcas=$this->listamarcas($request['search']);
            return view('almacen.marca.listamarcas',compact('marcas'))->render();
        }
    }


    public function store(MarcaFormRequest $request){
        if ($request->ajax())
        {
            $marca = new Marca($request->all());
            $marca->save();

            if ($marca) {
                return response()->json(['success'=>'true','ID_Marca'=>$marca->ID_Marca,'Nombre'=>$marca->Nombre,'Descripcion'=>$marca->Descripcion]);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    public function show($id){
        $marca = Marca::FindOrFail($id);
        return response()->json($marca);
    }

    public function edit($id){
        $marca = Marca::FindOrFail($id);
        if ($marca)
        {
            return response()->json($marca);
        }

    }

    public function update(MarcaFormRequest $request,$id){

        if ($request->ajax())
        {
            $marca=Marca::FindOrFail($id);
            $marca->fill($request->all());
            $marca->save();
            if ($marca){
                return response()->json(['success'=>'true','ID_Marca'=>$marca->ID_Marca,'Nombre'=>$marca->Nombre,'Descripcion'=>$marca->Descripcion]);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    public function destroy($id){
        $marca=Marca::FindOrFail($id);
        $marca->delete();

        if($marca)
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
