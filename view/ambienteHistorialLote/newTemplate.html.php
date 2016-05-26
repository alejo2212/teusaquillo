<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
    <fieldset>
        <legend><h1>Nuevo Ambiente Historial Lote</h1></legend>
        <?php \mvc\view\viewClass::includePartial('ambienteHistorialLote/formambienteHistorialLote', array('objambiente' => $objambiente, 'objlote' => $objlote)) ?>
    </fieldset>
</div>