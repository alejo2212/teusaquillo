<!-- Modal -->
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true) ?>" class="col-sm-2 control-label">Empleado</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true) ?>" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $data): ?>
                  <option value="<?php echo $data->$idEmp ?>"><?php echo $data->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha de Realizacion</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>_ini" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>_fin" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>_fin" placeholder="Fecha final">
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