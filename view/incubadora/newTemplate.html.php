<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Tipo de Mantenimiento</h1></legend>
  <?php \mvc\view\viewClass::includePartial('incubadora/formIncubadora', array('objlocalidad' => $objlocalidad)) ?>
    </fieldset>
</div>