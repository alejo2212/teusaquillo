<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $clasimaquinaForm = session::getInstance()->getFlash('clasimaquina') ?>
<?php $id = clasificacionMaquinaTableClass::ID ?>
<?php $nombre = clasificacionMaquinaTableClass::NOMBRE ?>
<?php $descripcion = clasificacionMaquinaTableClass::DESCRIPCION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionMaquina', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::NOMBRE, true) ?>" name="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objclasiMaquina->$nombre : ((isset($clasimaquinaForm[$nombre])) ? $clasimaquinaForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DESCRIPCION, true) ?>" name="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objclasiMaquina->$descripcion : ((isset($clasimaquinaForm[$descripcion])) ? $clasimaquinaForm[$descripcion] : '') ?>">
    </div>
  </div>
<input type="hidden" id="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID, true) ?>" name="<?php echo clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objclasiMaquina->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionMaquina', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionMaquina', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>