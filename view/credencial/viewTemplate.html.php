<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = credencialTableClass::ID ?>
    <?php $nombre = credencialTableClass::NOMBRE ?>
    <?php $creado = credencialTableClass::CREATED_AT ?>
    <legend><h1><i class="fa fa-bookmark"></i> <?php echo i18nClass::__('credencialNombre') ?> "<?php echo $objCredencial->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechacreacion') ?></h4>
        <p class="list-group-item-text"><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objCredencial->$creado)) ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', 'edit', array($id => $objCredencial->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>