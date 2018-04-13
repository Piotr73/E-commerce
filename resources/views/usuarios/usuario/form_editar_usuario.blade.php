<section >
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-primary box-gris">
                <div class="box-header with-border my-box-header">
                    <h3 class="box-title"><strong>Asignar rol</strong></h3>
                </div><!-- /.box-header -->
                <div id="zona_etiquetas_roles" style="background-color:white; padding-bottom: 10px;" >
                    <b>Roles asignados:</b>
                    <br>
                    @foreach($usuario->getRoles() as $rl)
                        <span class="label label-warning" style="margin-left:10px;">{{ $rl }} </span>
                    @endforeach
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2" for="tipo">Rol a asignar*</label>
                            <div class="col-sm-6" >
                                <select id="rol1" name="rol1" class="form-control">
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4" >
                                <button type="button" class="btn btn-sm btn-primary" onclick="asignar_rol({{ $usuario->id }});" >Asignar rol</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2" for="tipo">Rol a quitar*</label>
                            <div class="col-sm-6" >
                                <select id="rol2" name="rol2" class="form-control">
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4" >
                                <button type="button" class="btn btn-sm btn-primary" onclick="quitar_rol({{ $usuario->id }});" >Quitar rol</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--box -->
            <form id="FormEditUsuario">
            <div class="box box-primary box-gris">
                <div class="box-header with-border my-box-header">
                    <h3 class="box-title"><strong>Editar Información Usuario</strong></h3>
                </div><!-- /.box-header -->
                <hr style="border-color:white;" />
                <div id="notificacion_E2" ></div>
                <div class="box-body">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="token">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $usuario->id }}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4" for="nombre">Datos del Usuario*:</label>
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control" id="nombres" name="nombres"  value="{{$usuario->name }}"required   >
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                </div>
            </div>
            <div class="box box-primary   box-gris">
                <div class="box-header with-border my-box-header">
                    <h3 class="box-title"><strong>Acceso al sistema</strong></h3>
                </div><!-- /.box-header -->
                <div id="notificacion_E3" ></div>
                <div class="box-body">
                    <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
                        <h3 class="box-title">Datos de acceso</h3>
                    </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4" for="email">E-mail*:</label>
                                <div class="col-sm-8" >
                                    <input type="email" name="email" id="email" value="{{ $usuario->email}}" data-validation="email" class="form-control" data-validation-length="min4" required>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4" for="email">Nuevo Password*:</label>
                                <div class="col-sm-8" >
                                    <input type="password" data-validation="length" id="password" data-validation-length="min8" class="form-control" required="">
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-sm-4" for="email">Confirmar Password*:</label>
                                <div class="col-sm-8" >
                                    <input type="password" data-validation="length" id="newpassword" data-validation-length="min8" class="form-control">
                                </div>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <span id="res"></span>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-xs-12 box-gris text-center" style="padding-top: 20px;">
                            <button type="button" class="btn btn-primary" id="btneditar_usuario">Actualizar Usuario</button>
                        </div>
                </div>
            </div>
            <div id="mensaje_usuario_edit"></div>
            </form>
        </div>
    </div>
</section>
<script src="{{asset('js/val/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('js/val/lang/es.js')}}"></script>
<script>
    $(document).ready(function(){
        IniciarUsuario();
         $.validate({
            lang:'es'
        });
    });

    $("#btneditar_usuario").on('click',function(e){
        e.preventDefault();
        $('#mensaje_trabajador_edit').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');
        var id = $("#id_usuario").val();
        var usuario = $("#nombres").val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password2 = $('#newpassword').val();
        var route = "{{url('usuarios/usuario')}}/"+id+"";
        var token = $("#token").val();

        var dataString = {'name':usuario,'email':email,'password':password};
        if(password != password2){
            $.alertable.alert('Por favor ')
        }
        $.ajax({
            url:route,
            headers: {'X-CSRF-TOKEN':token},
            type:'PUT',
            dataType: 'json',
            data: dataString,
            success: function(data){
                if(data.success == 'true') {
                    $('#mensaje_usuario_edit').addClass('exito').html("El usuario ha sido actualizado con éxito.").show(300).delay(3000).hide(300);
                    IniciarUsuario();
                }else{
                    $('#mensaje_usuario_edit').addClass('error').html("Error al actualizar el usuario.").show(300).delay(3000).hide(300);
                }
            }
        });
    });

    function ValidarEmail(){
     document.getElementById('email').addEventListener('input', function() {
                campo = event.target;
            valido = document.getElementById('emailOK');        
            emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            if (emailRegex.test(campo.value)) {
                valido.innerText = "";
                email = $('#email').val();
                ValEmail(email);
            } else {
                valido.innerText = "Ingrese un email válido";
            }
        });
    }

    function Validarclave(){
      var min=8;

        $('#password').keyup(function() {
            var chars = $(this).val().length;
            var diff = min - chars;
            if(diff > 0){
                $('#contador').html('Debe ingresar por lo menos 8 caracteres')
            }else if(diff=8){
                $('#contador').html('')
            }else{
                $('#contador').val('1');
                $('#contador').html('')
            }
        });

        $('#newpassword').keyup(function() {
            var chars = $(this).val().length;
            var diff = min - chars;
            if(diff > 0){
                $('#contador2').html('Debe ingresar por lo menos 8 caracteres')
            }else if(diff=8){
                $('#contador2').html('')
            }else{
                $('#contador').val('1');
                $('#contador').html('')
            }
        });
    }

        var cambioDePass = function() {
            var c = $('#password').val();
            var c2 = $('#newpassword').val();
            if(c == "" || c2 ==""){
                $('#res').val('0');
                $('#res').html("");
            }
            if (c == c2 && c != "" && c2 !="") {
                $('#res').val('1');
                $('#res').html("Las constraseñas coinciden");
            } else if(c != c2 && c != "" && c2 !=""){
                $('#res').val('0');
                $('#res').html("Las constraseñas no coinciden");
                }
            }
            $("#password").on('keyup', cambioDePass);
            $("#newpassword").on('keyup', cambioDePass);

</script>