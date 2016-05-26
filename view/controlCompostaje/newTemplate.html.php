<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  
  <fieldset>
    <legend><h1>Nuevo Control Compostaje</h1></legend>
    <?php \mvc\view\viewClass::includePartial('controlCompostaje/formcontrolCompostaje', array('idSa' => $idSa, 'objEmpleado' => $objEmpleado, 'objCajon' => $objCajon, 'objSalidalote' => $objSalidalote, 'objAdmin' => $objAdmin, 'objVeterinario' => $objVeterinario)) ?>
  </fieldset>
</div>