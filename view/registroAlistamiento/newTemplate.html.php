<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Registro de Alistamiento</h1></legend>
  <?php \mvc\view\viewClass::includePartial('registroAlistamiento/formRegistroAlistamiento', array('objEmpleado' => $objEmpleado, 'objlote' => $objlote)) ?>
    </fieldset>
</div>