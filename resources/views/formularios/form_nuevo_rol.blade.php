<section  >
<div class="col-md-12">
    <div class="box box-primary  box-gris">
            <div class="box-header with-border my-box-header">
                <h3 class="box-title"><strong>Nuevo Rol</strong></h3>
            </div><!-- /.box-header -->
            <hr style="border-color:white;" />
            <div class="box-body">
            <form  id="f_crear_rol" class="formentrada"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="col-md-12">	  
	                <div class="form-group">
							<label class="col-sm-2" for="apellido">Nombre del Rol*</label>
	                    <div class="col-sm-10" >
							<input type="text" class="form-control" id="rol_nombre" name="rol_nombre" required >
	                    </div>
					</div><!-- /.form-group -->
			    </div><!-- /.col -->
				<div class="col-md-12">
	                <div class="form-group">
							<label class="col-sm-2" for="apellido">Slug*</label>
	                    <div class="col-sm-10" >
							<input type="text" class="form-control" id="rol_slug" name="rol_slug"  required >
	                    </div>
					</div><!-- /.form-group -->
			    </div><!-- /.col -->
				<div class="col-md-12">
	                <div class="form-group">
							<label class="col-sm-2" for="apellido">Descripcion*</label>
	                    <div class="col-sm-10" >
							<input type="text" class="form-control" id="rol_descripcion" name="rol_descripcion"  required >
	                    </div>
					</div><!-- /.form-group -->
			    </div><!-- /.col -->
                <div class="box-footer col-xs-12 box-gris text-center">
						<!--<button type="submit" class="btn btn-primary">Crear Nuevo Rol</button>-->
                        <button type="button" id="btn_arol" class="btn btn-primary">Crear Nuevo Rol</button>
                </div>
            </form>
            </div>
    </div>
</div>
<div class="col-md-12">
    <div class="table-responsive" >
	    <table  class="table table-hover table-striped" cellspacing="0" width="100%" id="tabla_roles">
				<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Slug</th>
							<th>Descripcion</th>
							<th>Acción</th>
						</tr>
				</thead>
	    		<tbody>
	    			@foreach($roles as $rol)
						<tr role="row" class="odd" id="filaR_{{$rol->id }}">
							<td>{{ $rol->id }}</td>
							<td><span class="label label-default">{{ $rol->name or "Ninguno" }}</span></td>
							<td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $rol->slug  }}</a></td>
							<td>{{ $rol->description }}</td>
							<td>
								<button type="button"  class="btn  btn-danger btn-xs" onclick="borrar_rol({{ $rol->id }});"   ><i class="fa fa-fw fa-remove"></i></button>
							</td>
						</tr>
	    			@endforeach	    			
				</tbody>
		</table>
	</div>
</div>
</section>

<script type="text/javascript">
	$('#btn_arol').on('click',function(e){
		e.preventDefault();
		var rol = $('#rol_nombre').val();	
		var slug = $('#rol_slug').val();
		var desc = $('#rol_descripcion').val();	
		if(rol=="" || slug=="" || desc==""){
			$.alertable.alert('Para continuar, complete los datos!');
		}else{
			$.alertable.confirm("¿Desea registrar el rol?").then(function(){
			var obj = {'rol':rol,'slug':slug,'descripcion':desc};
			var route="{{url('usuarios/usuario/agregarrol')}}";
			var token = $("#token").val();
			$.ajax({
            	url: route,
            	headers: {'X-CSRF-TOKEN':token},
            	type:'post' ,
            	datatype: 'json',
            	data: obj,
            	success: function(data){
            		LimpiarFormuliaro();
            		if(data.msg=='false'){
            			$.alertable.alert('Ha ocurrido un erro al crear, intente de nuevo o consulte con el administrador.');	
            		}else if(data.msg=='true'){
            			$.alertable.alert('El rol se ha registrado correctamente!');	
            			$("table#tabla_roles tbody").html('');
            			for(i=0; i<data['roles'].length;i++){
                		var fila = '<tr role="row" class="odd" id="filaR_'+data['roles'][i].id+'"><td>'+data['roles'][i].id+'</td><td><span class="label label-default">'+data['roles'][i].name+'</span></td><td class="mailbox-messages mailbox-name"><a href="javascript:void(0);" style="display:block"></i>&nbsp;&nbsp;'+data['roles'][i].slug+'</a></td><td>'+data['roles'][i].description+'</td>';
                		fila += '<td><button type="button"  class="btn  btn-danger btn-xs" onclick="borrar_rol('+data['roles'][i].id+');"   ><i class="fa fa-fw fa-remove"></i></button></td>';
                		fila +='</tr>';		
                    		$("table#tabla_roles tbody").append(fila);
            	     }
					}
				},
				error : function(xhr, status) {
        			$.alertable.alert('Ha ocurrido un error, revise su conexion e intentelo nuevamente ');
    				}
				});
		  });
		}
	});

	function LimpiarFormuliaro(){
		$('#rol_nombre').val('');
		$('#rol_slug').val('');
		$('#rol_descripcion').val('');
	}
</script>