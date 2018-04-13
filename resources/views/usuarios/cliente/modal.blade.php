<div class="modal fade" id="reg_trabajador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registro de Personal</h4>
            </div>
            <form id="FormCreateTrabajador">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombres:</label>
                                <input type="text" name="nombres" id="nombres" class="form-control alphaonly" placeholder="Nombres" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="apellido_paterno">Apellido Paterno:</label>
                                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control alphaonly" placeholder="Apellido Paterno" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="apellido_materno">Apellido Materno:</label>
                                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control alphaonly" placeholder="Apellido Materno" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" placeholder="99999999" data-validation="length" id="dni_t" data-validation-length="max8" class="form-control numeros">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ruc">RUC</label>
                                <input type="text" name="ruc" id="ruc" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="box-footer text-center">
                        <button class="btn btn-primary" type="button" id="btnregistrar_trabajador">Registrar</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancelar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_trabajador_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">Edición de Personal</h4>
            </div>
            <form id="formulario_edit_trabajador">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="modal-body">
                <input type="hidden" id="id_trabajador">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" name="nombres_edit" id="nombres_edit" class="form-control alphaonly" placeholder="Nombre" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ap_paterno">Apellido Paterno:</label>
                                <input type="text" name="ap_paterno_edit" id="ap_paterno_edit" class="form-control alphaonly" placeholder="Apellido Paterno" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ap_materno">Apellido Materno:</label>
                                <input type="text" name="ap_materno_edit" id="ap_materno_edit" class="form-control alphaonly" placeholder="Apellido Materno" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dni">DNI:</label>
                                <input type="text" name="dni_edit" id="dni_edit" class="form-control numeros" placeholder="99999999" maxlength="8" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ruc">RUC</label>
                                <input type="text" name="ruc_edit" id="ruc_edit" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="box-footer text-center">
                        <button class="btn btn-primary" type="button" id="btnedit_trabajador">Actualizar</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancelar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
