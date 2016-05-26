<?php

use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass ?>
<?php $id = ambienteInsumoTableClass::ID ?>
<?php $ambId = ambienteInsumoTableClass::AMBIENTE_ID ?>
<?php $salidaInD = ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $fechaA = ambienteInsumoTableClass::FECHA_ASIGNACION ?>
<?php $fechaR = ambienteInsumoTableClass::FECHA_RETIRO ?>
<?php $idAmb = tipoAmbienteTableClass::ID ?>
<?php $nombreAmb = tipoAmbienteTableClass::NOMBRE ?>
<?php $ambienteInsumoForm = session::getInstance()->getFlash('ambienteInsumo') ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">

  <div class="form-group">
    <label for="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('ambiente') ?></label>
    <div class="col-sm-10">
      <select id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true) ?>" class=" form-control">
        <option value="">Seleccione</option>
        <?php foreach ($objAmbiente as $dataAmb): ?>
          <option  <?php echo (((isset($edit) and $edit) and ( $ambienteInsumo->$ambId == $dataAmb->$idAmb )) ? 'selected ' : ((isset($ambienteInsumoForm[$ambId]) and ( $ambienteInsumoForm[$ambId] == $dataAmb->$idAmb)) ? 'selected ' : '') ) ?> value="<?php echo $dataAmb->$idAmb ?>"><?php echo $dataAmb->$nombreAmb ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <input type="hidden" value="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'searchControl') ?>" id="urlBuscarControl">
    <label for="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-2 control-label">Salida N°</label>
    <div class="col-sm-10">
    <div class="input-group">
      
      <input type="text" class="form-control" data-id="idBuscarControl" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $ambienteInsumo->$salidaInD : ((isset($ambienteInsumoForm[$salidaInD])) ? $ambienteInsumoForm[$salidaInD] : '') ?>">
      <span class="input-group-btn">
        <a id="btnBuscarControl" class="btn btn-default"><i class="fa fa-search fa-fw"></i> Buscar</a>
      </span>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('fechaAsignacion') ?></label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($ambienteInsumo->$fechaA)) : ((isset($ambienteInsumoForm[$fechaA])) ? $ambienteInsumoForm[$fechaA] : '') ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('fechaRetiro') ?>   </label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($ambienteInsumo->$fechaR)? strftime('%Y-%m-%dT%H:%M:%S', strtotime($ambienteInsumo->$fechaR)):'' : ((isset($ambienteInsumoForm[$fechaR])) ? $ambienteInsumoForm[$fechaR] : '') ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> <?php echo i18nClass::__('volver') ?></a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i><?php echo i18nClass::__('cancelar') ?></a>
    </div>
  </div>

  <input type="hidden" id="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::ID, true) ?>" name="<?php echo ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $ambienteInsumo->$id : '' ?>">

</form>

<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
        <div class="modal-body">
            
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>