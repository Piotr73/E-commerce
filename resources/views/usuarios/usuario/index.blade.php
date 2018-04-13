@extends('layouts.app')

@section('htmlheader_title')
    Usuarios
@endsection
@section('contentheader_description')
    Lista de Usuarios
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="box-header">
                <h4 class="box-title">Usuarios</h4>
                <form action="{{url('usuario/getusuariosInfo')}}" method="get" id="frmsearch">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" onkeyup="" placeholder="Buscar Usuario">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="margin" id="botones_control">
                    <button id="btn_newusuario" class="btn btn-sm btn-primary" >Agregar Usuario</button>
                    <a href="{{ url("/usuarios/usuario") }}"  class="btn btn-sm btn-primary" >Listado Usuarios</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="cargar_formulario(2);">Roles</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="cargar_formulario(3);" >Permisos</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <div class="x_content" id="detalle_usuarios"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('usuarios.usuario.modal')
@endsection
@push('script_trabajador')
<script src="{{asset('js/val/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('js/val/lang/es.js')}}"></script>
<script>
    $(document).ready(function(){
        IniciarUsuario();
        Validarclave();  
        $.validate({
            lang:'es'
        });
    });


    function ValidarEmail(){
        document.getElementById('email').addEventListener('input', function() {
                campo = event.target;
            valido = document.getElementById('emailOK');        
            emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            if (emailRegex.test(campo.value)) {
                valido.innerText = "";
                $('#inde').val('1');
            }
        });
    }

    function HabilitarButon(){
        $('#FormCreateUsuario').bind('change keyup', function() {
            if($(this).validate().checkForm()) {
                $('#btnregistrar_usuario').attr('disabled', false);
                    } else {
                $('#btnregistrar_usuario').attr('disabled', true);} 
            });
    }

    function Validarclave(){
         var min=8;
        $('#password').keyup(function() {
            var chars = $(this).val().length;
            var diff = min - chars;
            if(diff<=0){
                $('#indp').val('1');
            }
        });
    }


    function ObtenerFechaActual(){ 
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1; //hoy es 0!
        var yyyy = hoy.getFullYear();
        if(dd<10) {
        dd='0'+dd
        }
        if(mm<10) {
            mm='0'+mm
        }
        hoy = dd+'/'+mm+'/'+yyyy;
        return hoy;
    }

    $("#frmsearch").on("submit",function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        var get = $(this).attr('method');

        $.ajax({
            type: get,
            url: url,
            data: data,

        }).done(function(data){
            $("#detalle_usuarios").html(data);
        });
    });

    function IniciarUsuario(){
        $('#detalle_usuarios').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}">');
        var search = "";
        getUsuarios(1,search);
    }
    //script para pagination
    var click = $(document).on('click','.pagination li a',function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getUsuarios(page,$("#search").val());
    });

    function getUsuarios(page,search)
    {
        var url ="{{url('usuario/getusuariosinfosearch')}}";
        $.ajax({
            type:'get',
            url: url+'?page='+page,
            data:{'search':search}
        }).done(function(data){
            $("#detalle_usuarios").html(data);
        });
    }

    $('#btn_newusuario').on('click',function(e){
        $('#FormCreateUsuario')[0].reset();
        $('.icheckbox_flat-green').removeClass('checked');
        $('#fecha').val(ObtenerFechaActual());
        $('#reg_usuario').modal({
            show:true,
            backdrop:'static'
        });
         
    });

    $('#btnregistrar_usuario').on('click',function(e){
        e.preventDefault();
        var datosTrabajador = document.getElementById('ID_Trabajador').value.split('_');
        var usuario = datosTrabajador[1];
        var id_trabj = datosTrabajador[0];
        var email = $('#email_u').val();
        var password = $('#password').val();
        var token = $("input[name=_token]").val();
        var cadena = {'ID_Trabajador':id_trabj,'name':usuario,'email':email,'password':password};
        var route ="";
        if(id_trabj==""){
            $.alertable.alert('Por favor, seleccione al trabajador');
        }else if(email == "" || password==""){
            $.alertable.alert('Por favor, seleccione al trabajador');
        }else{
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: cadena,
            success:function(data)
            {

                if(data.success == 'true')
                {
                    $('#mensaje_usuario').addClass('exito').html("El Usuario ha sido registrado").show(300).delay(3000).hide(300);
                    $('#FormCreateUsuario')[0].reset();
                    $('#fecha').val(ObtenerFechaActual());
                    IniciarUsuario();
                }else{
                    $('#mensaje_usuario').addClass('error').html('Error al registrar al usuario. Revise los datos').show(300).delay(3000).hide(300);
                    $('#name').focus();
                }
            },
            fail:function(){
                $('#mensaje_usuario').addClass('error').html('Ha ocurrido un error.Por favor, revise su conexión o comuníquese con el Administrador del Sistema.').show(300).delay(3000).hide(300);
                $('#name').focus();
                IniciarUsuario();
            }
        });
        }
    });

    function EditarUsuario(arg){
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl =urlraiz+"/form_editar_usuario/"+arg+"";
        $("#capa_modal").show();
        $("#capa_formularios").show();
        var screenTop = $(document).scrollTop();
        $("#capa_formularios").css('top', screenTop);
        $("#capa_formularios").html($("#cargador_empresa").html());
        $.ajax({
            url: miurl
        }).done( function(resul)
        {
            $("#capa_formularios").html(resul);
        }).fail( function()
        {
            $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
        }) ;
    }

    var EliminarUsuario = function (id,iduser) {
        $.alertable.confirm("¿Está seguro de Eliminar al Usuario?").then(function(){
            var obj = {'id':id, 'iduser': iduser};
            var token = $("#token").val();
            var route = "{{url('usuarios/usuario')}}/"+id+"/eliminarusuario";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type:'post' ,
                datatype: 'json',
                data: obj,
                success: function(data){
                    if(data.success == 'true'){
                        $('#detalle_usuarios').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}">');
                        IniciarUsuario();
                    }else{
                        $.alertable.alert(data.success).always(function() {
                        });
                        
                    }
                }
            });
        });
    }



</script>
@endpush