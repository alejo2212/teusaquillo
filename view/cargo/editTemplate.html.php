<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar un Cargo</h1></legend>
    <?php \mvc\view\viewClass::includePartial('cargo/formCargo', array('edit' => $edit, 'objCargo' => $objCargo)) ?>
  </fieldset>
</div>