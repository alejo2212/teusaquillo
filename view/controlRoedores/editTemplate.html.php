<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Control Roedores</h1></legend>
    <?php \mvc\view\viewClass::includePartial('controlRoedores/formcontrolRoedores', array('edit' => $edit, 'objcontrolRoedores' => $objcontrolRoedores, 'objEmpleado' => $objEmpleado, 'objAdmin'=>$objAdmin, 'objVeterinario'=>$objVeterinario)) ?>
  </fieldset>
</div>