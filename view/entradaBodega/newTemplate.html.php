<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
    <fieldset>
        <legend><h1>Nueva Entrada de Bodega</h1></legend>
        <?php \mvc\view\viewClass::includePartial('entradaBodega/formentradaBodega', array('objempleado' => $objempleado, 'objtransportador' => $objtransportador)) ?>
    </fieldset>
</div>