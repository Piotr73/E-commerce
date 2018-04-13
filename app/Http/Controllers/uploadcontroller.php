<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductoFoto;
use App\Producto;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class uploadcontroller extends Controller
{

     public function upload(Request $request){
        
            $prod = new Producto;
            $prod->Nombre=$request->get('nombre_producto');
            $prod->PU_Venta=$request->get('precio_pu');
            $prod->PU_Compra=$request->get('precio_fe');
            $prod->Stock=$request->get('stock');
            $prod->Stock_Min=$request->get('stock_min');
            $prod->Descripcion='prueba';
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


    public function uploadedit(Request $request,$id)
	{
        $ind = $request->get('ind');
        if($ind==1){
            $names = DB::table('t_producto_foto as t') 
               ->select('t.Nombre')
               ->where('t.ID_Producto','=',$id)
               ->get();
            $names = json_decode(json_encode($names), true);

            foreach ($names as $name) {
                Storage::delete([$name['Nombre']]);
            }

            $v = ProductoFoto::where('ID_Producto','=',$id)->delete();

            if($v){
                if(file_exists(public_path('storage/'.$id))){
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
        }

        $producto= Producto::FindOrFail($id);
        $producto->Nombre=$request->get('nombre_producto');
        $producto->PU_Venta=$request->get('precio_pu');
        $producto->PU_Compra=$request->get('precio_fe');
        $producto->Stock=$request->get('stock');
        $producto->Stock_Min=$request->get('stock_min');
        $producto->Descripcion=$request->get('desc');
        $producto->Ruta_Imagen='ruta';
        $producto->ID_Marca=$request->get('id_marca');
        $producto->ID_Categoria=$request->get('id_categoria');
        $producto->ID_Modelo=$request->get('id_modelo');
        $producto->iduser=Auth::id();
        $producto->update();
        if ($producto){
            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success'=>'false']);
        }
        
	}
}
