<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = formaAplicacionTableClass::ID ?>
<?php $nombre = formaAplicacionTableClass::NOMBRE ?>
<?php $descripcion = formaAplicacionTableClass::DESCRIPCION ?>
<?php $formaAplicacion = session::getInstance()->getFlash('formaAplicacion') ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('formaAplicacion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
      <label for="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true) ?>" name="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objformaAplicacion->$nombre :  ((isset($formaAplicacion[$nombre])) ? $formaAplicacion[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true) ?>" name="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objformaAplicacion->$descripcion : ((isset($formaAplicacion[$descripcion])) ? $formaAplicacion[$descripcion] :'') ?>">
    </div>
    </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('formaAplicacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('formaAplicacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
   <?php if (isset($edit) === true and $edit === true):?>
    <input type="hidden" id="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID, true) ?>" name="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID, true) ?>" value="<?php echo $objformaAplicacion->$id ?>">
        <?php endif; ?>
</form>