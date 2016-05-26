<?php use mvc\i18n\i18nClass ?>
<?php $idUsuario = usuarioTableClass::ID ?>
<?php $nombreUsuario = usuarioTableClass::USER ?>
<?php $idCredencial = credencialTableClass::ID ?>
<?php $nombreCredencial = credencialTableClass::NOMBRE ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', (isset($edit) === true and $edit === true) ? 'userCredentialUpdate' : 'userCredentialCreate') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>" class="col-sm-2 control-label">Usuario</label>
    <div class="col-sm-10">
      <select class="form-control" id="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>">
        <option value="">Seleccione un usuario</option>
        <?php foreach ($objUsuarios as $usuario): ?>
          <option value="<?php echo $usuario->$idUsuario ?>"><?php echo $usuario->$nombreUsuario ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>" class="col-sm-2 control-label">Credencial</label>
    <div class="col-sm-10">
      <select class="form-control" id="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>">
        <option value="">Seleccione una credencial</option>
        <?php foreach ($objCredenciales as $credencial): ?>
          <option value="<?php echo $credencial->$idCredencial ?>"><?php echo $credencial->$nombreCredencial ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'userCredentialIndex') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'userCredentialIndex') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
