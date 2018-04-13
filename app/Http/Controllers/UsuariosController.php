<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;

use DB;

class UsuariosController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /**Validando que tenga permiso para ingresar a la opción de lista usuarios**/
        $idp=1;
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

        $trabajadores = DB::table('t_persona')
            ->select(DB::raw('CONCAT(Nombre," ",Ap_Paterno," ",Ap_Materno) as Datos'),'ID_Persona')
            ->orderBy('ID_Persona','ASC')->get();
        $roles=Role::all();
        $permisos=Permission::all();
        return view('usuarios.usuario.index',["trabajadores" => $trabajadores,"roles"=>$roles,"permisos"=>$permisos]);
    }

    public function get_usuario_info(Request $request)
    {
        if($request->ajax())
        {
            $usuarios=$this->listausuarios($request['search']);
            if(!empty($request['search']))
            {
                $search=$request['search'];
                $view=view('usuarios.usuario.listausuarios',compact('usuarios','search'))->render();
                return response($view);
            }else{
                $view=view('usuarios.usuario.listausuarios',compact('usuarios'))->render();
                return response($view);
            }
        }
    }

    public function listausuarios($search)
    {

       return $usuarios=User::where("name","like","%".$search."%")->orderBy('id','DESC')->paginate(50);

    }

    public function getusuariosinfosearch(Request $request)
    {
        if ($request->ajax()) {
            $usuarios = $this->listausuarios($request['search']);
            return view('usuarios.usuario.listausuarios', compact('usuarios'))->render();
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $reglas=[  'password' => 'required|min:8',
                'email' => 'required|email|unique:users', ];

            $mensajes=[  'password.min' => 'El password debe tener al menos 8 caracteres',
                'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];

            $validator = Validator::make( $request->all(),$reglas,$mensajes );
            if( $validator->fails() ){
                return response()->json(['errores'=>$validator->errors()]);
            }
            $usuario = new User;
            $usuario->ID_Trabajador=$request->get('ID_Trabajador');
            $usuario->name=$request->get('name');
            $usuario->password=bcrypt($request->password);
            $usuario->email=$request->get('email');
            $usuario->save();
            if ($usuario) {
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    public function edit($id){
        $usuario=User::find($id);
        $roles=Role::all();
        return view("usuarios.usuario.form_editar_usuario")->with("usuario",$usuario)->with("roles",$roles);
    }

    public function update(Request $request,$id)
    {
        if ($request->ajax()) {
            $usuario = User::FindOrFail($id);
            $usuario->name = $request->get('name');
            $usuario->email = $request->get('email');
            $temp = $request->get('password');
            if ($temp != ""){
                $usuario->password=bcrypt($request->get('password'));
            }
            $usuario->update();

            if($request->has("rol")){
                $rol=$request->input("rol");
                $usuario->revokeAllRoles();
                $usuario->assignRole($rol);
            }

            if ($usuario){
                return response()->json(['success' => 'true']);
            }else {
                return response()->json(['success' => 'false']);
            }
        }
    }


    Public function Eliminarusuario(request $obj){
        /**Validar Permiso obteniendo Rol**/
        $rol= $this->ValidarPermiso($obj->get('iduser'));
        if (\Auth::user()->isRole($rol["0"]["descrol"])==false){ 
            return response()->json(['success' => 'Usted no cuenta con permisos']);
        }
        $usuario = User::FindOrFail($obj->get('id'));
        if ($usuario->delete()){
            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success' => 'false']);
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

    public function ListarPermisos($id)
    {
        $permisos = DB::select('call sp_CargarPermisosNo(?)',array($id));
        $permisos = json_decode(json_encode($permisos), true);
        if($permisos){
            return response()->json([$permisos]);    
        }
        
    }

    public function ListarPermisosGrabados($id)
    {
        $permisos = DB::select('call sp_CargarPermisosSi(?)',array($id));
        $permisos = json_decode(json_encode($permisos), true);
        if($permisos){
            return response()->json([$permisos]);    
        }
        
    }

    public function ListarPermiso($id)
    {
        $permiso = DB::select('call sp_ListarPermiso(?)',array($id));
        $permiso = json_decode(json_encode($permiso), true);
        if($permiso){
            return response()->json([$permiso]);    
        }
        
    }
//

public function form_nuevo_usuario(){
    //carga el formulario para agregar un nuevo usuario
    $roles=Role::all();
    return view("formularios.form_nuevo_usuario")->with("roles",$roles);

}


public function form_nuevo_rol(){
    //carga el formulario para agregar un nuevo rol
    $roles=Role::all();
    return view("formularios.form_nuevo_rol")->with("roles",$roles);
}

public function form_nuevo_permiso(){
    //carga el formulario para agregar un nuevo permiso
     $roles=Role::all();
     $permisos=Permission::all();
    return view("formularios.form_nuevo_permiso")->with("roles",$roles)->with("permisos", $permisos);
}



public function listado_usuarios(){
    //presenta un listado de usuarios paginados de 100 en 100
	$usuarios=User::paginate(100);

	return view("listados.listado_usuarios")->with("usuarios",$usuarios);
}





public function crear_usuario(Request $request){
    //crea un nuevo usuario en el sistema

	$reglas=[  'password' => 'required|min:8',
	             'email' => 'required|email|unique:users', ];
	 
	$mensajes=[  'password.min' => 'El password debe tener al menos 8 caracteres',
	             'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];
	  
	$validator = Validator::make( $request->all(),$reglas,$mensajes );
	if( $validator->fails() ){ 
	  	return view("mensajes.mensaje_error")->with("msj","...Existen errores...")
	  	                                    ->withErrors($validator->errors());         
	}

	$usuario=new User;
	$usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
	$usuario->telefono=$request->input("telefono");
	$usuario->email=$request->input("email");
	$usuario->password= bcrypt( $request->input("password") ); 
 
            
    if($usuario->save())
    {
      return view("mensajes.msj_usuario_creado")->with("msj","usuarios agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
}



public function crear_rol(Request $request){
   $rol=new Role;
   $rol->name=$request->input("rol") ;
   $rol->slug=$request->input("slug") ;
   $rol->description=$request->input("descripcion") ;
    if($rol->save())
    {
        $roles = DB::select('call sp_ListarRoles()');
        $roles = json_decode(json_encode($roles), true);

        if($roles){
            return response()->json(['msg'=>'true','roles'=>$roles]);
        }else{
            return response()->json(['msg'=>'false']);
        }
    }
    else
    {
        return response()->json(['msg'=>'false']);
    }
}




public function crear_permiso(Request $request){
   $permiso=new Permission;
   $permiso->name=$request->input("name") ;
   $permiso->slug=$request->input("slug") ;
   $permiso->description=$request->input("desc") ;

   $rpta = DB::select('call sp_VerificarRegistro(?,?)',array($permiso->name,$permiso->slug));
   $rpta = json_decode(json_encode($rpta), true);
   $ind = $rpta[0]["ind"];
   if($ind == 1){
        return response()->json(["msg"=>"Ya existe un registro con esos datos, favor de verificar","ind"=>"0"]);
   }else{
        if($permiso->save())
        {
            $permiso = DB::select('call sp_ObtenerUltPermiso()');
            $permiso = json_decode(json_encode($permiso), true);
            return response()->json(["msg"=>"Se ha registrado correctamente","ind"=>"1","permiso"=>$permiso]);
        }
        else
        {
            return response()->json(["msg"=>"Ha ocurrido un error, favor de revisar los datos. Si el problema persiste comunicar al Administrador del sistema.","ind"=>"2"]);
        }
   }
}

public function asignar_permiso(Request $request){

     $roleid=$request->input("rol_sel");
     $idper=$request->input("permiso_rol");
     $rol=Role::find($roleid);
     $rol->assignPermission($idper);
    
    if($rol->save())
    {
        $psi = DB::select('call sp_CargarPermisosSi(?)',array($roleid));
        $psi = json_decode(json_encode($psi), true);

        $pno = DB::select('call sp_CargarPermisosNo(?)',array($roleid));
        $pno = json_decode(json_encode($pno), true);

        return response()->json(['msg'=>'tru',"permisossi"=>$psi,"permisosno"=>$pno]);
    }
    else
    {
        return response()->json(['msg'=>'false']);
    }
}



public function form_editar_usuario($id){
    $usuario=User::find($id);
    $roles=Role::all();

    $rss = DB::select('call sp_ListarRolesxUsuario(?,?)',array($id,1));
    $rss = json_decode(json_encode($rss), true);

    $rns = DB::select('call sp_ListarRolesxUsuario(?,?)',array($id,0));
    $rns = json_decode(json_encode($rns), true);        

    return view("formularios.form_editar_usuario")->with("usuario",$usuario)
                                                  ->with("rolessi",$rss)
                                                  ->with("rolesno",$rns);                                 
}

public function editar_usuario(Request $request){
          
    $idusuario=$request->input("id_usuario");
    $usuario=User::find($idusuario);
    $usuario->name=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
    $usuario->telefono=$request->input("telefono");
    
     if($request->has("rol")){
	    $rol=$request->input("rol");
	    $usuario->revokeAllRoles();
	    $usuario->assignRole($rol);
     }
	 
    if( $usuario->save()){
		return view("mensajes.msj_usuario_actualizado")->with("msj","usuarios actualizado correctamente")
	                                                   ->with("idusuario",$idusuario) ;
    }
    else
    {
		return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
    }
}


public function buscar_usuario(Request $request){
	$dato=$request->input("dato_buscado");
	$usuarios=User::where("name","like","%".$dato."%")->orwhere("apellidos","like","%".$dato."%")                                              ->paginate(100);
	return view('listados.listado_usuarios')->with("usuarios",$usuarios);
      }




public function borrar_usuario(Request $request){

    if (\Auth::user()->isRole('standard')==false){
        return view("mensajes.mensaje_error")->with("msj","..no tiene permiso para hacer el borrado..");
    }
        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);
    
        if($usuario->delete()){
             return view("mensajes.msj_usuario_borrado")->with("msj","usuarios borrado correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
        }
        
     
}

public function editar_acceso(Request $request){
         $idusuario=$request->input("id_usuario");
         $usuario=User::find($idusuario);
         $usuario->email=$request->input("email");
         $usuario->password= bcrypt( $request->input("password") ); 
         if( $usuario->save()){
            return view("mensajes.msj_usuario_actualizado")->with("msj","usuarios actualizado correctamente")->with("idusuario",$idusuario) ;
         }
         else
         {
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ; intentarlo nuevamente ...") ;
         }
}



public function asignar_rol($idusu,$idrol){
        $usuario=User::find($idusu);
        $usuario->assignRole($idrol);
        $usuario=User::find($idusu);
        $rolesasignados=$usuario->getRoles();

        $rs = DB::select('call sp_ListarRolesxUsuario(?,?)',array($idusu,1));
        $rs = json_decode(json_encode($rs), true);

        $rn = DB::select('call sp_ListarRolesxUsuario(?,?)',array($idusu,0));
        $rn = json_decode(json_encode($rn), true);        

        return response()->json(["roles"=>$rolesasignados,"rolessi"=>$rs,"rolesno"=>$rn]);
}


public function quitar_rol($idusu,$idrol){

    $usuario=User::find($idusu);
    $usuario->revokeRole($idrol);
    $rolesasignados=$usuario->getRoles();
    $rs = DB::select('call sp_ListarRolesxUsuario(?,?)',array($idusu,1));
    $rs = json_decode(json_encode($rs), true);

    $rn = DB::select('call sp_ListarRolesxUsuario(?,?)',array($idusu,0));
    $rn = json_decode(json_encode($rn), true);        

    return response()->json(["roles"=>$rolesasignados,"rolessi"=>$rs,"rolesno"=>$rn]);


}


public function form_borrado_usuario($id){
  $usuario=User::find($id);
  return view("confirmaciones.form_borrado_usuario")->with("usuario",$usuario);

}

/*public function quitar_permiso($idrole,$idper){ */

public function quitar_permiso(request $request){ 
    $idrole=$request->input("idrol");
    $idper=$request->input("idpermiso");
    $role = Role::find($idrole);
    $role->revokePermission($idper);
    $role->save();

    $pno = DB::select('call sp_CargarPermisosNo(?)',array($idrole));
    $pno = json_decode(json_encode($pno), true);

    return response()->json(["msg"=>"Permiso desasociado correctamente","permisosno"=>$pno]);
}


public function borrar_rol($idrole){

    $role = Role::find($idrole);
    $role->delete();
    return "ok";
}

public function CargarPerfil($id){
    $user = DB::select('call cargar_datos(?)',array($id));
     if ($user)
     {
        return response()->json($user);
     }else{
        return response()->json($user);
     }
}


}
