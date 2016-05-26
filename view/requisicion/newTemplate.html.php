<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Requisicion</h1></legend>
  <?php \mvc\view\viewClass::includePartial('requisicion/formRequisicion', array('objEmpleado' => $objEmpleado)) ?>
    </fieldset>
</div>