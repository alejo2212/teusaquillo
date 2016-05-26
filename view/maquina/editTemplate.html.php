<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar una Maquina</h1></legend>
    <?php \mvc\view\viewClass::includePartial('maquina/formMaquina', array('edit' => $edit, 'objMaquina' => $objMaquina, 'objClasiMaquina' => $objClasiMaquina)) ?>
  </fieldset>
</div>