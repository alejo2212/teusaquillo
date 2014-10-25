<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = usuarioTableClass::ID ?>
    <?php $nombreUsuario = usuarioTableClass::USER ?>
    <?php $fechaUltimoLogin = usuarioTableClass::LAST_LOGIN_AT ?>
    <?php $fechaCreacion = usuarioTableClass::CREATED_AT ?>
    <?php $activado = usuarioTableClass::ACTIVED ?>
    <legend><h1><i class="fa fa-user"></i> Usuario "<?php echo $usuario->$nombreUsuario ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('nombreUsuario') ?></h4>
        <p class="list-group-item-text"><?php echo $usuario->$nombreUsuario ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaCreacion') ?></h4>
        <p class="list-group-item-text"><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($usuario->$fechaCreacion)) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaUltimoLogin') ?></h4>
        <p class="list-group-item-text"><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($usuario->$fechaUltimoLogin)) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('activado') ?></h4>
        <p class="list-group-item-text"><?php echo ($usuario->$activado) ? i18nClass::__('si') : i18nClass::__('no') ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'edit', array($id => $usuario->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>