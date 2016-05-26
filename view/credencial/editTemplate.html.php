<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Credencial</h1></legend>
    <?php \mvc\view\viewClass::includePartial('credencial/formCredencial', array('edit' => $edit, 'objCredencial' => $objCredencial)) ?>
  </fieldset>
</div>