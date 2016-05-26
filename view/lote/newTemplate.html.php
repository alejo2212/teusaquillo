<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>

<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
  <fieldset>
    <legend><h1><?php echo i18nClass::__('nuevoLote') ?></h1></legend>
  <?php \mvc\view\viewClass::includePartial('lote/formLote', array('objRaza' => $objRaza, 'objEmpleado' => $objEmpleado)) ?>
    </fieldset>
</div>