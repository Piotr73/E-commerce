@extends('layouts.app')
@section('htmlheader_title')
    Personas
@endsection
@section('contentheader_description')
    Listado de Personal
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="box-header">
                <input type="hidden" id="t_persona" value="{{$tipo}}">
                <form   action="{{url('personal/gettrabajadoresInfo')}}"  method="get" id="frmsearch">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" onkeyup="" placeholder="Buscar Trabajador">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="margin" id="botones_control">
                    <button class="btn btn-sm btn-primary" id="btn_newtrabajador" style="margin-top: 10px;"><i class="fa fa-plus"></i> Nuevo Trabajador</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <div class="x_content" id="detalle_trabajadores"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('usuarios.trabajador.modal')
    </section>

@endsection
@push('script_trabajador')
<script src="{{asset('js/val/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('js/val/lang/es.js')}}"></script>
<script>
    $(document).ready(function(){
        IniciarTrabajador();
         $.validate({
            lang:'es'
        });
    });
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
            $("#detalle_trabajadores").html(data);
        });
    });

    function IniciarTrabajador(){
        $('#detalle_trabajadores').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}">');
        var search = "";
        getTrabajadores(1,search);
    }
    //script para pagination
    var click = $(document).on('click','.pagination li a',function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getTrabajadores(page,$("#search").val());
    });

    function getTrabajadores(page,search)
    {
        var url ="{{url('personal/gettrabajadoresinfosearch')}}";
        $.ajax({
            type:'get',
            url: url+'?page='+page,
            data:{'search':search}
        }).done(function(data){
            $("#detalle_trabajadores").html(data);
        });
    }

    $('#btn_newtrabajador').on('click',function(e){
        $('#FormCreateTrabajador')[0].reset();
        $('#reg_trabajador').modal({
            show:true,
            backdrop:'static'
        });
    });

    $('#btnregistrar_trabajador').on('click',function (e)
    {
        e.preventDefault();
        $('#mensaje_trabajador').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');
        var nombres = $('#nombres').val();
        var ap_pat = $('#apellido_paterno').val();
        var ap_mat = $('#apellido_materno').val();
        var dni = $('#dni_t').val();
        var ruc = $('#ruc').val();
        var tipo = $('#t_persona').val();
        var token = $("input[name=_token]").val();
        var route = "{{route('trabajador.store')}}";
        var dataString = {'Nombre':nombres,'Ap_Paterno':ap_pat,'Ap_Materno':ap_mat,'DNI':dni,'RUC':ruc,'ID_Tipo':tipo};
        console.log(dataString);
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: dataString
        }).done( function(data)
        {
            if(data.success == 'true')
            {
                $.alertable.alert("Personal registrado").always(function() {});
                $('#FormCreateTrabajador')[0].reset();
                IniciarTrabajador();
            }else{
                $.alertable.alert("Error al registrar al personal").always(function() {});
                $('#nombres').focus();
            }
        }).fail( function()
        {
            $.alertable.alert("Error al registrar al personal").always(function() {});
            $('#nombres').focus();
            IniciarTrabajador();
        }) ;
    });

    var EditarPersonal = function(id) {
        var route = "{{url('personas/trabajador')}}/" + id + "/edit";
        $.get(route, function (data) {
            $('#id_trabajador').val(data.ID_Persona);
            $('#nombres_edit').val(data.Nombre);
            $('#ap_paterno_edit').val(data.Ap_Paterno);
            $('#ap_materno_edit').val(data.Ap_Materno);
            $('#dni_edit').val(data.DNI);
            $('#ruc_edit').val(data.RUC);
            $('#edit_trabajador_mod').modal({
                show: true,
                backdrop: 'static'
            });
            return false;
        });
    }

    $("#btnedit_trabajador").on('click',function(e){
        e.preventDefault();
        $('#mensaje_trabajador_edit').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');
        var id = $("#id_trabajador").val();
        var nombre = $("#nombres_edit").val();
        var ap_pat = $('#ap_paterno_edit').val();
        var ap_mat = $('#ap_materno_edit').val();
        var dni = $('#dni_edit').val();
        var ruc = $('#ruc_edit').val();
        var route = "{{url('personas/trabajador')}}/"+id+"";
        var token = $("#token").val();
        var dataString = {'Nombre':nombre,'Ap_Paterno':ap_pat,'Ap_Materno':ap_mat,'DNI':dni,'RUC':ruc};
        $.ajax({
            url:route,
            headers: {'X-CSRF-TOKEN':token},
            type:'PUT',
            dataType: 'json',
            data: dataString,
            success: function(data){
                if(data.success == 'true') {
                    $.alertable.alert("Personal actualizado correctamente.");
                    IniciarTrabajador();
                }
            }
        });
    });

    var EliminarPersonal = function (id,name) {
        $.alertable.confirm("¿Está seguro de eliminar al personal?: "+name).then(function(){
            var route = "{{url('personas/trabajador')}}/"+id+"";
            var token = $("#token").val();
            $.ajax({
                url:route,
                headers:{'X-CSRF-TOKEN' : token},
                type: 'DELETE',
                dataType: 'json',
                success: function(data){
                    if(data.success == 'true'){
                        $.alertable.alert("Personal eliminado correctamente");
                        IniciarTrabajador();
                    }
                }
            });
        });
    }


    $('.alphaonly').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ]/g,'') ); }
    );

    $(".numeros").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    </script>
@endpush
