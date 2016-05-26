<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i><?php echo i18nClass::__('editarSalidaLote') ?> </h1></legend>
    <?php \mvc\view\viewClass::includePartial('salidaLote/formsalidaLote', array('edit' => $edit, 'objRazonSalida' => $objRazonSalida, 'objEmpleado' => $objEmpleado, 'SalidaLote' => $SalidaLote, 'objAmbienteHistorial'=> $objAmbienteHistorial)) ?>
  </fieldset>
</div>