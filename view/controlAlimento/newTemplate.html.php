<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Control de Alimento</h1></legend>
  <?php \mvc\view\viewClass::includePartial('controlAlimento/formAlimento', array('objEmpleado' => $objEmpleado, 'objAmbienteHistorial'=> $objAmbienteHistorial)) ?>
    </fieldset>
</div>