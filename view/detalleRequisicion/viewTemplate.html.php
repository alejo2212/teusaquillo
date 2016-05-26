<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = requisiciondetalleTableClass::ID ?>
    <?php $requisicion = requisiciondetalleTableClass::REQUISICION_ID ?>
    <?php $bodega = requisiciondetalleTableClass::BODEGA_ID ?>
    <?php $cantidad = requisiciondetalleTableClass::CANTIDAD ?>
    <?php $fecha = requisiciondetalleTableClass::FECHA_NECESIDAD ?>
    <legend><h1><i class="fa fa-bookmark"></i> Detalle Requisicion</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Numero de Requisicion</h4>
        <p class="list-group-item-text"><?php echo $objDetalleRequi->$requisicion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Bodega</h4>
        <p class="list-group-item-text"><?php echo $objDetalleRequi->$bodega ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad Solicitada</h4>
        <p class="list-group-item-text"><?php echo $objDetalleRequi->$cantidad ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de necesidad</h4>
        <p class="list-group-item-text"><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objDetalleRequi->$fecha)) ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'detail', array(requisicionTableClass::ID => $objDetalleRequi->$requisicion)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'edit', array($id => $objDetalleRequi->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>