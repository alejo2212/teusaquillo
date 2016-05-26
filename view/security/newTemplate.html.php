<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nuevo usuario</h1></legend>
  <?php \mvc\view\viewClass::includePartial('security/formUser') ?>
    </fieldset>
</div>