<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Localidad</h1></legend>
    <?php \mvc\view\viewClass::includePartial('localizacion/formLocalizacion', array('edit' => $edit, 'objLocalidadE' => $objLocalidadE, 'objLocalidad' => $objLocalidad)) ?>
  </fieldset>
</div>