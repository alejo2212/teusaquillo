<!-- Modal -->
<?php $idclasima = clasificacionMaquinaTableClass::ID ?>
<?php $nombreclasima = clasificacionMaquinaTableClass::NOMBRE ?>
<?php $id = maquinaTableClass::ID ?>
<?php $clasimaquiid = maquinaTableClass::CLASIFICACION_MAQUINA_ID ?>
<?php $fechaIngre = maquinaTableClass::FECHA_INGRESO ?>
<?php $descrip = maquinaTableClass::DESCRIPCION ?>
<?php $codigo = maquinaTableClass::CODIGO ?>
<?php $referencia = maquinaTableClass::REFERENCIA ?>
<?php $fechaMante = maquinaTableClass::FECHA_MANTENIMIENTO ?>
<?php $intervaloMante = maquinaTableClass::INTERVALO_MANTENIMIENTO ?>
<?php $activo = maquinaTableClass::ACTIVADO ?>
<?php $valor = maquinaTableClass::VALOR ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por:</h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true) ?>" class="col-sm-2 control-label">Clasificacion</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true) ?>" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objClasiMaquina as $data): ?>

                  <option value="<?php echo $data->$idclasima ?>"><?php echo $data->$nombreclasima ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>" class="col-sm-2 control-label">Fecha de Ingreso</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>_ini" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>_fin" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true) ?>" class="col-sm-2 control-label">Codigo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true) ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true) ?>" class="col-sm-2 control-label">Referencia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true) ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>" class="col-sm-2 control-label">Fecha de Ingreso</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>_ini" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>_fin" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true) ?>" class="col-sm-2 control-label">Referencia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true) ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::VALOR, true) ?>" class="col-sm-2 control-label">Referencia</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::VALOR, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::VALOR, true) ?>">
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