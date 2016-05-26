<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Control Cucarron</h1></legend>
    <?php \mvc\view\viewClass::includePartial('controlCucarron/formcontrolCucarron', array('edit' => $edit, 'objcontrolCucarron' => $objcontrolCucarron, 'objEmpleado' => $objEmpleado,'objformaAplicacion' => $objformaAplicacion, 'objAdmin'=>$objAdmin, 'objVeterinario'=>$objVeterinario)) ?>
  </fieldset>
</div>