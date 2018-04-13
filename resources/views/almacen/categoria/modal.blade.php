<div class="modal fade" id="reg_categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrar Categoría</h4>
            </div>
            <form id="FormCreateCategoria">
            <div class="modal-body">
                <div class="box-body">
                    <input type="hidden" id="id" value="1">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="javascript:CargarInput(1)" class="btn btn-primary">Categoría Nivel 1</a>
                            <a href="javascript:CargarInput(2)" class="btn btn-primary">Categoría Nivel 2</a>
                            <a href="javascript:CargarInput(3)" class="btn btn-primary">Categoría Nivel 3</a>
                        </div>
                    </div>
                    <div id="add_row"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="detalle">Descripción:</label>
                                <textarea class="form-control" rows="4" id="descripcion_categoria" name="descripcion_categoria"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="box-footer text-center">
                        <button class="btn btn-primary" type="button" id="btnregistrar_categoria">Grabar</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancelar</button>
                    </div>
                </div>
                <div id="mensaje_categoria"></div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_categoria_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Editar Categoría</h4>
            </div>
            <form id="formulario_edit_categoria">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="modal-body">
                    <input type="hidden" id="id_categoria">
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombres">Nombre:</label>
                                <input type="text" name="nombre_edit" id="nombre_edit" class="form-control alphaonly" placeholder="Nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" rows="4" id="descripcion_edit" name="descripcion_edit"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                    <div class="box-footer text-center">
                        <button class="btn btn-primary" type="button" id="btnedit_categoria">Actualizar</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancelar</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>