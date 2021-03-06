@extends('layouts.app')
@section('htmlheader_title')
    Marcas
@endsection
@section('contentheader_description')
    Listado de Marcas
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="box-header">
                <form   action="{{url('marca/getmarcasInfo')}}"  method="get" id="frmsearch">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" onkeyup="" placeholder="Buscar Marca">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="margin" id="botones_control">
                    <button class="btn btn-sm btn-primary" id="btn_newmarca" style="margin-top: 10px;"><i class="fa fa-plus"></i> Nueva Marca</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <div class="x_content" id="detalle_marcas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('almacen.marca.modal')
    </section>

@endsection

@push('script_trabajador')
<script>
    $(document).ready(function(){
        IniciarMarca();
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
            $("#detalle_marcas").html(data);
        });
    });

    function IniciarMarca(){
        var search = "";
        getMarcas(1,search);
    }
    //script para pagination
    var click = $(document).on('click','.pagination li a',function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getMarcas(page,$("#search").val());
    });

    function getMarcas(page,search)
    {
        var url ="{{url('marca/getmarcasinfosearch')}}";
        $.ajax({
            type:'get',
            url: url+'?page='+page,
            data:{'search':search}
        }).done(function(data){
            $("#detalle_marcas").html(data);
        });
    }

    $('#btn_newmarca').on('click',function(e){
        $('#FormCreateMarca')[0].reset();
        $('#reg_marca').modal({
            show:true,
            backdrop:'static'
        });
    });
    $('#btnregistrar_marca').on('click',function(e)
    {
        $('#mensaje_marca').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');
        var nombre = $('#nombre_marca').val();
        var descripcion = $('#descripcion_marca').val();
        var token = $("input[name=_token]").val();
        var route = "";
        var dataString = "Nombre="+nombre+"&Descripcion="+descripcion;
        if(nombre==""|| descripcion==""){
            $('#mensaje_marca').addClass('error').html('Por favor complete el formulario').show(300).delay(3000).hide(300);
        }else {
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',
                data: dataString,
                success: function (data) {
                    if (data.success == 'true') {
                        /*var fila = '<tr class="id'+data.ID_Marca+'"><td>'+data.Nombre+'</td><td>'+data.Descripcion+'</td><td><a title="Editar Marca" alt="Editar Marca" href="javascript:EditarMarca('+data.ID_Marca+')" class="btn btn-warning"><i class="fa fa-edit"></i></a><a title="Eliminar Marca" alt="Eliminar Marca" href="" class="btn btn-danger"><i class="fa fa-trash"></i></a></td></tr>';
                         $("#detalle_marcas").append(fila);*/
                        $('#mensaje_marca').addClass('exito').html("La Marca <b>" + data.Nombre + "</b> ha sido creada").show(300).delay(3000).hide(300);
                        $('#FormCreateMarca')[0].reset();
                        IniciarMarca();
                    } else {
                        $('#mensaje_marca').addClass('error').html('Error al registrar la Marca').show(300).delay(3000).hide(300);
                        $('#nombre_marca').focus();
                    }
                },
                error: function (data) {
                    $('#mensaje_marca').addClass('error').html('Error al registrar la Marca').show(300).delay(3000).hide(300);
                    $('#nombre_marca').focus();
                    return false;
                }
            });
        }
    });

    var EditarMarca = function(id) {
        var route = "{{url('almacen/marca')}}/" + id + "/edit";
        $.get(route, function (data) {
            $('#id_marca').val(data.ID_Marca);
            $('#nombre_edit').val(data.Nombre);
            $('#descripcion_edit').val(data.Descripcion);
            $('#edit_marca_mod').modal({
                show: true,
                backdrop: 'static'
            });
            return false;
        });
    }

    $("#btnedit_marca").on('click',function(e){
        e.preventDefault();
        $('#mensaje_marca_edit').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');
        var id = $("#id_marca").val();
        var nombre = $("#nombre_edit").val();
        var descripcion = $("#descripcion_edit").val();
        var route = "{{url('almacen/marca')}}/"+id+"";
        var token = $("#token").val();
        var dataString = {'Nombre':nombre,'Descripcion':descripcion};
        if(id==""||nombre==""|| descripcion==""){
            $('#mensaje_marca_edit').addClass('error').html('Por favor complete el formulario').show(300).delay(3000).hide(300);
        }else {
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'PUT',
                dataType: 'json',
                data: dataString,
                success: function (data) {
                    if (data.success == 'true') {
                        $('#mensaje_marca_edit').addClass('exito').html("La marca <b>" + data.Nombre + "</b> ha sido actualizada con éxito.").show(300).delay(3000).hide(300);
                        IniciarMarca();
                    }
                }
            });
        }
    });

    var EliminarMarca = function (id,name) {
        $.alertable.confirm("¿Está seguro de elminar la Marca?:"+name).then(function(){
            var route = "{{url('almacen/marca')}}/"+id+"";
            var token = $("#token").val();

            $.ajax({
                url:route,
                headers:{'X-CSRF-TOKEN' : token},
                type: 'DELETE',
                dataType: 'json',
                success: function(data){
                    if(data.success == 'true'){
                        $('#detalle_marcas').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}">');
                        IniciarMarca();
                    }
                }
            });
        });
    }

    $('.alphaonly').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ]/g,'') ); }
    );

</script>
@endpush
