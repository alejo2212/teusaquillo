<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = localidadTableClass::ID ?>
<?php $nombre = localidadTableClass::NOMBRE ?>
<?php $localidadId = localidadTableClass::LOCALIDAD_ID ?>
<?php $localidadForm = session::getInstance()->getFlash('localidad') ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Ciudad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" name="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objLocalidadE->$nombre :((isset($localidadForm[$nombre])) ? $localidadForm[$nombre] : '') ?>">
    </div>
  </div>
 
  <div class="form-group">
    <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" class="col-sm-2 control-label">Departamento</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" id="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objLocalidad as $dataDepto): ?>
          <?php if ($dataDepto->$localidadId === null): ?>
            <option value="<?php echo $dataDepto->$id ?>"><?php echo $dataDepto->$nombre ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
  <input type="hidden" id="<?php echo localidadTableClass::getNameField(localidadTableClass::ID, true) ?>" name="<?php echo localidadTableClass::getNameField(localidadTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objLocalidadE->$id : '' ?>">
</form>