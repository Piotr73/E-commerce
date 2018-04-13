<div class="modal fade" id="reg_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrar Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <form id="FormCreateUsuario" class="formentrada" >
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="token">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4" for="nombre">Seleccionar Trabajador:</label>
                                    <div class="col-sm-8" >
                                        <div id="select_trabajador">
                                            <select id="ID_Persona" name="ID_Persona" class="form-control">
                                                <option value="">Seleccione un Trabajador</option>
                                                @foreach($trabajadores as $trabajador)
                                                    <option value="{{$trabajador->ID_Persona}}_{{$trabajador->Datos}}">{{$trabajador->Datos}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">Fecha de Registro:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="fecha" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
                                <h3 class="box-title">Datos de acceso</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4" for="email">E-mail*</label>
                                    <div class="col-sm-8" >
                                        <input type="text" data-validation="email" id="email_u" class="form-control" data-validation-length="min4">
                                        <input type="hidden" id="inde">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4" for="email">Password*</label>
                                    <div class="col-sm-8">
                                        <input type="password" data-validation="length" id="password" data-validation-length="min8" class="form-control">
                                        <input type="hidden" id="inde">
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->
                            <br>
                            <div class="box-footer col-xs-12 box-gris text-center">
                                <button class="btn btn-primary" type="button" id="btnregistrar_usuario">Registrar</button>
                                <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancelar</button>
                            </div>
                            <div class="col-md-12 text-center" id="mensaje_usuario"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

