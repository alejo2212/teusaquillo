<!-- Modal -->
<?php $idTdesin = tipoDesinfeccionTableClass::ID ?>
<?php $nombreTdesin = tipoDesinfeccionTableClass::NOMBRE ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog MImodal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por: <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label class="col-sm-3 control-label">Fecha de Realizacion</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>_ini" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>_fin" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Fecha de Terminacion</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>_ini" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>_fin" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" class="col-sm-3 control-label">Responsable</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $data): ?>
                  <option value="<?php echo $data->$idEmp ?>"><?php echo $data->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true) ?>" class="col-sm-3 control-label">Verificador</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true) ?>" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoVeri as $datav): ?>
                  <option value="<?php echo $datav->$idEmp ?>"><?php echo $datav->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-3 control-label">Numero De Salida</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" placeholder="Numero De Salida A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true) ?>" class="col-sm-3 control-label">Solucion</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true) ?>" placeholder="Solucion A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true) ?>" class="col-sm-3 control-label">Tipo De Desinfeccion</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true) ?>" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objtipoDesinfeccion as $datadesinfeccion): ?>
                  <option value="<?php echo $datadesinfeccion->$idTdesin ?>"><?php echo $datadesinfeccion->$nombreTdesin ?></option>
                <?php endforeach; ?>
              </select>
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