<section>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary  box-gris">
                <div class="box-header with-border my-box-header">
                    <h3 class="box-title"><strong>Nuevo Producto</strong></h3>
                </div><!-- /.box-header -->
            </div>
        </div>
    </div>
    <div class="row">
        <form id="upload" enctype="multipart/form-data" class="formentrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="id_user" value="{{$id}}">
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
                            <input type="text" id="nombre_producto" name="nombre_producto" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1.5em;">
                        <div class="col-md-6">
                            <div class="row" style="margin-bottom: 1.5em;">
                                <div class="col-md-4">
                                    <label>Precio Venta:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" id="precio_pu" name="precio_pu" class="form-control">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 1.5em;">
                                <div class="col-md-4">
                                    <label>Precio Compra:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" id="precio_fe" name="precio_fe" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row" style="margin-bottom: 1.5em;">
                                <div class="col-md-4">
                                    <label>Stock:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" id="stock" name="stock" class="form-control">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 1.5em;">
                                <div class="col-md-4">
                                    <label>Stock Mín.:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" id="stock_min" name="stock_min" class="form-control">
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
                                            <select id="id_marca" name="id_marca" class="form-control">
                                                <option value="">Seleccione una Marca</option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{$marca->ID_Marca}}">{{$marca->Nombre}}</option>
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
                                            <select id="id_categoria" name="id_categoria" class="form-control">
                                                <option value="">Seleccione una Categoría</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->ID_Categoria}}">{{$categoria->Nombre}}</option>
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
                                            <select id="id_modelo" name="id_modelo" class="form-control">
                                                <option value="">Seleccione un Modelo</option>
                                                @foreach($modelos as $modelo)
                                                    <option value="{{$modelo->ID_Modelo}}">{{$modelo->Nombre}}</option>
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
                            <textarea class="form-control CKEDITOR" row="5" name="descripcion" id="descripcion"></textarea>
                            <textarea style="display:none;" id="desc_real" name="desc_real"></textarea>
                             <script>
                                CKEDITOR.replace( 'descripcion' );
                            </script>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <input type="button" name="Enviar" value="Registrar" id="btnenviar" class="btn btn-success">
                        <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancelar</button>
                    </div>
                </div>
        
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
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-lg-7">
                                            <input type="hidden" name="ind" id="ind">
                                            <span class="btn btn-success fileinput-button" id="addfotos">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Agregar Imágenes...</span>
                                                <input type="file" name="file[]" multiple id="ImgPrd">
                                            </span>
                                            <button type="button" class="btn btn-danger delete" id="lmpfotos">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                <span>Eliminar</span>
                                            </button>
                                            <p>Nota: Max. 3 imágenes.</p>
                                        </div>
                                    </div>
                                    
    </form>
                                <div id="msg"></div>
                                <div id="seccionimg"></div>
                                <script>
                                        var form=document.getElementById('upload');
                                        var request = new XMLHttpRequest();
                                        if(form){
                                            $('#btnenviar').on('click',function(e){
                                                e.preventDefault();
                                                var uno= CKEDITOR.instances.descripcion.getData();
                                                $('#desc_real').val(uno);
                                                var img = $('#ind').val();
                                                var val = validaciones(1);
                                                if(img == 0){
                                                    $.alertable.alert('Por favor agregue las imágenes referenciales');
                                                    return;
                                                }
                                                if(val == 1){
                                                    if(img == 0){
                                                        $.alertable.alert('Por favor agregue las imágenes referenciales');
                                                        return;
                                                    }else{
                                                        $.alertable.confirm("¿Desea registrar el producto?").then(function(){
                                                        var formData = new FormData(form);
                                                        request.open('post', '/almacen/producto');
                                                        request.addEventListener("load", transfcompleto);
                                                        request.send(formData);    
                                                        });    
                                                    }
                                                }else{
                                                    $.alertable.alert('Por favor complete los datos para continuar con el registro');                                    
                                                    return;
                                                }
                                            });

                                            function transfcompleto(data){
                                                response = JSON.parse(data.currentTarget.response);
                                                if(response.success){
                                                    $.alertable.alert('Producto registrado correctamente!.');
                                                    BloquearTodo();
                                                }else{
                                                    $.alertable.alert('Ocurrió un error, comunicarse con el Administrador.');
                                                }
                                            }
                                        }
                                </script>
                            </div>
                        </div>

                    </div>
                </div>
    </div>
</section>
<script type="text/javascript">
    $('#ImgPrd').on('change',function(){
        $('#seccionimg').html('');
        var archivos = document.getElementById('ImgPrd').files;
        var navegador = window.URL || window.webkitURL;
        $('#ind').val('1');
        for (x=0 ; x< 3; x++) 
          {
              var size = archivos[x].size;
              var type = archivos[x].type;
              var name = archivos[x].name;

              var objeto_url = navegador.createObjectURL(archivos[x]);

              $('#seccionimg').append("<div class='row' style='padding: 10px;'>"+
                "<div class='col-md-4'>"+
                    "<img src="+objeto_url+" class='img-responsive'>"+
                "</div><div class='col-md-8'>"+name+"</div></div>");
          }
    });

    $('#lmpfotos').on('click',function(e){
        e.preventDefault();
        $('#seccionimg').html('');
        $('#ind').val('0');
        document.getElementById("ImgPrd").value = null;
    });

    function validaciones(id){
            var n = $('#nombre_producto').val();
            var p = $('#precio_pu').val();
            var f = $('#precio_fe').val();
            var st = $('#stock').val();
            var stmin = $('#stock_min').val();
            var desc= CKEDITOR.instances.descripcion.getData();
            var mar = $('#id_marca').val();
            var cat = $('#id_categoria').val();
            var mod = $('#id_modelo').val();
            var ind = $('#ind').val();
            var id =$('#id_user').val();
            
            if(n=="" || p==""|f==""||st==""||stmin==""||desc==""||mar==""||cat==""||mod==""){
                return 0;
            }else{
                return 1;
            }
    }


        function BloquearTodo(){
            $('#nombre_producto').attr('disabled', 'disabled');
            $('#precio_pu').attr('disabled', 'disabled');
            $('#precio_fe').attr('disabled', 'disabled');
            $('#stock').attr('disabled', 'disabled');
            $('#stock_min').attr('disabled', 'disabled');
            $('#id_marca').attr('disabled', 'disabled');
            $('#id_categoria').attr('disabled', 'disabled');
            $('#id_modelo').attr('disabled', 'disabled');
            $('#descripcion').attr('disabled', 'disabled');
            $('#btnregistrar_producto').attr('disabled', 'disabled');
            $('#addfotos').attr('disabled', 'disabled');
            $('#lmpfotos').attr('disabled', 'disabled');
            $('#btnenviar').attr('disabled', 'disabled');
        }
</script>
