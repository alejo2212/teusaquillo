<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Clasificacion de Postura</h1></legend>
  <?php \mvc\view\viewClass::includePartial('clasificacionPostura/formClasificacionPostura') ?>
    </fieldset>
</div>