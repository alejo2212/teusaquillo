<!-- Modal -->
<?php $id = salidaincubadoraTableClass::ID ?>
<?php $empleado = salidaincubadoraTableClass::EMPLEADO_ID ?>
<?php $cantidad = salidaincubadoraTableClass::CANTIDAD ?>
<?php $fecha = salidaincubadoraTableClass::FECHA ?>
<?php $fecha_lle = salidaincubadoraTableClass::FECHA_LLEGADA ?>
<?php $fecha_sa = salidaincubadoraTableClass::FECHA_SALIDAD ?>
<?php $npedido = salidaincubadoraTableClass::NO_PEDIDO ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nomEmp = empleadoTableClass::NOMBRE ?>
<?php $idInc = incubadoraTableClass::ID ?>
<?php $nomInc = incubadoraTableClass::NOMBRE ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">
          
          <div class="form-group">
            <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true) ?>" class="col-sm-4 control-label">Empleado</label>
            <div class="col-sm-8">
              <select class="form-control" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true) ?>" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $data): ?>
                  <option value="<?php echo $data->$idEmp ?>"><?php echo $data->$nomEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true) ?>" class="col-sm-4 control-label">Cantidad</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true) ?>" placeholder="Cantidad de Envio a buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true) ?>" class="col-sm-4 control-label">N° de Pedido</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true) ?>" placeholder="N° de Pedido a buscar">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Realizacion</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>_ini" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>_fin" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Llegada</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>_ini" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>_fin" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Salida</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>_ini" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>_fin" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
                    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
      </form>
    </div>
  </div>
</div>