<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Mantenimiento</h1></legend>
  <?php \mvc\view\viewClass::includePartial('mantenimiento/formMantenimiento', array('objTipoMante' => $objTipoMante, 'objMaquina' => $objMaquina, 'objEmpleado' => $objEmpleado)) ?>
    </fieldset>
</div>