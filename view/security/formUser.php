<?php use mvc\i18n\i18nClass ?>
<?php $id = usuarioTableClass::ID ?>
<?php $nombreUsuario = usuarioTableClass::USER ?>
<?php $activado = usuarioTableClass::ACTIVED ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" class="col-sm-2 control-label">Usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $usuario->$nombreUsuario : '' ?>">
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
  <?php if (isset($edit) and $edit): ?>
    <div class="form-group">
      <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ACTIVED, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
      <div class="col-sm-10 checkboxFlow">
        <input type="checkbox" class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ACTIVED, true) ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ACTIVED, true) ?>" value="t" <?php echo ($usuario->$activado) ? 'checked' : '' ?>>
        <input type="hidden" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>" value="<?php echo $usuario->$id ?>">
      </div>
    </div>
  <?php endif ?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
