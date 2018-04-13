@extends('layouts.app')
@section('htmlheader_title')
    Productos
@endsection
@section('contentheader_description')
    Listado de Productos
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="box-header">
                <form   action="{{url('producto/getproductosInfo')}}"  method="get" id="frmsearch">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" onkeyup="" placeholder="Buscar Producto">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="margin" id="botones_control">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="cargar_formulario(4);" > <i class="fa fa-plus"></i> Nuevo Producto</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <div class="x_content" id="detalle_productos"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('almacen.producto.modal')        
    </section>
@endsection
@push('script_trabajador')
    <script type="text/javascript" src="{{asset('js/producto/producto.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.fileupload.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.alertable.min.js')}}"></script>
    
    <script>
        $(document).ready(function(){
            IniciarProducto();
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
                $("#detalle_productos").html(data);
            });
        });

        function IniciarProducto(){
            var search = "";
            getProductos(1,search);
        }
        //script para pagination
        var click = $(document).on('click','.pagination li a',function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getProductos(page,$("#search").val());
        });

        function getProductos(page,search)
        {
            var url ="{{url('producto/getproductosinfosearch')}}";
            $.ajax({
                type:'get',
                url: url+'?page='+page,
                data:{'search':search}
            }).done(function(data){
                $("#detalle_productos").html(data);
            });
        }

        $('#btn_newproducto').on('click',function(e){
            $('#FormCreateProducto')[0].reset();
            $('#reg_producto_mod').modal({
                show:true,
                backdrop:'static'
            });
        });

        var EliminarProducto = function (id,name) {
            $.alertable.confirm("¿Está seguro de elminar el Producto?: "+name).then(function(){
                var route = "{{url('almacen/producto')}}/"+id+"";
                var token = $("#token").val();

                $.ajax({
                    url:route,
                    headers:{'X-CSRF-TOKEN' : token},
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data){
                        if(data.success == 'true'){
                           $.alertable.alert('Producto eliminado correctamente');
                            IniciarProducto();
                        }
                    }
                }); 
            });
        }


        var ActualizarStock = function(id) {
            var route = "{{url('almacen/producto')}}/" + id + "/stock";
            $.get(route, function (data) {
                $('#FormUpdateStock')[0].reset();
                $('#id_producto_act').val(data.ID_Producto);
                $('#stock_actual').val(data.Stock);
                var stock = parseInt($('#stock_actual').val());
                var stock_aum = parseInt($('#stock_aument').val());
                var stock_total = stock+stock_aum;
                $('#stock_total').val(stock_total);
                $('#upd_stock_mod').modal({
                    show: true,
                    backdrop: 'static'
                });
                return false;
            });
        }

        $("#btnAct_Stock").on('click',function(e){
            e.preventDefault();
            $('#mensaje_stock').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');

            var id = $('#id_producto_act').val();
            var route = "{{url('almacen/producto')}}/"+id+"/UpdStock";
            var stock = $('#stock_total').val();
            var token = $("#token").val();
            var dataString = {'stock':stock};
            $.ajax({
                url:route,
                headers: {'X-CSRF-TOKEN':token},
                type:'post',
                dataType: 'json',
                data: dataString,
                success: function(data){
                    if(data.success == 'true') {
                        $.alertable.alert('El stock se actualizó correctamente.');
                        $('#mensaje_stock').addClass('text-center').html('');
                        IniciarProducto();
                    }
                }
            });
        });

        $(".numeros").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;}        
        });

        $('#btn_validar').on('click',function(){
            ValidarStock(0,0);
        });

    function ValidarStock(id,id2){ /* id= id de venta e id2 proceso*/
        var val = id;
        var val2 = id2;
        var route = "{{url('almacen/producto')}}/"+val+"/ValidarStock";
        var dato = {id:val,proc:val2}
        var token = $("#token").val();
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: dato,
            success:function(data)
            {
                $('#FormShowStock')[0].reset();
                $("#stock_mod #stock tbody").html('');
                for(i=0; i<data.length;i++){
                    var fila = '<tr><td>'+data[i].Marca+'</td><td>'+data[i].Articulo+'</td><td class="text-right">'+data[i].Stock+'</td></tr>';    
                    $("#stock_mod #stock").append(fila);
                }
                //console.log("id1:"+data[0].ID_Producto+" id2:"+data[1].ID_Producto);
                $('#stock_mod').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
                
            },
        }); 
    }

    $('#btn_val').on('click',function(e){
        var arrayStocks = new Array();
        var stocks = new Object();
        stocks.ID_Producto = 116;
        stocks.Cantidad = 80;
        arrayStocks.push(stocks);
        var stocks2 = new Object();
        stocks2.ID_Producto = 117;
        stocks2.Cantidad = 90;
        arrayStocks.push(stocks2);
        var token = $("input[name=_token]").val();
        var stocks = {"stocks":arrayStocks};

        var route = "{{url('ventas/venta/create/valstock')}}";

         console.log(stocks);
        if(stocks != ""){
            $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type:'post' ,
            datatype: 'json',
            data: stocks,
            success:function(data)
            {
                console.log(data);
            }});
        }
    });

    </script>

@endpush
