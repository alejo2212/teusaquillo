<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Cajon Compostaje</h1></legend>
    <?php \mvc\view\viewClass::includePartial('cajonCompostaje/formcajonCompostaje', array('edit' => $edit, 'objcajonCompostaje' => $objcajonCompostaje)) ?>
  </fieldset>
</div>