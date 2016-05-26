<?php
use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $credencialForm = session::getInstance()->getFlash('credencial') ?>
<?php $id = credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<?php $actualizar = credencialTableClass::UPDATE_AT ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCredencial->$nombre : ((isset($credencialForm[$nombre])) ? $credencialForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
  <input type="hidden" id="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>" name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objCredencial->$id : '' ?>">
</form>