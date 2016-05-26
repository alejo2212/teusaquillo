<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar un Tipo de Identificacion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('tipoid/formTipoid', array('edit' => $edit, 'objTipoid' => $objTipoid)) ?>
  </fieldset>
</div>