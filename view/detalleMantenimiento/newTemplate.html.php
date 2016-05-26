<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1>Nuevo Detalle de Mantenimiento</h1></legend>
    <?php \mvc\view\viewClass::includePartial('detalleMantenimiento/formdetaMante', array('idMantenimiento' => $idMantenimiento)) ?>
    </fieldset>
</div>