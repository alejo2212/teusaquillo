<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar una Requisicion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('requisicion/formRequisicion', array('edit' => $edit, 'objRequisicion' => $objRequisicion, 'objEmpleado' => $objEmpleado)) ?>
  </fieldset>
</div>