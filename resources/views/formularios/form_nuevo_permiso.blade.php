<div class="col-md-12">
    <div class="box box-primary col-md-12 box-gris">
 
        <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Nuevo permiso</strong></h3>
        </div><!-- /.box-header -->
        <hr style="border-color:white;" />
        	<div class="box-body">
                <div class="col-md-6">
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
						<div class="form-group">
							<label class="col-sm-2" for="rol">Rol*</label>
		    				<div class="col-sm-10" >                 
		                    	<select id="rol_sel" name="rol_sel" class="form-control" required>
		                     	    @foreach($roles as $rol)
		                     			<option value="{{ $rol->id }}">{{ $rol->name }}</option>
		                     		@endforeach
		    					</select>
		                	</div>
						</div><!-- /.form-group -->
						<div class="form-group">
							<label class="col-sm-2" for="rol">Permisos*</label>
		    			<div class="col-sm-10" >
		                     <select id="permiso_rol" name="permiso_rol" class="form-control" required disabled>
		                     @foreach($permisos as $permiso)
		                     	<option value="nn">{{ $permiso->name }}</option>
		                     @endforeach
		    				</select>
		                </div>
						</div><!-- /.form-group -->
						<div class="box-footer col-xs-12 box-gris text-center" >
		                        <button id="btn_apermiso" class="btn btn-primary">Agregar Permiso</button>
		                </div>
		        </div>
			    <div class="col-md-6">
		            <form class="formentrada"  >
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
		                <div class="col-md-12">	  
			                <div class="form-group">
									<label class="col-sm-2" for="apellido">Permiso*</label>
			                    <div class="col-sm-10" >
									<input type="text" class="form-control" id="permiso_nombre" name="permiso_nombre"  required >
			                    </div>
							</div><!-- /.form-group -->
					    </div><!-- /.col -->
						<div class="col-md-12">
			                <div class="form-group">
									<label class="col-sm-2" for="apellido">Slug*</label>
			                    <div class="col-sm-10" >
									<input type="text" class="form-control" id="permiso_slug" name="permiso_slug"  required >
			                    </div>
							</div><!-- /.form-group -->
					    </div><!-- /.col -->
						<div class="col-md-12">
			                <div class="form-group">
									<label class="col-sm-2" for="apellido">Descripcion*</label>
			                    <div class="col-sm-10" >
									<input type="text" class="form-control" id="permiso_descripcion" name="permiso_descripcion"  required >
			                    </div>
							</div><!-- /.form-group -->
					    </div><!-- /.col -->
		                <div class="box-footer col-xs-12 box-gris text-center ">
		                        <button id="btn_cpermiso" class="btn btn-primary">Crear Nuevo Permiso</button>
		                </div>
		            </form>
                </div>          
        </div>
    </div>
</div>
<div class="col-md-12 box-white">
    <div class="table-responsive" >
	    <table  class="table table-hover table-striped" cellspacing="0" width="100%" id="table_permisos">
                <thead>
                <th colspan="5" style="text-align: center; background-color: #b8ccde;" >Permisos del Usuario</th>
                </thead>
				<thead>
						    <th>Código</th>
							<th>Nombre</th>
							<th>Slug</th>
							<th>Descripción</th>
							<th>Acción</th>
				</thead>
	    		<tbody>
	    			
				</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$("table#table_permisos tbody").append('<tr><td colspan="5" class="text-center">Seleccione un rol para listar los permisos asignados</td></tr>');
        $('#rol_sel').change(function() {
        	var id = $('#rol_sel').val();
        	ListarPermisos(id);
        	ListarPermisosGrabados(id);
    	});
    });

	function ListarPermisos(id){
		var route="{{url('usuarios/usuario')}}/"+id+"/listarpermisos";
		var token = $("#token").val();
		$.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: id,
            success: function(data){
                $("#permiso_rol").html('');
                $('select#permiso_rol').removeAttr('disabled');
                for(i=0; i<data[0].length;i++){
                	var fila = '<option value="'+data[0][i].id+'">'+data[0][i].name+'</option>';
                    $("select#permiso_rol").append(fila);
                    
                }
            }
		});
	}

	function ListarPermisosGrabados(id){
		var route="{{url('usuarios/usuario')}}/"+id+"/listarpermisosgb";
		var token = $("#token").val();
		$.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: id,
            success: function(data){
                $("table#table_permisos tbody").html('');
                if(data!=""){
                	for(i=0; i<data[0].length;i++){
                	var fila = '<tr role="row" class="odd" id="filaP_'+data[0][i].id+'"><td>'+data[0][i].id+'</td><td><span class="label label-default">'+data[0][i].name+'</span></td><td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"></i>&nbsp;&nbsp;'+data[0][i].slug+'</a></td><td>'+data[0][i].description+'</td>';
                		var ind = data[0][i].ind;
                		if(ind=='0'){
                			 fila += '<td><a class="btn  btn-danger btn-xs" href="javascript:QuitarPermiso('+data[0][i].idrol+', '+data[0][i].id+');"  ><i class="fa fa-fw fa-remove"></i></button></td>';
                		}else{
                			fila += '';
                		}
                	fila += '</tr>';		
                    $("table#table_permisos tbody").append(fila);
                	}
            	}else if(data==""){
            		var fila = '<tr role="row" class="odd" id="filaP_0"><td colspan="5" class="text-center">No cuenta con Permisos registrados</td></tr>';
            		$("table#table_permisos tbody").append(fila);
            	}
            }
		});	
	}

	$('#btn_apermiso').on('click',function(){
		var p = $('#permiso_rol').val();
		if(p!='nn'){
			Agregar_Permiso();
		}
	});

	function Agregar_Permiso()
	{
		$.alertable.confirm("¿Desea asignar el permiso al rol seleccionado?").then(function() { 
			var idp = $('#permiso_rol').val();	
			var idr = $('#rol_sel').val();	
			var obj = {'rol_sel':idr,'permiso_rol':idp};
			var route="{{url('usuarios/usuario')}}/"+idp+"/agregarpermiso";
			var token = $("#token").val();
			$.ajax({
            	url: route,
            	headers: {'X-CSRF-TOKEN':token},
            	type:'post' ,
            	datatype: 'json',
            	data: obj,
            	success: function(data){
            		$.alertable.alert('Permiso asignado correctamente!');
            		$("#permiso_rol").html('');
            		$("table#table_permisos tbody").html('');
            		for(i=0; i<data['permisosno'].length;i++){
                		var fila = '<option value="'+data['permisosno'][i].id+'">'+data['permisosno'][i].name+'</option>';
                    	$("select#permiso_rol").append(fila);
	                }	

	               	for(i=0; i<data['permisossi'].length;i++){
                	var fila = '<tr role="row" class="odd" id="filaP_'+data['permisossi'][i].id+'"><td>'+data['permisossi'][i].id+'</td><td><span class="label label-default">'+data['permisossi'][i].name+'</span></td><td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"></i>&nbsp;&nbsp;'+data['permisossi'][i].slug+'</a></td><td>'+data['permisossi'][i].description+'</td>';
                		var ind = data['permisossi'][i].ind;
                		if(ind=='0'){
                			 fila += '<td><a class="btn  btn-danger btn-xs" href="javascript:QuitarPermiso('+data['permisossi'][i].idrol+', '+data['permisossi'][i].id+');"  ><i class="fa fa-fw fa-remove"></i></button></td>';
                		}else{
                			fila += '';
                		}
                	fila += '</tr>';		
                    $("table#table_permisos tbody").append(fila);
                	}
            	},
            	error : function(xhr, status) {
        			$.alertable.alert('Ha ocurrido un error, revise su conexion e intentelo nuevamente ');
    			}
			});

		});
	}

	$('#btn_cpermiso').on('click',function(e){
		e.preventDefault();
		var name = $('#permiso_nombre').val();
		var slug = $('#permiso_slug').val();
		var desc = $('#permiso_descripcion').val();
		if( name=="" || slug=="" || desc==""){
			$.alertable.alert('Favor de ingresar los datos');
		}else{
			CrearPermiso(name,slug,desc);
		}
	});

	function CrearPermiso(name,slug,desc){
		var obj = {'name':name,'slug':slug,'desc':desc};
		var route="{{url('usuarios/usuario/crearpermiso')}}";
		var token = $("#token").val();
		$.ajax({
            	url: route,
            	headers: {'X-CSRF-TOKEN':token},
            	type:'post' ,
            	datatype: 'json',
            	data: obj,
            	success: function(data){
            		if(data.ind==0 || data.ind==2){
            			$.alertable.alert(data.msg);
            		}else{
            			$.alertable.alert(data.msg);
            			LimpiarCotroles();
                		var fila = '<option value="'+data['permiso'][0].id+'">'+data['permiso'][0].name+'</option>';
                    	$("select#permiso_rol").append(fila);
            		}
            	}	
		});

	}

	function QuitarPermiso(idrol,idpermiso){
		$.alertable.confirm("El permiso seleccionado está asociado al rol, si continúa se eliminará esta relación. ¿Desea continuar?. ").then(function(){ 
				var obj = {'idrol':idrol,'idpermiso':idpermiso};
				var token = $("#token").val();
				var route="{{url('usuarios/usuario/quitarpermiso')}}";
				$.ajax({
            			url: route,
            			headers: {'X-CSRF-TOKEN':token},
            			type:'post' ,
            			datatype: 'json',
            			data: obj,
            			success: function(data){
            				$.alertable.alert(data.msg);
            				$("#permiso_rol").html('');
            				for(i=0; i<data['permisosno'].length;i++){
                				var fila = '<option value="'+data['permisosno'][i].id+'">'+data['permisosno'][i].name+'</option>';
                    			$("select#permiso_rol").append(fila);
	                		}	
            				$("table#table_permisos tbody #filaP_"+idpermiso).remove();

            			}
				});
		});
	}

	function LimpiarCotroles(){
		$('#permiso_nombre').val("");
		$('#permiso_slug').val("");
		$('#permiso_descripcion').val("");
	}

	
</script>