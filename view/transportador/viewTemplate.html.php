<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = transportadorTableClass::ID ?>
    <?php $nombre = transportadorTableClass::NOMBRE ?>
    <?php $placa = transportadorTableClass::PLACA_VAHICULO ?>
    <?php $observacion = transportadorTableClass::OBSERVACION?>
    <legend><h1><i class="fa fa-user"></i> Nombre "<?php echo $objtransportador->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Placa del Vehiculo</h4>
        <p class="list-group-item-text"><?php echo ($objtransportador->$placa) ? $objtransportador->$placa : 'Ninguna' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objtransportador->$observacion) ? $objtransportador->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'edit', array($id => $objtransportador->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>