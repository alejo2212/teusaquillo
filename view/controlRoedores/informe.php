<!-- Modal -->
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog MImodal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i>  Generar Informe Por: <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" class="col-sm-3 control-label">Administrador</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoA as $dataA): ?>
                  <option value="<?php echo $dataA->$idEmp ?>"><?php echo $dataA->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" class="col-sm-3 control-label">Veterinario</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoV as $dataV): ?>
                  <option value="<?php echo $dataV->$idEmp ?>"><?php echo $dataV->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" class="col-sm-3 control-label">Responsable</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $data): ?>
                  <option value="<?php echo $data->$idEmp ?>"><?php echo $data->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Fecha de Realizacion</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>_ini" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>_fin" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-3 control-label">Numero De Salida</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" placeholder="Numero De Salida A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true) ?>" class="col-sm-3 control-label">Pellets</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true) ?>" placeholder="Pellets A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true) ?>" class="col-sm-3 control-label">Bloques</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true) ?>" placeholder="Bloques A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true) ?>" class="col-sm-3 control-label">Evidencia De Consumo</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true) ?>" placeholder="Evidencia De Consumo A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true) ?>" class="col-sm-3 control-label">Lugar De Aplicacion</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true) ?>" placeholder="Lugar De Aplicacion A Buscar">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Generar</button>
        </div>
      </form>
    </div>
  </div>
</div>