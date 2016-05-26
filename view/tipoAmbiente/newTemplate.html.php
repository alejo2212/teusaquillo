<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<div class="container container-fluid">
  <fieldset>
      <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
    <legend><h1><?php echo i18nClass::__('nuevoTipoAmbiente') ?></h1></legend>
  <?php \mvc\view\viewClass::includePartial('tipoAmbiente/formtipoAmbiente') ?>
    </fieldset>
</div>