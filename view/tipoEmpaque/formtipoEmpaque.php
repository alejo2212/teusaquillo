<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $tipoEmpaqueForm = session::getInstance()->getFlash('tipoEmpaque') ?>
<?php $id = tipoEmpaqueTableClass::ID ?>
<?php $nombre = tipoEmpaqueTableClass::NOMBRE ?>
<?php $descripcion = tipoEmpaqueTableClass::DESCRIPCION ?>
<?php $cantidad = tipoEmpaqueTableClass::CANTIDAD ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true) ?>" name="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoEmpaque->$nombre : ((isset($tipoEmpaqueForm[$nombre])) ? $tipoEmpaqueForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true) ?>" name="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoEmpaque->$descripcion : ((isset($tipoEmpaqueForm[$descripcion])) ? $tipoEmpaqueForm[$descripcion] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true) ?>" class="col-sm-2 control-label">Cantidad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true) ?>" name="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoEmpaque->$cantidad : ((isset($tipoEmpaqueForm[$cantidad])) ? $tipoEmpaqueForm[$cantidad] : '') ?>">
    </div>
  </div>
  <input type="hidden" id="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID, true) ?>" name="<?php echo tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objtipoEmpaque->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
