<!-- Modal -->
<?php $idMa = maquinaTableClass::ID ?>
<?php $nombreMa = maquinaTableClass::DESCRIPCION ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<?php $idTma = tipoMantenimientoTableClass::ID ?>
<?php $nombreTma = tipoMantenimientoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true) ?>" class="col-sm-2 control-label">Maquina</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true) ?>" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objMaquina as $dataMa): ?>
                  <option value="<?php echo $dataMa->$idMa ?>"><?php echo $dataMa->$nombreMa ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true) ?>" class="col-sm-2 control-label">Empleado</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true) ?>" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $dataEmp): ?>
                  <option value="<?php echo $dataEmp->$idEmp ?>"><?php echo $dataEmp->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true) ?>" class="col-sm-2 control-label">Tipo de Mantenimiento</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true) ?>" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objTipoMante as $dataTMa): ?>
                  <option value="<?php echo $dataTMa->$idTma ?>"><?php echo $dataTMa->$nombreTma ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha de Realizacion</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>_ini" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>_fin" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha de Finalizacion</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>_ini" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>_fin" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>_fin" placeholder="Fecha final">
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