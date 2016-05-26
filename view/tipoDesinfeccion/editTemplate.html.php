<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
     <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i><?php echo i18nClass::__('EditarTipoDesinfeccion')?></h1></legend>
    <?php \mvc\view\viewClass::includePartial('tipoDesinfeccion/formtipoDesinfeccion', array('edit' => $edit, 'objtipoDesinfeccion' => $objtipoDesinfeccion)) ?>
  </fieldset>
</div>