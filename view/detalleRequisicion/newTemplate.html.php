<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Detalle de Requisicion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('detalleRequisicion/formRequisicionDetalle', array('idRequisicion' => $idRequisicion , 'objInsumo' => $objInsumo)) ?>
    </fieldset>
</div>