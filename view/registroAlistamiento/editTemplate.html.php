<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar un Registro de Alistamiento</h1></legend>
    <?php \mvc\view\viewClass::includePartial('registroAlistamiento/formRegistroAlistamiento', array('edit' => $edit, 'objregistroAlistamiento' => $objregistroAlistamiento,'objEmpleado' => $objEmpleado, 'objlote' => $objlote)) ?>
  </fieldset>
</div>