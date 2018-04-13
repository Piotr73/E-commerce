<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Producto;
use App\ProductoFoto;
use App\Marca;
use App\Modelo;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use App\Http\Requests\StockFormRequest;
use App\Http\Requests\ValidarStockFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use Storage;


class ProductoController extends Controller 
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
        $marcas = DB::table('t_marca')->orderBy('ID_Marca','ASC')->get();
        $categorias = DB::table('t_categoria')->orderBy('ID_Categoria','ASC')->get();
        $modelos = DB::table('t_modelo')->orderBy('ID_Modelo','ASC')->get();
        return view('almacen.producto.index',["marcas"=>$marcas,"categorias" => $categorias,"modelos"=>$modelos]);
    }

    public function get_producto_info(Request $request)
    {
        if($request->ajax())
        {
            $productos=$this->listaproductos($request['search']);
            if(!empty($request['search']))
            {
                $search=$request['search'];
                $view=view('almacen.producto.listaproductos',compact('productos','search'))->render();
                return response($view);
            }else{
                $view=view('almacen.producto.listaproductos',compact('productos'))->render();
                return response($view);
            }
        }
    }

    public function listaproductos($search)
    {
        return  $productos=DB::table('t_producto as t_p')
            ->join('t_marca as t_m','t_p.ID_Marca','=','t_m.ID_Marca')
            ->join('t_categoria as t_c','t_p.ID_Categoria','=','t_c.ID_Categoria')
            ->join('t_modelo as t_md','t_p.ID_Modelo','=','t_md.ID_Modelo')
            ->select('t_p.ID_Producto as id','t_p.Nombre','t_p.PU_Venta','t_p.PU_Compra','t_p.Stock','t_m.Nombre as Marca','t_c.Nombre as Categoria','t_md.Nombre as Modelo')
            ->where('t_p.Nombre','LIKE','%'.$search.'%')
            ->orwhere('t_m.Nombre','LIKE','%'.$search.'%')
            ->orderBy('t_p.ID_Producto','DESC')
            ->paginate(10);
    }

    public function getproductosinfosearch(Request $request)
    {
        if($request->ajax())
        {
            $productos=$this->listaproductos($request['search']);
            return view('almacen.producto.listaproductos',compact('productos'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        /*if ($request->ajax())
        {
            $producto = new Producto($request->all());
            $producto->save();
            if ($producto) {
                return response()->json(['success'=>'true','ID'=>$producto->ID_Producto]);
            }else{
                return response()->json(['success'=>'false']);
            }
        }*/

        $prod = new Producto;
            $prod->Nombre=$request->get('nombre_producto');
            $prod->PU_Venta=$request->get('precio_pu');
            $prod->PU_Compra=$request->get('precio_fe');
            $prod->Stock=$request->get('stock');
            $prod->Stock_Min=$request->get('stock_min');
            $prod->Descripcion=$request->get('desc_real');
            $prod->Ruta_Imagen='prueba';
            $prod->ID_Marca=$request->get('id_marca');
            $prod->ID_Modelo=$request->get('id_modelo');
            $prod->ID_Categoria=$request->get('id_categoria');
            $prod->iduser=Auth::id();
            $prod->save();
            if ($prod) {
                $id=$prod->ID_Producto;
                $files = $request->file('file');
                if(!empty($files)){
                    foreach ($files as $f){
                            $ruta = 'public/'.$id;
                            $filename = $f->store($ruta);
                            $product_photo = ProductoFoto::create([
                            'Nombre' => $filename,
                            'Nombre_Org'=>$f->getClientOriginalName(),
                            'ID_Producto' => $id,
                        ]);
                        $photo_object = new \stdClass();
                        $photo_object->name = str_replace($id, '',$f->getClientOriginalName());
                        $photo_object->size = round(Storage::size($filename) / 1024, 2);
                        $photo_object->fileID = $product_photo->id;
                        $files[] = $photo_object;
                    }
                }
                return response()->json(['success'=>'true']);                
            }else{
                return response()->json(['success'=>'false']);
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
        $producto = Producto::find($id);
        $p_fotos = DB::table('t_producto_foto')->where('ID_Producto','=',$id)->get();
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $modelos = Modelo::all();

        return view('almacen.producto.detalle',["producto"=>$producto,"marcas"=>$marcas,"categorias" => $categorias,"modelos"=>$modelos,"fotos"=>$p_fotos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::FindOrFail($id);
        if ($producto)
        {
            return response()->json($producto);
        }
    }

    public function stock($id)
    {
        $producto = Producto::FindOrFail($id);
        if ($producto)
        {
            return response()->json($producto);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $producto= Producto::FindOrFail($id);
        $producto->fill($request->all());
        $producto->save();
        if ($producto){
            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success'=>'false']);
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
        /***********Eliminando de carpeta*******/
        $names = DB::table('t_producto_foto as t') 
               ->select('t.Nombre')
               ->where('t.ID_Producto','=',$id)
               ->get();
        $names = json_decode(json_encode($names), true);

        foreach ($names as $name) {
            Storage::delete([$name['Nombre']]);
        }
        /****************************************/
        /*Eliminando de BD **************/
        $pfotos = ProductoFoto::where('ID_Producto','=',$id)->delete();
        /***************/
        if($pfotos){
            $prod=Producto::FindOrFail($id)->delete();
            if($prod){
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);    
            }
        }
    }

    public function UpdStock(StockFormRequest $request,$id)
    {
        if ($request->ajax())
        {
            $Actualizar = DB::select('call PA_ActStockxID(?,?)',array($id,$request->get('stock')));
            if($Actualizar){
                return response()->json(['success'=>'false']);
            }else{
                return response()->json(['success'=>'true']);
            }
        }
    }


    public function ValidarStock(ValidarStockFormRequest $request, $id){
        $par1 = $request->get('id');
        $par2 = $request->get('proc');
         $productos = DB::select('call PA_ValidarStock(?,?)',array($par1,$par2));
         if($productos){
            return response()->json($productos);
         }else{
            return response()->json($productos);
         }
    }

    public function ValStock(Request $request){
        $cantidad = count($request->get('stocks'));
        $contador = 0;
         while($contador < $cantidad) {
            $id= $request->get('stocks')[$contador]['ID_Producto'];
            $stock= $request->get('stocks')[$contador]['Cantidad'];
            $val = DB::select('call PA_ValStock(?,?)',array($id,$stock));

            $v=(array)$val[$contador]->id;
            $p=(array)$val[$contador]->producto;
            $c=(array)$val[$contador]->stock;
            if($v==1)
            {
                $arreglo = array('id'=>$v,'prod'=>$p,'cant'=>$c);
                /*return response()->json(['producto'=>((array)$val[0]->producto)]);    */
                return response()->json($arreglo);
            }else{
                $arreglo = array('id'=>$v,'prod'=>$p,'cant'=>$c);
                /*return response()->json(['producto'=>((array)$val[0]->producto)]);    */
                return response()->json($arreglo);
            }

            $contador = $contador + 1;
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

    public function form_nuevo_producto(){
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $modelos = Modelo::all();
        $id=Auth::id();
        return view('almacen.producto.nuevo_producto',["marcas"=>$marcas,"categorias" => $categorias,"modelos"=>$modelos,"id"=>$id]);
    }

   /**Detalle de Producto**/
   public function mostrarimagen($id){
        $path = storage_path() . '/app/' . $slug .'/'; // Podés poner cualquier ubicacion que quieras dentro del storage

        if(!File::exists($path)) abort(404); // Si el archivo no existe

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
   }
}
