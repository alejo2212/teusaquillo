<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Credencial</h1></legend>
  <?php \mvc\view\viewClass::includePartial('credencial/formCredencial') ?>
    </fieldset>
</div>