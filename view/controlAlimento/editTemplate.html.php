<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar un Control de Alimento</h1></legend>
    <?php \mvc\view\viewClass::includePartial('controlAlimento/formAlimento', array('edit' => $edit, 'objControlAlimento' => $objControlAlimento, 'objEmpleado' => $objEmpleado, 'objAmbienteHistorial'=> $objAmbienteHistorial)) ?>
  </fieldset>
</div>