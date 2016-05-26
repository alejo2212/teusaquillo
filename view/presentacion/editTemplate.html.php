<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
    <fieldset>
        <legend><h1><i class="fa fa-edit"></i> Editar Presentacion</h1></legend>
        <?php \mvc\view\viewClass::includePartial('presentacion/formpresentacion', array('edit' => $edit, 'objpresentacion' => $objpresentacion)) ?>
    </fieldset>
</div>