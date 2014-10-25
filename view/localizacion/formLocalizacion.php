<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'created') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Ciudad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" name="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" class="col-sm-2 control-label">Departamento</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" name="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>