<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = tipoEmpaqueTableClass::ID ?>
    <?php $nombre = tipoEmpaqueTableClass::NOMBRE ?>
    <?php $descripcion = tipoEmpaqueTableClass::DESCRIPCION ?>
    <?php $cantidad = tipoEmpaqueTableClass::CANTIDAD ?>
    <legend><h1><i class="fa fa-bookmark"></i> Empaque "<?php echo $objtipoEmpaque->$nombre ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Descripcion</h4>
        <p class="list-group-item-text"><?php echo $objtipoEmpaque->$descripcion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad</h4>
        <p class="list-group-item-text"><?php echo $objtipoEmpaque->$cantidad ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'edit', array($id => $objtipoEmpaque->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>