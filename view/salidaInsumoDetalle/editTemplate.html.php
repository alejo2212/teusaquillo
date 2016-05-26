<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<?php $idSalidaDeta = salidaInsumoDetalleTableClass::ID ?>
<div class="container container-fluid">
<?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i>  <?php echo i18nClass::__('editarSalidaInsumoDetalle') ?></h1></legend>
    <?php \mvc\view\viewClass::includePartial('salidaInsumoDetalle/formsalidaInsumoDetalle', array('edit' => $edit, 'SalidainsumoDetalle' => $SalidainsumoDetalle, 'idSalidaDeta' => $SalidainsumoDetalle->$idSalidaDeta, 'objInsumo' => $objInsumo, 'objBodegas' => $objBodegas)) ?>
  </fieldset>
</div>