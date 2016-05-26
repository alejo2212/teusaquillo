<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Registro de Salida Incubadora</h1></legend>
    <?php \mvc\view\viewClass::includePartial('salidaIncubadora/formSaliIncubadora', array('objEmpleado' => $objEmpleado, 'idanual' => $idanual, 'Npedido' => $Npedido)) ?>
  </fieldset>
</div>