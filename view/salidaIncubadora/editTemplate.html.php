<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar una Salida de Incubadora</h1></legend>
    <?php \mvc\view\viewClass::includePartial('salidaIncubadora/formSaliIncubadora', array('edit' => $edit, 'objSalida' => $objSalida, 'objEmpleado' => $objEmpleado, 'idanual' => $idanual)) ?>
  </fieldset>
</div>