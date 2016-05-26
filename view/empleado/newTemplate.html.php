<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Empleado</h1></legend>
    <?php \mvc\view\viewClass::includePartial('empleado/formEmpleado', array('objTipoid' => $objTipoid, 'objCiudad' => $objCiudad, 'objCargo' => $objCargo, 'objUsuario' => $objUsuario, 'objDeptos' => $objDeptos)) ?>
  </fieldset>
</div>