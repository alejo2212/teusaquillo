
<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = salidaInsumoDetalleTableClass::ID ?>
    <?php $salidaIn = salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID ?>
    <?php $bodegaId = salidaInsumoDetalleTableClass::BODEGA_ID ?>
    <?php $cantidad = salidaInsumoDetalleTableClass::CANTIDAD ?>
    <?php $insumo = salidaInsumoDetalleTableClass::INSUMO_ID ?>
    <?php $observacion = salidaInsumoDetalleTableClass::OBSERVACION ?>
    <?php $anulado = salidaInsumoDetalleTableClass::ANULADO ?>

    <legend><h1><i class="fa fa-user"></i> Salida Insumo N°  "<?php echo $salidaInsumoDetalle->$salidaIn ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Bodega</h4>
        <p class="list-group-item-text"><?php echo bodegaTableClass::getNombreBodegaById($salidaInsumoDetalle->$bodegaId) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Insumo</h4>
        <p class="list-group-item-text"><?php echo insumoTableClass::getNombreById($salidaInsumoDetalle->$insumo) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidad') ?></h4>
        <p class="list-group-item-text"><?php echo $salidaInsumoDetalle->$cantidad ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('observacion') ?></h4>
        <p class="list-group-item-text"><?php echo $salidaInsumoDetalle->$observacion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('anulado') ?></h4>
        <p class="list-group-item-text"><?php echo ($salidaInsumoDetalle->$anulado) ? i18nClass::__('no') : i18nClass::__('si') ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'detail', array('id' => $salidaInsumoDetalle->$salidaIn)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'edit', array($id => $salidaInsumoDetalle->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i><?php echo i18nClass::__('editar') ?> </a>
  </div>
</div>