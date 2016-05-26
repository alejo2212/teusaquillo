<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Localizacion</h1></legend>
  <?php \mvc\view\viewClass::includePartial('localizacion/formLocalizacion', array('objLocalidad' => $objLocalidad)) ?>
    </fieldset>
</div>