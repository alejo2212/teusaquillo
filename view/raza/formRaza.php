<?php

use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass ?>
<?php $id = razaTableClass::ID ?>
<?php $nombre = razaTableClass::NOMBRE ?>
<?php $des = razaTableClass::DESCRIPCION ?>
<?php $foto = razaTableClass::FOTO ?>
<?php $razaForm = session::getInstance()->getFlash('raza') ?>
<form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
  <div class="form-group">
    <label for="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('nombre') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $raza->$nombre : ((isset($razaForm[$nombre])) ? $razaForm[$nombre] : '') ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('descripcion') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $raza->$des : ((isset($razaForm[$des])) ? $razaForm[$des] : '') ?>">


    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo razaTableClass::getNameField(razaTableClass::FOTO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('foto') ?></label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="<?php echo razaTableClass::getNameField(razaTableClass::FOTO, true) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::FOTO, true) ?>" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i><?php echo i18nClass::__('cancelar') ?> </a>
    </div>
  </div>
  <?php if (isset($edit) === true and $edit === true): ?>
    <input type="hidden" id="<?php echo razaTableClass::getNameField(razaTableClass::ID, true) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::ID, true) ?>" value="<?php echo $raza->$id ?>">
  <?php endif; ?>
</form>