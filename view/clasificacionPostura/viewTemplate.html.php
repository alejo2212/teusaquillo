<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = clasificacionPosturaTableClass::ID ?>
    <?php $nombre = clasificacionPosturaTableClass::NOMBRE ?>
    <?php $descripcion = clasificacionPosturaTableClass::DESCRIPCION ?>
    <?php $observacion = clasificacionPosturaTableClass::OBSERVACION ?>
    <legend><h1><i class="fa fa-twitter"></i> Clasificacion de Postura "<?php echo $objclasificacionPostura->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Descripcion</h4>
        <p class="list-group-item-text"><?php echo $objclasificacionPostura->$descripcion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objclasificacionPostura->$observacion) ? $objclasificacionPostura->$observacion: 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'edit', array($id => $objclasificacionPostura->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>