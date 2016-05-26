<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar una Clasificacion Maquina</h1></legend>
    <?php \mvc\view\viewClass::includePartial('clasificacionMaquina/formclasiMaquina', array('edit' => $edit, 'objclasiMaquina' => $objclasiMaquina)) ?>
  </fieldset>
</div>