<!-- Modal -->
<?php use mvc\i18n\i18nClass ?>

<?php $idAmb = AmbienteTableClass::ID ?>
<?php $nombreAmb = AmbienteTableClass::NOMBRE ?>

<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por:</h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('ambiente') ?></label>
            <div class="col-sm-10">
              <select id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true) ?>" class=" form-control">
                  <option value="">Seleccione</option>
                <?php foreach ($objAmbiente as $dataAmb): ?>
                    <option value="<?php echo $dataAmb->$idAmb ?>"><?php echo $dataAmb->$nombreAmb ?></option>
                <?php endforeach; ?>
            </select>
            </div>
          </div>
            
             <div class="form-group">
            <label for="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('salidaInsumo') ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" placeholder="Insumo Salida a buscar">
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo i18nClass::__('fechaAsignacion') ?></label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>_ini" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>_fin" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>

            <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo i18nClass::__('fechaRetiro') ?></label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>_ini" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>_fin" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>_fin" placeholder="Fecha final">
            </div>
          </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18nClass::__('close') ?></button>
          <button type="submit" class="btn btn-primary"><?php echo i18nClass::__('generar') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>