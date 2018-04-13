@extends('layouts.app')
@section('htmlheader_title')
    Detalle de Producto
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <form  id="f_crear_rol" class="formentrada">
                                <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" id="idprod" name="idprod" value="{{$producto->ID_Producto}}">
                                <input type="hidden" id="iduser" name="iduser" value="{{$producto->iduser}}">
                                    <div class="col-md-6">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="box box-primary  box-gris">
                                                    <div class="box-header with-border my-box-header">
                                                        <p class="box-title">Detalle de Producto</p>
                                                    </div><!-- /.box-header -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 1.5em;">
                                            <div class="col-md-4">
                                                <label>Nombre del Producto:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="nombre_producto" name="nombre_producto" class="form-control" value="{{$producto->Nombre}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 1.5em;">
                                            <div class="col-md-6">
                                                <div class="row" style="margin-bottom: 1.5em;">
                                                    <div class="col-md-4">
                                                        <label>Precio Venta:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="precio_pu" name="precio_pu" class="form-control" value="{{$producto->PU_Venta}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-bottom: 1.5em;">
                                                    <div class="col-md-4">
                                                        <label>Precio Compra:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="precio_fe" name="precio_fe" class="form-control" value="{{$producto->PU_Compra}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row" style="margin-bottom: 1.5em;">
                                                    <div class="col-md-4">
                                                        <label>Stock:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="stock" name="stock" class="form-control" value="{{$producto->Stock}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-bottom: 1.5em;">
                                                    <div class="col-md-4">
                                                        <label>Stock Mín.:</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="stock_min" name="stock_min" class="form-control" value="{{$producto->Stock_Min}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 1.5px;">
                                            <div class="col-md-4">
                                                <div class="row" style="margin-bottom: 1.5px;">
                                                    <div class="col-md-12">
                                                        <label>Marca:</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="contenedor">
                                                            <div id="select_marca">
                                                                <select id="id_marca" name="id_marca" class="form-control" disabled>
                                                                    <option value="">Seleccione una Marca</option>
                                                                    @foreach($marcas as $marca)
                                                                        @if($marca->ID_Marca = $producto->ID_Marca)
                                                                        <option value="{{$marca->ID_Marca}}" selected>{{$marca->Nombre}}</option>
                                                                        @else
                                                                        <option value="{{$marca->ID_Marca}}">{{$marca->Nombre}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row" style="margin-bottom: 1.5px;">
                                                    <div class="col-md-12">
                                                        <label>Categoría:</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="contenedor">
                                                            <div id="select_categoria">
                                                                <select id="id_categoria" name="id_categoria" class="form-control" disabled>
                                                                    <option value="">Seleccione una Categoría</option>
                                                                    @foreach($categorias as $categoria)
                                                                        @if($categoria->ID_Categoria = $producto->ID_Categoria)
                                                                        <option value="{{$categoria->ID_Categoria}}" selected>{{$categoria->Nombre}}</option>
                                                                        @else
                                                                        <option value="{{$categoria->ID_Categoria}}">{{$categoria->Nombre}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row" style="margin-bottom: 1.5px;">
                                                    <div class="col-md-12">
                                                        <label>Modelo:</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="contenedor">
                                                            <div id="select_modelo">
                                                                <select id="id_modelo" name="id_modelo" class="form-control" disabled>
                                                                    <option value="">Seleccione un Modelo</option>
                                                                    @foreach($modelos as $modelo)
                                                                        @if($modelo->ID_Modelo = $producto->ID_Modelo)
                                                                        <option value="{{$modelo->ID_Modelo}}" selected>{{$modelo->Nombre}}</option>
                                                                        @else
                                                                        <option value="{{$modelo->ID_Modelo}}">{{$modelo->Nombre}}</option>    
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 1.5px;">
                                            <div class="col-md-12">
                                                <label>Descripción:</label>
                                                <textarea class="form-control ckeditor" row="5" name="desc" id="desc">{{$producto->Descripcion}}
                                                </textarea>
                                                <script>
                                                    CKEDITOR.replace( 'desc' );
                                                </script>
                                            </div>
                                        </div>
                                        <div class="box-footer text-center">
                                            <button class="btn btn-primary" type="button" id="btnedit">Editar</button>
                                            <button class="btn btn-success hidden" type="button" id="btneditar">Guardar</button>
                                            <button class="btn btn-default" type="button" id="btncancelar">Cancelar</button>
                                        </div>
                                    </div>
                            </form>
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="box box-primary  box-gris">
                                            <div class="box-header with-border my-box-header">
                                                <p class="box-title">Imágenes Referenciales</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="upload" id="upload" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" id="token"  value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" id="idprod" name="idprod" value="{{$producto->ID_Producto}}">
                                                <div class="row fileupload-buttonbar">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="ind" id="ind" value='0'>
                                                        <input type="hidden" name="ind_p" id="ind_p" value='1'>
                                                        <span class="btn btn-success fileinput-button" id="addfotos" disabled>
                                                            <i class="glyphicon glyphicon-plus"></i>
                                                            <span>Agregar Imágenes...</span>
                                                            <input type="file" name="file[]" multiple id="ImgPrd">
                                                        </span>
                                                        <button type="button" class="btn btn-danger delete" id="lmpfotos" disabled>
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            <span>Eliminar</span>
                                                        </button>
                                                        <input type="submit" name="Enviar" value="Guardar Imágenes" id="btnenviar" class="btn btn-success" disabled>        
                                                        <p>Nota: Max. 3 imágenes.</p>
                                                        <p>No se mantendrán los cambios hasta grabar.</p>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="msg"></div>
                                            
                                            <div id="seccionimg">
                                                @if(count($fotos)>0)
                                                    @foreach($fotos as $f)
                                                        <div class="row" style="padding: 10px;">
                                                            <div class="col-md-4">
                                                                <?php $ruta = str_replace("public","storage",$f->Nombre)?>
                                                                <img src="/<?php echo $ruta;?>" class="img-responsive">
                                                            </div>
                                                            <div class="col-md-8">
                                                                {{$f->Nombre_Org}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <script>
                                                    var form=document.getElementById('upload');
                                                    var request = new XMLHttpRequest();
                                                    if(form){
                                                        form.addEventListener('submit',function(e){
                                                        e.preventDefault();
                                                        var formData = new FormData(form);
                                                        request.open('post', '/almacen/producto/uploadedit/17');
                                                        request.addEventListener("load", transfcompleto);
                                                        request.send(formData);
                                                    });

                                                    
                                                }
                                            </script>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
@endsection
@push('script_trabajador')
    <script type="text/javascript" src="{{asset('js/producto/detalle.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.fileupload.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.alertable.min.js')}}"></script>
    <script>
        $('#btneditar').on('click',function(e){
        var idp = $('#idprod').val();
        var nom = $('#nombre_producto').val();
        var pu = $('#precio_pu').val();
        var fe = $('#precio_fe').val();
        var stock = $('#stock').val();
        var stock_min = $('#stock_min').val();
        var idm = $('#id_marca').val();
        var idc = $('#id_categoria').val();
        var idmo = $('#id_modelo').val();
        var desc = $('#desc').val();
        var id = $('#iduser').val();
        var rm = 'ruta';
        var token = $("#token").val();
        var ruta = "{{url('almacen/producto')}}/"+idp+"";
        var datos = {'Nombre':nom,'PU_Venta':pu,'PU_Compra':fe,'Stock':stock,'Stock_Min':stock_min,'ID_Marca':idm,
    'ID_Categoria':idc,'ID_Modelo':idmo,'Descripcion':desc,'Ruta_Imagen':rm,'iduser':id,'token':token};
    if(nom == "" || pu =="" || fe=="" || stock=="" || stock_min == "" || idm == "" || idc == "" || idmo =="" || desc == ""){
      $.alertable.alert("Para continuar por favor complete los datos");
    }else{
        $.alertable.confirm("¿Está seguro de editar los detalles del producto?").then(function(){
            $.ajax({
                    url: ruta,
                    headers: {'X-CSRF-TOKEN': token},
                    type: 'PUT',
                    dataType: 'json',
                    data: datos,
                    success: function (data) {
                        Deshabilitar();
                        console.log(datos);
                    }
            });
        });
    }
    /*console.log(datos);*/
    });

    function transfcompleto(data){
        response = JSON.parse(data.currentTarget.response);
        if(response.success){
            $.alertable.alert("Imágenes almacenadas correctamente");
            console.log(response.success);
        }
    }
    </script>
@endpush