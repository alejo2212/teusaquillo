<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $tipoManteForm = session::getInstance()->getFlash('tipoMante') ?>
<?php $id = tipoMantenimientoTableClass::ID ?>
<?php $nombre = tipoMantenimientoTableClass::NOMBRE ?>
<?php $descripcion = tipoMantenimientoTableClass::DESCRIPCION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoMantenimiento', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::NOMBRE, true) ?>" name="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objTipoMante->$nombre : ((isset($tipoManteForm[$nombre])) ? $tipoManteForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DESCRIPCION, true) ?>" name="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objTipoMante->$descripcion : ((isset($tipoManteForm[$descripcion])) ? $tipoManteForm[$descripcion] : '') ?>">
    </div>
  </div>
<input type="hidden" id="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::ID, true) ?>" name="<?php echo tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objTipoMante->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoMantenimiento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoMantenimiento', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>