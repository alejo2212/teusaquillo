<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" class="col-sm-2 control-label">Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>" class="col-sm-2 control-label">Contraseña</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>2" class="col-sm-2 control-label">Verificar contraseña</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>2" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>2" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>