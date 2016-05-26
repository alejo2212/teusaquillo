<!-- Modal -->
<?php $idFapli= formaAplicacionTableClass::ID ?>
<?php $nombreFapli = formaAplicacionTableClass::NOMBRE ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog MImodal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por: <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" class="col-sm-3 control-label">Administrador</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoA as $dataA): ?>
                  <option value="<?php echo $dataA->$idEmp ?>"><?php echo $dataA->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
            <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" class="col-sm-3 control-label">Veterinario</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoV as $dataV): ?>
                  <option value="<?php echo $dataV->$idEmp ?>"><?php echo $dataV->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
            <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" class="col-sm-3 control-label">Responsable</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>">
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
                            <input type="date" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>_ini" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>_ini" placeholder="Fecha inicio">
                            <br>
                            <input type="date" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>_fin" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>_fin" placeholder="Fecha final">
                        </div>
                    </div>
            <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-3 control-label">Numero De Salida</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" placeholder="Numero De Salida A Buscar">
            </div>
          </div>
            <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true) ?>" class="col-sm-3 control-label">Solucion</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true) ?>" placeholder="Solucion A Buscar">
            </div>
          </div>
             <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true) ?>" class="col-sm-3 control-label">Forma De Aplicacion</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true) ?>" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true) ?>">
                  <option value="">Seleccione</option>
                    <?php foreach ($objformaAplicacion as $FormaApli): ?>
                        <option value="<?php echo $FormaApli->$idFapli ?>"><?php echo $FormaApli->$nombreFapli ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
          </div>
             <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true) ?>" class="col-sm-3 control-label">Area Tratada</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true) ?>" placeholder="Area Tratada A Buscar">
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