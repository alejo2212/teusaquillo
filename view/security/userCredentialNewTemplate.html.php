<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva asociación de usuario y credencial</h1></legend>
    <?php \mvc\view\viewClass::includePartial('security/formUserCredentialNew', array('objUsuarios' => $objUsuarios, 'objCredenciales' => $objCredenciales)) ?>
  </fieldset>
</div>