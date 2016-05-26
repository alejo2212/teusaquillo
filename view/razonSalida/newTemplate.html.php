<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
        <legend><h1>Nuevo Razon Salida</h1></legend>
        <?php \mvc\view\viewClass::includePartial('razonSalida/formRazonSalida') ?>
    </fieldset>
</div>