<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Clasificacion Bodega</h1></legend>
    <?php \mvc\view\viewClass::includePartial('bodegaClasificacion/formbodegaClasificacion', array('edit' => $edit, 'objbodegaClasificacion' => $objbodegaClasificacion)) ?>
  </fieldset>
</div>
