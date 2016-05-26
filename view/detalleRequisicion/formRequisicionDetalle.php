<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $detRForm = session::getInstance()->getFlash('detalleRequisicion') ?>
<?php $id = requisiciondetalleTableClass::ID ?>
<?php $requisicion = requisiciondetalleTableClass::REQUISICION_ID ?>
<?php $insumo = requisiciondetalleTableClass::BODEGA_ID ?>
<?php $cantidad = requisiciondetalleTableClass::CANTIDAD ?>
<?php $fecha = requisiciondetalleTableClass::FECHA_NECESIDAD ?>
<?php $idInsumo = insumoTableClass::ID ?>
<?php $nomInsumo = insumoTableClass::NOMBRE ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <input type="hidden" class="form-control" id="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::REQUISICION_ID, true) ?>" name="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::REQUISICION_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleRequi->$requisicion : $idRequisicion ?>">
  <div class="form-group">
    <label for="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::BODEGA_ID, true) ?>" class="col-sm-2 control-label">Insumo</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::BODEGA_ID, true) ?>" id="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::BODEGA_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objInsumo as $data): ?>
          <option <?php echo (((isset($edit) and $edit) and ( $objDetalleRequi->$insumo == $data->$idInsumo)) ? 'selected ' : ((isset($detRForm[$insumo]) and ( $detRForm[$insumo] == $data->$idInsumo)) ? 'selected ' : '')) ?> value="<?php echo $data->$idInsumo ?>"><?php echo $data->$nomInsumo ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::CANTIDAD, true) ?>" class="col-sm-2 control-label">Cantidad Solicitada</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::CANTIDAD, true) ?>" name="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleRequi->$cantidad : ((isset($detRForm[$cantidad])) ? $detRForm[$cantidad] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::FECHA_NECESIDAD, true) ?>" class="col-sm-2 control-label">Fecha de Necesidad</label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control" id="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::FECHA_NECESIDAD, true) ?>" name="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::FECHA_NECESIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objDetalleRequi->$fecha) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objDetalleRequi->$fecha)) : '' : ((isset($detRForm[$fecha])) ? $detRForm[$fecha] : '') ?>">
    </div>
  </div>
  <input type="hidden" id="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::ID, true) ?>" name="<?php echo requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objDetalleRequi->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'detail', array(requisicionTableClass::ID => (isset($edit) and $edit) ? $objDetalleRequi->$requisicion : $idRequisicion)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'detail', array(requisicionTableClass::ID => (isset($edit) and $edit) ? $objDetalleRequi->$requisicion : $idRequisicion)) ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
