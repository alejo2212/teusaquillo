<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $detalleManteForm = session::getInstance()->getFlash('detalleMante') ?>
<?php $id = detalleMantenimientoTableClass::ID ?>
<?php $idMante = detalleMantenimientoTableClass::MANTENIMIENTO_ID ?>
<?php $descripcion = detalleMantenimientoTableClass::DESCRIPCION ?>
<?php $valor = detalleMantenimientoTableClass::VALOR ?>
<?php $observacion = detalleMantenimientoTableClass::OBSERVACION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleMantenimiento', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <input type="hidden" class="form-control" id="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::MANTENIMIENTO_ID, true) ?>" name="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::MANTENIMIENTO_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleMante->$idMante : $idMantenimiento ?>">
  <div class="form-group">
    <label for="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::VALOR, true) ?>" class="col-sm-2 control-label">Valor</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::VALOR, true) ?>" name="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::VALOR, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleMante->$valor: ((isset($empleadoForm[$valor])) ? $empleadoForm[$valor] : ((isset($detalleManteForm[$valor])) ? $detalleManteForm[$valor] : '')) ?>" placeholder="Ingrese el Valor total del Mantenimiento">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DESCRIPCION, true) ?>" name="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DESCRIPCION, true) ?>" placeholder="Digite la descripcion completa del Mantenimiento"><?php echo (isset($edit) and $edit) ? $objDetalleMante->$descripcion : ((isset($detalleManteForm[$descripcion])) ? $detalleManteForm[$descripcion] : '') ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::OBSERVACION, true) ?>" name="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::OBSERVACION, true) ?>" placeholder="Digite las observaciones necesarias"><?php echo (isset($edit) and $edit) ? $objDetalleMante->$observacion : ((isset($detalleManteForm[$observacion])) ? $detalleManteForm[$observacion] : '') ?></textarea>
    </div>
  </div>

<input type="hidden" id="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::ID, true) ?>" name="<?php echo detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objDetalleMante->$id : '' ?>">
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10 text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'detail', array(detalleMantenimientoTableClass::ID => (isset($edit) and $edit) ? $objDetalleMante->$idMante : $idMantenimiento)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'detail', array(detalleMantenimientoTableClass::ID => (isset($edit) and $edit) ? $objDetalleMante->$idMante : $idMantenimiento)) ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
  </div>
</div>
</form>
