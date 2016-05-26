<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\i18n\i18nClass ?>
<?php $id = clasificacionMaquinaTableClass::ID ?>
<?php $nombre = clasificacionMaquinaTableClass::NOMBRE ?>
<?php $descripcion = clasificacionMaquinaTableClass::DESCRIPCION ?>


<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-bookmark"></i> Nombre "<?php echo $objclasiMaquina->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Descripcion</h4>
        <p class="list-group-item-text"><?php echo ($objclasiMaquina->$descripcion) ? $objclasiMaquina->$descripcion : 'Ninguna' ?></p>
      </div>
    </div>
    
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionMaquina', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionMaquina', 'edit', array($id => $objclasiMaquina->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>