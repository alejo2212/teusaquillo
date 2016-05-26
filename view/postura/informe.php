<!-- Modal -->
<?php $id = posturaTableClass::ID ?>
<?php $lote = posturaTableClass::LOTE_ID ?>
<?php $ambi = posturaTableClass::AMBIENTE_ID ?>
<?php $idambi = ambienteTableClass::ID ?>
<?php $nomambi = ambienteTableClass::NOMBRE ?>
<?php $idlote = loteTableClass::ID ?>
<?php $nomlote = loteTableClass::LOTE ?>
<?php $fecha = posturaTableClass::FECHA ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por:</h4>
      </div>
      <form id="informe" method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Inicio</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>_ini" name="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>_ini" required="" placeholder="Fecha inicio">
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fecha de Finalizacion</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>_fin" name="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>_fin" required="" placeholder="Fecha final">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true) ?>" class="col-sm-4 control-label">Lote</label>
            <div class="col-sm-8">
              <select class="form-control" name="<?php echo posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true) ?>" id="<?php echo posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true) ?>">
                <option value="">Seleccione</option>

                <?php foreach ($objlote as $data): ?>
                  <option <?php echo (((isset($edit) and $edit) and ( $objPostura->$idlote == $data->$idlote)) ? 'selected ' : ((isset($posturaForm[$lote]) and ( $posturaForm[$lote] == $data->$idlote)) ? 'selected ' : '')) ?> value="<?php echo $data->$idlote ?>"><?php echo $data->$nomlote ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div><!--
          <div class="form-group">
            <label for="<?php echo posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true) ?>" class="col-sm-4 control-label">Ambiente</label>
            <div class="col-sm-8">
              <select class="form-control" name="<?php echo posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true) ?>" id="<?php echo posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true) ?>">
                <option value="">Seleccione</option>

                <?php foreach ($objambiente as $dataambi): ?>
                  <option <?php echo (((isset($edit) and $edit) and ( $objPostura->$idambi == $dataambi->$idambi)) ? 'selected ' : ((isset($posturaForm[$ambi]) and ( $posturaForm[$ambi] == $dataambi->$idambi)) ? 'selected ' : '')) ?> value="<?php echo $dataambi->$idambi ?>"><?php echo $dataambi->$nomambi ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Generar</button>
        </div>
      </form>
    </div>
  </div>
</div>