<!-- Modal -->
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<?php $id = devolucionIncubadoraTableClass::ID ?>
<?php $salidain = devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID ?>
<?php $llegada = devolucionIncubadoraTableClass::CANTIDAD_LLEGADA ?>
<?php $faltante = devolucionIncubadoraTableClass::CANTIDAD_FALTANTE ?>
<?php $devolucion = devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION ?>
<?php $fecha = devolucionIncubadoraTableClass::FECHA ?>
<?php $empleado = devolucionIncubadoraTableClass::EMPLEADO ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true) ?>" class="col-sm-4 control-label">Empleado</label>
            <div class="col-sm-8">
              <select class="form-control" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true) ?>" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $data): ?>
                  <option value="<?php echo $data->$idEmp ?>"><?php echo $data->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true) ?>" class="col-sm-4 control-label">Numero de Salida</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true) ?>" placeholder="Ingrese el numero de salida">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true) ?>" class="col-sm-4 control-label">Cantidad de Llegada</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true) ?>" placeholder="Ingrese La cantidad de llegada">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true) ?>" class="col-sm-4 control-label">Cantidad Faltante</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true) ?>" placeholder="Ingrese La cantidad faltante">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true) ?>" class="col-sm-4 control-label">Cantidad de Devolucion</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true) ?>" placeholder="Ingrese La cantidad de devolucion">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Devolucion</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>_ini" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>_fin" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>_fin" placeholder="Fecha final">
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