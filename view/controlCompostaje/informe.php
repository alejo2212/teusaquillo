<!-- Modal -->
<?php $idCajon = cajonCompostajeTableClass::ID ?>
<?php $numeroCajon = cajonCompostajeTableClass::NUMERO ?>
<?php $idSalidalote = salidaLoteTableClass::ID ?>
<?php $hembrasSalidalote = salidaLoteTableClass::CANTIDAD_HEMBRAS ?>
<?php $machosSalidalote = salidaLoteTableClass::CANTIDAD_MACHOS ?>
<?php $totalSalidalote = salidaLoteTableClass::CANTIDAD_TOTAL ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog MImodal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por: <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" class="col-sm-3 control-label">Administrador</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoA as $dataA): ?>
                  <option value="<?php echo $dataA->$idEmp ?>"><?php echo $dataA->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" class="col-sm-3 control-label">Veterinario</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleadoV as $dataV): ?>
                  <option value="<?php echo $dataV->$idEmp ?>"><?php echo $dataV->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" class="col-sm-3 control-label">Responsable</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>">
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
              <input type="date" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>_ini" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>_fin" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true) ?>" class="col-sm-3 control-label">Cajon Compostaje</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objCajon as $dataCaj): ?>
                  <option value="<?php echo $dataCaj->$idCajon ?>"><?php echo $dataCaj->$numeroCajon ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true) ?>" class="col-sm-3 control-label">Gallinaza Utilizada</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true) ?>" placeholder="Gallinaza Utilizada A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true) ?>" class="col-sm-3 control-label">Cantidad Total De Aves</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true) ?>" placeholder="Cantidad Total De Aves A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true) ?>" class="col-sm-3 control-label">Cantidad De Machos</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true) ?>" placeholder="Cantidad De Machos A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true) ?>" class="col-sm-3 control-label">Cantidad De Hembras</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true) ?>" placeholder="Cantidad De Hembras A Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true) ?>" class="col-sm-3 control-label">Numero De Salida Lote</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objSalidalote as $datalote): ?>
                  <option value="<?php echo $datalote->$idSalidalote ?>"><?php echo $datalote->$idSalidalote ?></option>
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