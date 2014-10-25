<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'created') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true) ?>" class="col-sm-2 control-label">Tipo de Identificacion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" class="col-sm-2 control-label">Departamento</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="col-sm-2 control-label">Apellido</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" class="col-sm-2 control-label">Telefono</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" class="col-sm-2 control-label">Direccion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" class="col-sm-2 control-label">Genero</label>
    <div class="col-sm-10">
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" class="col-lg-2 control-label">Masculino </label>
      <input type="checkbox" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" value="" required="">
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" class="col-lg-2 control-label">Femenino </label>
      <input type="checkbox" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" value="" required="">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>" class="col-sm-2 control-label">Cargo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::LOCALIZACION_ID, true) ?>" class="col-sm-2 control-label">Ciudad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::LOCALIZACION_ID, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::LOCALIZACION_ID, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>