<!-- Modal -->
<?php $idlote = loteTableClass::ID ?>
<?php $nomlote = loteTableClass::LOTE ?>
<?php $fecha = salidaLoteTableClass::FECHA_REALI ?>
<?php
use mvc\i18n\i18nClass ?>
<div class="modal fade" id="myModalInformeMortalidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
        <h4 class="modal-title" id="myModalInforme"><i class="fa fa-filter"></i> Informe de Mortalidad</h4>
      </div> 
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'informeMortalidad') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Inicio</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>_ini" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>_ini" required="" placeholder="Fecha inicio">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Finalizacion</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>_fin" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>_fin" required="" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>" class="col-sm-4 control-label">Lote</label>
            <div class="col-sm-8">
              <select class="form-control" name="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>" id="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objlote as $data): ?>
                  <option value="<?php echo $data->$idlote ?>"><?php echo $data->$nomlote ?></option>
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