 <!-- Modal -->
<?php use mvc\i18n\i18nClass ?>
 
<?php $idTipoAmb = tipoAmbienteTableClass::ID ?>
<?php $nombreTipoAmb = tipoAmbienteTableClass::NOMBRE ?>
 
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por:</h4>
      </div>
        <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('ambiente', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('nombre') ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" placeholder="Ambiente a buscar">
            </div>
          </div>
          
             <div class="form-group">
            <label for="<?php echo ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('tipoAmbiente') ?></label>
            <div class="col-sm-10">
              <select id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true) ?>" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true) ?>" class=" form-control">
                  <option value="">Seleccione</option>
                <?php foreach ($objTipoAmb as $dataTipoAmb): ?>
                    <option value="<?php echo $dataTipoAmb->$idTipoAmb ?>"><?php echo $dataTipoAmb->$nombreTipoAmb ?></option>
                <?php endforeach; ?>
            </select>
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