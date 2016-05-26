<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <fieldset>
    <legend><h1>Nuevo Tipo De Desinfeccion</h1></legend>
  <?php \mvc\view\viewClass::includePartial('tipoDesinfeccion/formtipoDesinfeccion') ?>
    </fieldset>
</div>