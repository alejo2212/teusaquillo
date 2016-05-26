<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar una Devolucion de Incubadora</h1></legend>
    <?php \mvc\view\viewClass::includePartial('devolucionIncubadora/formDevolucion', array('edit' => $edit, 'objdevolucion' => $objdevolucion, 'objEmpleado' => $objEmpleado)) ?>
  </fieldset>
</div>