<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo Tipo de Empaque</h1></legend>
  <?php \mvc\view\viewClass::includePartial('tipoEmpaque/formtipoEmpaque') ?>
    </fieldset>
</div>