<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $cargoForm = session::getInstance()->getFlash('cargo') ?>
<?php $id = cargoTableClass::ID ?>
<?php $nombre = cargoTableClass::NOMBRE ?>
<?php $descripcion = cargoTableClass::DESCRIPCION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo cargoTableClass::getNameField(cargoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo cargoTableClass::getNameField(cargoTableClass::NOMBRE, true) ?>" name="<?php echo cargoTableClass::getNameField(cargoTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCargo->$nombre : ((isset($cargoForm[$nombre])) ? $cargoForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>" name="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCargo->$descripcion : ((isset($cargoForm[$descripcion])) ? $cargoForm[$descripcion] : '') ?>">
    </div>
  </div>
  <input type="hidden" id="<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>" name="<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objCargo->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
