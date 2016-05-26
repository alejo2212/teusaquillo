<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Insumo</h1></legend>
    <?php \mvc\view\viewClass::includePartial('insumo/forminsumo', array('edit' => $edit, 'objinsumo' => $objinsumo,'objtipoinsumo' => $objtipoinsumo, 'objpresentacion' => $objpresentacion, 'objunidadmedida' => $objunidadmedida)) ?>
  </fieldset>
</div>