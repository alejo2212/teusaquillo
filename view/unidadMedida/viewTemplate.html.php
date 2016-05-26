<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = unidadMedidaTableClass::ID ?>
    <?php $nombre = unidadMedidaTableClass::NOMBRE ?>
    <?php $sigla = unidadMedidaTableClass::SIGLA ?>
    <?php $observacion = unidadMedidaTableClass::OBSERVACION?>
    <legend><h1><i class="fa fa-user"></i> Nombre "<?php echo $objunidadMedida->$nombre ?>"</h1></legend>
    
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Sigla</h4>
        <p class="list-group-item-text"><?php echo $objunidadMedida->$sigla ?></p>
      </div>
    </div>
    
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objunidadMedida->$observacion) ? $objunidadMedida->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'edit', array($id => $objunidadMedida->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>