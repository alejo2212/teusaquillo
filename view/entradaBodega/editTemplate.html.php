<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
    <fieldset>
        <legend><h1><i class="fa fa-edit"></i> Editar Entrada de Bodega</h1></legend>
        <?php \mvc\view\viewClass::includePartial('entradaBodega/formentradaBodega', array('edit' => $edit,'objentradaBodega' => $objentradaBodega, 'objempleado' => $objempleado, 'objtransportador' => $objtransportador)) ?>
    </fieldset>
</div>