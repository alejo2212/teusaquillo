<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = tipoDesinfeccionTableClass::ID ?>
    <?php $nombre = tipoDesinfeccionTableClass::NOMBRE ?>
    <?php $observacion = tipoDesinfeccionTableClass::OBSERVACION?>
    <legend><h1><i class="fa fa-area-chart"></i> Tipo Desinfeccion </h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Nombre</h4>
        <p class="list-group-item-text"><?php echo $objtipoDesinfeccion->$nombre ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objtipoDesinfeccion->$observacion) ? $objtipoDesinfeccion->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'edit', array($id => $objtipoDesinfeccion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>