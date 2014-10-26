<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Tipo de Insumo</h1></legend>
    <?php \mvc\view\viewClass::includePartial('tipoInsumo/formtipoInsumo', array('edit' => $edit, 'objtipoInsumo' => $objtipoInsumo)) ?>
  </fieldset>
</div>