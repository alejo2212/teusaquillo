<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar un Tipo de Mantenimiento</h1></legend>
    <?php \mvc\view\viewClass::includePartial('tipoMantenimiento/formtipoMante', array('edit' => $edit, 'objTipoMante' => $objTipoMante)) ?>
  </fieldset>
</div>