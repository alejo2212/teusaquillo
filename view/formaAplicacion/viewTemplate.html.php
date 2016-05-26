<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = formaAplicacionTableClass::ID ?>
    <?php $nombre = formaAplicacionTableClass::NOMBRE ?>
    <?php $descripcion = formaAplicacionTableClass::DESCRIPCION?>
    <legend><h1><i class="fa fa-eyedropper"></i> Forma De Aplicacion </h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Nombre</h4>
        <p class="list-group-item-text"><?php echo $objformaAplicacion->$nombre ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Descripcion</h4>
        <p class="list-group-item-text"><?php echo $objformaAplicacion->$descripcion ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('formaAplicacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('formaAplicacion', 'edit', array($id => $objformaAplicacion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>