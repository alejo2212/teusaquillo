<!-- Modal -->
<?php $idlote = loteTableClass::ID ?>
<?php $nombrelote = loteTableClass::LOTE ?>
<?php $idclasibode = bodegaClasificacionTableClass::ID ?>
<?php $nombreclasibode = bodegaClasificacionTableClass::NOMBRE ?>
<?php $lote = bodegaTableClass::LOTE_ID ?>
<?php $lote = bodegaTableClass::BODEGA_CLASIFICACION_ID ?>
<?php $tipoInsumo = bodegaTableClass::INSUMO_ID ?>
<?php $idinsu = insumoTableClass::ID ?>
<?php $nombreinsu = insumoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog MImodal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID, true) ?>" class="col-sm-4 control-label">Numero de lote</label>
            <div class="col-sm-8">

              <select class="form-control" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID, true) ?>" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objlote as $datalote): ?>
                  <option  value="<?php echo $datalote->$idlote ?>"><?php echo $datalote->$nombrelote ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID, true) ?>" class="col-sm-4 control-label">Clasificacion de Bodega</label>
            <div class="col-sm-8">

              <select class="form-control" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID, true) ?>" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objclasibodega as $dataclasibode): ?>
                  <option  value="<?php echo $dataclasibode->$idclasibode ?>"><?php echo $dataclasibode->$nombreclasibode ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID, true) ?>" class="col-sm-4 control-label">Insumo</label>
            <div class="col-sm-8">
              <select class="form-control" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID, true) ?>" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID, true) ?>">
                <option value="" >Seleccione</option>
                <?php foreach ($objinsu as $datainsu): ?>
                  <option  value="<?php echo $datainsu->$idinsu ?>"><?php echo $datainsu->$nombreinsu ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
      </form>
    </div>
  </div>
</div>