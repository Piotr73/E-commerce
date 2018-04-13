<section class="content" >
 <div class="col-md-12">
  <div class="box box-primary  box-gris">
    <div class="box-header with-border my-box-header">
      <h3 class="box-title"><strong>Nuevo Usuario</strong></h3>
    </div><!-- /.box-header -->
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <hr style="border-color:white;" />
    <div class="box-body">
      <form   action="{{ url('crear_usuario') }}"  method="post" id="f_crear_usuario" class="formentrada" >
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre">Seleccionar Trabajador:</label>
                    <div class="col-sm-10" >
                        <div id="select_trabajador">
                            <select id="ID_Trabajador" name="ID_Trabajador" class="form-control">
                                <option value="">Seleccione un Trabajador</option>
                                @foreach($trabajadores as $trabajador)
                                    <option value="{{$trabajador->ID_Trabajador}}">{{$trabajador->Datos}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div><!-- /.form-group -->
          </div><!-- /.col -->
          <div class="col-md-6">
              <div class="form-group">
                  <label class="col-sm-2">Fecha de Registro:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="fecha" name="fecha"  required>
                  </div>
              </div>
          </div>
          <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
              <h3 class="box-title">Datos de acceso</h3>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label class="col-sm-2" for="email">E-mail*</label>
                  <div class="col-sm-10" >
                    <input type="email" class="form-control" id="email" name="email"  required >
                  </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->
          <div class="col-md-6">
              <div class="form-group">
                  <label class="col-sm-2" for="email">Password*</label>
                  <div class="col-sm-10" >
                      <input type="password" class="form-control" id="password" name="password"  required >
                  </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->
          <br>
          <div class="box-footer col-xs-12 box-gris text-center">
              <button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
          </div>
      </form>
    </div>
  </div>
 </div>
</section>

