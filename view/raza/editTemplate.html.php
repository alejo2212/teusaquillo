<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php use mvc\i18n\i18nClass ?>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> <?php echo i18nClass::__('editarRaza') ?></h1></legend>
    <?php \mvc\view\viewClass::includePartial('raza/formRaza', array('edit' => $edit, 'raza' => $raza)) ?>
  </fieldset>
</div>