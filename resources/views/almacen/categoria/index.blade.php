@extends('layouts.app')
@section('htmlheader_title')
    Categorías
@endsection
@section('contentheader_description')
    Listado de Categorías
@endsection
@section('main-content')
    <section  id="contenido_principal">
        <div class="box box-primary box-gris">
            <div class="box-header">
                <form   action="{{url('categoria/getcategoriasInfo')}}"  method="get" id="frmsearch">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" onkeyup="" placeholder="Buscar Categoría">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="margin" id="botones_control">
                    <button class="btn btn-sm btn-primary" id="btn_newcategoria" style="margin-top: 10px;"><i class="fa fa-plus"></i> Nueva Categoría</button>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-body box-white">
                        <div class="table-responsive" >
                            <div class="x_content" id="detalle_categorias"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('almacen.categoria.modal')
    </section>

@endsection

@push('script_trabajador')
<script>
    $(document).ready(function(){
        IniciarCategoria();
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
            $("#detalle_categorias").html(data);
        });
    });

    function IniciarCategoria(){
        var search = "";
        getCategorias(1,search);
    }
    //script para pagination
    var click = $(document).on('click','.pagination li a',function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getCategorias(page,$("#search").val());
    });

    function getCategorias(page,search)
    {
        var url ="{{url('categoria/getcategoriasinfosearch')}}";
        $.ajax({
            type:'get',
            url: url+'?page='+page,
            data:{'search':search}
        }).done(function(data){
            $("#detalle_categorias").html(data);
        });
    }

    $('#btn_newcategoria').on('click',function(e){
        $('#FormCreateCategoria')[0].reset();
        $('#reg_categoria').modal({
            show:true,
            backdrop:'static'
        });
    });

    

    var EditarCategoria = function(id) {
        var route = "{{url('almacen/categoria')}}/" + id + "/edit";
        $.get(route, function (data) {
            $('#id_categoria').val(data.ID_Categoria);
            $('#nombre_edit').val(data.Nombre);
            $('#descripcion_edit').val(data.Descripcion);
            $('#edit_categoria_mod').modal({
                show: true,
                backdrop: 'static'
            });
            return false;
        });
    }

    $("#btnedit_categoria").on('click',function(e){
        e.preventDefault();
        $('#mensaje_categoria_edit').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}"> Cargando...');
        var id = $("#id_categoria").val();
        var nombre = $("#nombre_edit").val();
        var descripcion = $("#descripcion_edit").val();
        var route = "{{url('almacen/categoria')}}/"+id+"";
        var token = $("#token").val();
        var dataString = {'Nombre':nombre,'Descripcion':descripcion};
        if(id==""|| nombre ==""||descripcion==""){
            $('#mensaje_categoria_edit').addClass('error').html("Por favor complete el formulario").show(300).delay(3000).hide(300);
        }else{
            $.ajax({
                url:route,
                headers: {'X-CSRF-TOKEN':token},
                type:'PUT',
                dataType: 'json',
                data: dataString,
                success: function(data){
                    if(data.success == 'true') {
                        $('#mensaje_categoria_edit').addClass('exito').html("La categoría <b>"+data.Nombre+"</b> ha sido actualizada con éxito.").show(300).delay(3000).hide(300);
                        IniciarCategoria();
                    }
                }
            });
        }

    });

    var EliminarCategoria = function (id,name) {
        $.alertable.confirm("¿Está seguro de elminar la Categoría?:"+name).then(function(){
            var route = "{{url('almacen/categoria')}}/"+id+"";
            var token = $("#token").val();

            $.ajax({
                url:route,
                headers:{'X-CSRF-TOKEN' : token},
                type: 'DELETE',
                dataType: 'json',
                success: function(data){
                    if(data.success == 'true'){
                        $('#detalle_categorias').addClass('text-center').html('<img src="{{asset('img/ajax-loader.gif')}}">');
                        IniciarCategoria();
                    }
                }
            });
        });
    }

    $('.alphaonly').bind('keyup blur',function(){
        var node = $(this);
        node.val(node.val().replace(/[^a-z ]/g,'') ); }
    );

    function CargarInput(id){
        var url ="{{url('categoria/prueba')}}/"+id;
        if(id == 1){
            $('#add_row').html('');
        var fila = '<br><div class="row"><div class="col-md-12"><div class="form-group"><label>Categoría Nivel '+id+' :</label><input type="text" id="nombre_c" class="form-control alphaonly"></div></div></div>';
        $('#add_row').append(fila);
        $('#id').val(id);
        }else if(id==2){
            $.ajax({
                type:'get',
                url: url,
                }).done(function(data){
                    $("#add_row").html('');

                    var fila = '<br><label>Categoría Nivel '+(id-1)+'</label><br><select id="ID_General" name="ID_General" class="form-control">';

                    for(i=0; i<data['categorias'].length;i++){
                         fila += '<option value="'+data['categorias'][i].ID_Categoria+'">'+data['categorias'][i].Nombre+'</option>';
                    }

                    fila += '</select><br>';
                    fila += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Categoría Nivel '+id+' :</label><input type="text" id="nombre_c" class="form-control alphaonly"></div></div></div>';
                    $("#add_row").append(fila);
                    $('#id').val(id);
                });
        }else{
            $.ajax({
                type:'get',
                url: url,
                }).done(function(data){
                    $("#add_row").html('');

                    var fila = '<br><label>Categoría Nivel '+(id-2)+'</label><br><select id="ID_General" name="ID_General" class="form-control">';

                    for(i=0; i<data['categorias'].length;i++){
                         fila += '<option value="'+data['categorias'][i].ID_Categoria+'">'+data['categorias'][i].Nombre+'</option>';
                    }

                    fila += '</select><br>';
                    fila += '<label>Categoría Nivel '+(id-1)+'</label><br><select id="ID_Nivel" name="ID_Nivel" class="form-control">';

                    for(i=0; i<data['subcategorias'].length;i++){
                         fila += '<option value="'+data['subcategorias'][i].ID_Categoria+'">'+data['subcategorias'][i].Nombre+'</option>';
                    }
                    fila += '</select><br>';
                    fila += '<div class="row"><div class="col-md-12"><div class="form-group"><label>Categoría Nivel '+(id)+' :</label><input type="text" id="nombre_c" class="form-control alphaonly"></div></div></div>';
                    $("#add_row").append(fila);
                    $('#id').val(id);
                });
        }
    }


    $('#btnregistrar_categoria').on('click',function(e)
    {
        var id = $('#id').val();
        var datos = {};
        if(id==1){
            var nom = $('#nombre_c').val();
            var idg = 0;
            var idn1 = 0;
            var idn2 = 0;
            var desc = $('#descripcion_categoria').val();
        }else if(id==2){
            var nom = $('#nombre_c').val();
            var idg = $('#ID_General').val();
            var idn1 = 1;
            var idn2 = 0;
            var desc = $('#descripcion_categoria').val();
        }else{
            var nom = $('#nombre_c').val();
            var idg = $('#ID_General').val();
            var idn1 = $('#ID_Nivel').val();
            var idn2 = 1;
            var desc = $('#descripcion_categoria').val();
        }   
        var token = $("input[name=_token]").val();
        var route = "{{url('/almacen/categoria')}}";        
        datos = {'id':id,'Nombre':nom,'ID_General':idg,'ID_Nivel':idn1,'ID_Nivel2':idn2,'Descripcion':desc};
        
        if(nom==""|| desc==""){
            $.alertable.alert('Por favor complete los datos');
        }else{
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type:'post' ,
                datatype: 'json',
                data: datos,
                success:function(data)
                {
                    console.log(data);
                    if(data.success == 'true')
                    {
                        $.alertable.alert('Categoría creada correctamente.');
                        $('#FormCreateCategoria')[0].reset();
                        IniciarCategoria();
                    }else{
                        $.alertable.alert('Error al registrar la categoría.');
                        $('#nombre_c').focus();
                    }
                },
                error:function(data)
                {
                    $('#mensaje_categoria').addClass('error').html('Error al registrar la Categoría').show(300).delay(3000).hide(300);
                    $('#nombre_c').focus();
                    return false;
                }
            });
        }
    });



</script>
@endpush
