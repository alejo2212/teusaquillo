<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Unidad Medida</h1></legend>
    <?php \mvc\view\viewClass::includePartial('unidadMedida/formunidadMedida', array('edit' => $edit, 'objunidadMedida' => $objunidadMedida)) ?>
  </fieldset>
</div>