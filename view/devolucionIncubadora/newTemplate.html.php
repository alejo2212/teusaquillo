<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Devolucion</h1></legend>
  <?php \mvc\view\viewClass::includePartial('devolucionIncubadora/formDevolucion', array('objEmpleado' => $objEmpleado)) ?>
    </fieldset>
</div>