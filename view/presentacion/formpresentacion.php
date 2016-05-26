<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $presentacionForm = session::getInstance()->getFlash('presentacion') ?>
<?php $id = presentacionTableClass::ID ?>
<?php $nombre = presentacionTableClass::NOMBRE ?>
<?php $observacion = presentacionTableClass::OBSERVACION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('presentacion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
      <label for="<?php echo presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true) ?>" name="<?php echo presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objpresentacion->$nombre : ((isset($presentacionForm[$nombre])) ? $presentacionForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo presentacionTableClass::getNameField(presentacionTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo presentacionTableClass::getNameField(presentacionTableClass::OBSERVACION, true) ?>" name="<?php echo presentacionTableClass::getNameField(presentacionTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objpresentacion->$observacion : ((isset($presentacionForm[$observacion])) ? $presentacionForm[$observacion] : '') ?>">
    </div>
    </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('presentacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('presentacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
   <?php if (isset($edit) === true and $edit === true):?>
    <input type="hidden" id="<?php echo presentacionTableClass::getNameField(presentacionTableClass::ID, true) ?>" name="<?php echo presentacionTableClass::getNameField(presentacionTableClass::ID, true) ?>" value="<?php echo $objpresentacion->$id ?>">
        <?php endif; ?>
</form>