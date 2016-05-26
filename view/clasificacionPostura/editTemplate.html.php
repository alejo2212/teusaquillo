<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Clasificacion de Postura</h1></legend>
    <?php \mvc\view\viewClass::includePartial('clasificacionPostura/formClasificacionPostura', array('edit' => $edit, 'objclasificacionPostura' => $objclasificacionPostura)) ?>
  </fieldset>
</div>