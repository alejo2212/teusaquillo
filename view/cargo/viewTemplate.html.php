<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = cargoTableClass::ID ?>
    <?php $nombre = cargoTableClass::NOMBRE ?>
    <?php $descripcion = cargoTableClass::DESCRIPCION ?>
    <legend><h1><i class="fa fa-bookmark"></i> <?php echo i18nClass::__('cargo') ?> "<?php echo $objCargo->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('descripcionCargo') ?></h4>
        <p class="list-group-item-text"><?php echo ($objCargo->$descripcion) ? $objCargo->$descripcion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'edit', array($id => $objCargo->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>