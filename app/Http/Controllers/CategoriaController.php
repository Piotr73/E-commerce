<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoriaController extends Controller
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
        return view('almacen.categoria.index');
    }

    public function get_categoria_info(Request $request)
    {
        if($request->ajax())
        {
            $categorias=$this->listacategorias($request['search']);
            if(!empty($request['search']))
            {
                $search=$request['search'];
                $view=view('almacen.categoria.listacategorias',compact('categorias','search'))->render();
                return response($view);
            }else{
                $view=view('almacen.categoria.listacategorias',compact('categorias'))->render();
                return response($view);
            }
        }
    }

    public function listacategorias($search)
    {
        return  $categorias=DB::table('t_categoria')->where('Nombre','LIKE','%'.$search.'%')
            ->orderBy('ID_Categoria','DESC')
            ->paginate(10);
    }

    public function getcategoriasinfosearch(Request $request)
    {
        if($request->ajax())
        {
            $categorias=$this->listacategorias($request['search']);
            return view('almacen.categoria.listacategorias',compact('categorias'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaFormRequest $request)
    {
        if ($request->ajax())
        {
            $categoria = new Categoria($request->all());
            $categoria->save();

            if ($categoria) {
                return response()->json(['success'=>'true','ID_Categoria'=>$categoria->ID_Categoria,'Nombre'=>$categoria->Nombre,'Descripcion'=>$categoria->Descripcion]);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }


    public function RegistrarCategoria(Request $request){
        if ($request->ajax())
        {
            $modo = $request->get('id');
            $nom =  $request->get('Nombre');
            $idg = $request->get('ID_General');
            $idn1 = $request->get('ID_Nivel');
            $idn2 = $request->get('ID_Nivel2');
            $desc = $request->get('Descripcion');

            $rpta = DB::select('call sp_InsCategoria(?,?,?,?,?,?)',array($modo,$idg,$idn1,$idn2,$nom,$desc));
            $rpta = json_decode(json_encode($rpta), true);
            if ($rpta) {
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::FindOrFail($id);
        return response()->json($categoria);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::FindOrFail($id);
        if ($categoria)
        {
            return response()->json($categoria);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaFormRequest $request, $id)
    {
        if ($request->ajax())
        {
            $categoria=Categoria::FindOrFail($id);
            $categoria->fill($request->all());
            $categoria->save();
            if ($categoria){
                return response()->json(['success'=>'true','ID_Categoria'=>$categoria->ID_Categoria,'Nombre'=>$categoria->Nombre,'Descripcion'=>$categoria->Descripcion]);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria=Categoria::FindOrFail($id);
        $categoria->delete();

        if($categoria)
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

    public function ObtenerCategorias($id){
        if($id == 2){
            $cat1 = DB::table('t_categoria as t')
                  ->select('t.ID_Categoria','t.ID_General','ID_Nivel','ID_Nivel2','id_menu','Nombre')
                  ->where('t.id_menu','=',1)
                  ->orderBy('t.ID_Categoria','asc')
                  ->get();

            return response()->json(['success'=>'true','categorias'=>$cat1]);

        }else{
            $cat1 = DB::table('t_categoria as t')
                  ->select('t.ID_Categoria','t.ID_General','ID_Nivel','ID_Nivel2','id_menu','Nombre')
                  ->where('t.id_menu','=',1)
                  ->orderBy('t.ID_Categoria','asc')
                  ->get();

            $cat2 = DB::table('t_categoria as t')
                  ->select('t.ID_Categoria','t.ID_General','ID_Nivel','ID_Nivel2','id_menu','Nombre')
                  ->where('t.id_menu','=',2)
                  ->orderBy('t.ID_Categoria','asc')
                  ->get();

            return response()->json(['success'=>'true','categorias'=>$cat1,'subcategorias'=>$cat2]);
        }
    }
}
