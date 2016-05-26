<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar un Empleado</h1></legend>
    <?php \mvc\view\viewClass::includePartial('empleado/formEmpleado', array('edit' => $edit, 'objEmpleado' => $objEmpleado, 'objTipoid' => $objTipoid, 'objCiudad' => $objCiudad, 'objCargo' => $objCargo, 'objUsuario' => $objUsuario, 'objDeptos' => $objDeptos)) ?>
  </fieldset>
</div>