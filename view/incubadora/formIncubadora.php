<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $incubadoraForm = session::getInstance()->getFlash('incubadora') ?>
<?php $idCiu = localidadTableClass::ID ?>
<?php $nomCiu = localidadTableClass::NOMBRE ?>
<?php $id = incubadoraTableClass::ID ?>
<?php $nombre = incubadoraTableClass::NOMBRE ?>
<?php $ciudad = incubadoraTableClass::LOCALIZACION_ID ?>
<?php $direc = incubadoraTableClass::DIRECCION ?>
<?php $obser = incubadoraTableClass::OBSERVACION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true) ?>" class="col-sm-2 control-label">Ciudad</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true) ?>" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objlocalidad as $data): ?>
          <option <?php echo (((isset($edit) and $edit) and ( $objincubadora->$ciudad == $data->$idCiu)) ? 'selected ' : ((isset($incubadoraForm[$ciudad]) and ( $incubadoraForm[$ciudad] == $data->$idCiu)) ? 'selected ' : '')) ?> value="<?php echo $data->$idCiu ?>"><?php echo $data->$nomCiu ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true) ?>" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objincubadora->$nombre : ((isset($incubadoraForm[$nombre])) ? $incubadoraForm[$nombre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::DIRECCION, true) ?>" class="col-sm-2 control-label">Direccion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::DIRECCION, true) ?>" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::DIRECCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objincubadora->$direc : ((isset($incubadoraForm[$direc])) ? $incubadoraForm[$direc] : '') ?>">
    </div>
  </div>
  <div id="observa" class="form-group">
    <label for="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::OBSERVACION, true) ?>" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objincubadora->$obser : ((isset($incubadoraForm[$obser])) ? $incubadoraForm[$obser] : '') ?></textarea>
    </div>
  </div>
  <input type="hidden" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::ID, true) ?>" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objincubadora->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>