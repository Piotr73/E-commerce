@extends('layouts.app')
@section('htmlheader_title')
    Personas
@endsection
@section('contentheader_description')
    Listado de Clientes
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="box-header">
                <input type="hidden" id="t_persona" value="{{$tipo}}">
                <form   action="{{url('personal/getclientesInfo')}}"  method="get" id="frmsearch">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" onkeyup="" placeholder="Buscar Cliente">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <div class="x_content" id="detalle_clientes"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script_trabajador')
<script src="{{asset('js/val/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('js/val/lang/es.js')}}"></script>
<script>
    $(document).ready(function(){
        IniciarCliente();
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
            $("#detalle_clientes").html(data);
        });
    });

    function IniciarCliente(){
        $('#detalle_clientes').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}">');
        var search = "";
        getClientes(1,search);
    }
    //script para pagination
    var click = $(document).on('click','.pagination li a',function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getClientes(page,$("#search").val());
    });

    function getClientes(page,search)
    {
        var url ="{{url('personal/getclientesinfosearch')}}";
        $.ajax({
            type:'get',
            url: url+'?page='+page,
            data:{'search':search}
        }).done(function(data){
            $("#detalle_clientes").html(data);
        });
    }

    var EliminarCliente = function (id,name) {
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
