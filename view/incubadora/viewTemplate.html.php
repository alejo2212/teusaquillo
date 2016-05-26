<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<?php $idCiu = localidadTableClass::ID ?>
<?php $nomCiu = localidadTableClass::NOMBRE ?>
<?php $id = incubadoraTableClass::ID ?>
<?php $nombre = incubadoraTableClass::NOMBRE ?>
<?php $ciudad = incubadoraTableClass::LOCALIZACION_ID ?>
<?php $direc = incubadoraTableClass::DIRECCION ?>
<?php $obser = incubadoraTableClass::OBSERVACION ?>


<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-bookmark"></i> Incubadora "<?php echo $objincubadora->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Direccion</h4>
        <p class="list-group-item-text"><?php echo $objincubadora->$direc ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Ciudad</h4>
        <p class="list-group-item-text"><?php echo localidadTableClass::getLocalidadById($objincubadora->$ciudad) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objincubadora->$obser) ? $objincubadora->$obser : 'Ninguna' ?></p>
      </div>
    </div>

  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', 'edit', array($id => $objincubadora->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>