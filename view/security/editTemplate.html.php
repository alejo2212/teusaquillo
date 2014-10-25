<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar usuario</h1></legend>
    <?php \mvc\view\viewClass::includePartial('security/formUser', array('edit' => $edit, 'usuario' => $usuario)) ?>
  </fieldset>
</div>