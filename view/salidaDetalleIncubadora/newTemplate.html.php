<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Detalle de Postura</h1></legend>
    <?php \mvc\view\viewClass::includePartial('salidaDetalleIncubadora/formDetaIncu', array('idSalida' => $idSalida, 'objEmpaque' => $objEmpaque, 'objincubadora' => $objincubadora)) ?>
    </fieldset>
</div>