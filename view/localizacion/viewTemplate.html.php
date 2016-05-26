<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = localidadTableClass::ID ?>
    <?php $nombre = localidadTableClass::NOMBRE ?>
    <?php $localidadId = localidadTableClass::LOCALIDAD_ID ?>
    <legend><h1><i class="fa fa-road"></i> <?php echo i18nClass::__('ciudad') ?> "<?php echo $objLocalizaciones->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('departamento') ?></h4>
        <p class="list-group-item-text"><?php echo $objLocalizaciones->$nombre ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'edit', array($id => $objLocalizaciones->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>