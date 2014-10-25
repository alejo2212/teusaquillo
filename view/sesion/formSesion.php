<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo sesionTableClass::getNameField(sesionTableClass::USUARIO_ID, true) ?>" class="col-sm-2 control-label">Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo sesionTableClass::getNameField(sesionTableClass::USUARIO_ID, true) ?>" name="<?php echo sesionTableClass::getNameField(sesionTableClass::USUARIO_ID, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo sesionTableClass::getNameField(sesionTableClass::IP_ADDRESS, true) ?>" class="col-sm-2 control-label">Cookie</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="<?php echo sesionTableClass::getNameField(sesionTableClass::IP_ADDRESS, true) ?>" name="<?php echo sesionTableClass::getNameField(sesionTableClass::IP_ADDRESS, true) ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo sesionTableClass::getNameField(sesionTableClass::HASH_COOKIE, true) ?>2" class="col-sm-2 control-label">Ip</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="<?php echo sesionTableClass::getNameField(sesionTableClass::HASH_COOKIE, true) ?>2" name="<?php echo sesionTableClass::getNameField(sesionTableClass::HASH_COOKIE, true) ?>2" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>