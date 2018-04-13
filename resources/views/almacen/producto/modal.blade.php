<div class="modal fade" id="upd_stock_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Stock</h4>
            </div>
            <form id="FormUpdateStock">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <div class="modal-body">
                <div class="box-body" style="margin-bottom: 10px;">
                    <div class="row">
                        <input type="hidden" id="id_producto_act">
                        <div class="col-md-4">
                            <label>Stock Actual:</label>
                            <input type="text" id="stock_actual" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Stock a Aumentar:</label>
                            <input type="text" id="stock_aument" value="0" class="form-control numeros">
                        </div>
                        <div class="col-md-4">
                            <label>Stock Total:</label>
                            <input type="text" id="stock_total" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="box-footer text-center">
                        <button class="btn btn-primary" type="button" id="btnAct_Stock">Actualizar</button>
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    </div>
                </div>
                <div id="mensaje_stock"></div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="stock_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">Productos Agotados o por Agotarse</h4>
            </div>
            <form id="FormShowStock">
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                              <table id="stock" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="">Marca</th>
                                            <th width="" class="text-center">Artículo</th>
                                            <th width="" class="text-left">Stock Actual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button class="btn" data-dismiss="modal" aria-hidden="true"> Cerrar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>