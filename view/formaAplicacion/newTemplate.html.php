<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <fieldset>
    <legend><h1>Nueva Forma De Aplicacion</h1></legend>
  <?php \mvc\view\viewClass::includePartial('formaAplicacion/formformaAplicacion') ?>
    </fieldset>
</div>