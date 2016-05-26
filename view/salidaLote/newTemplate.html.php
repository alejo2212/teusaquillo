<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
        <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
        <legend><h1>Nuevo Salida Lote</h1></legend>
        <?php \mvc\view\viewClass::includePartial('salidaLote/formsalidaLote', array('objRazonSalida' => $objRazonSalida, 'objEmpleado' => $objEmpleado, 'objAmbienteHistorial'=> $objAmbienteHistorial)) ?>
    </fieldset>
</div>