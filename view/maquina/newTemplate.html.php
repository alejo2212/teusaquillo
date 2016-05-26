<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1>Nueva Maquina o Equipo</h1></legend>
  <?php \mvc\view\viewClass::includePartial('maquina/formMaquina', array('objClasiMaquina' => $objClasiMaquina, 'objclasibodega' => $objclasibodega)) ?>
    </fieldset>
</div>