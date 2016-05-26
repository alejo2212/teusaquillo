<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Detalle de Postura</h1></legend>
    <?php \mvc\view\viewClass::includePartial('posturaDetalle/formPosturaDetalle', array('idPostura' => $idPostura, 'objEmpleado' => $objEmpleado, 'objclasi' => $objclasi, 'contadorclasi' => $contadorclasi)) ?>
    </fieldset>
</div>