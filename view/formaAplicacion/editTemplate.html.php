<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Forma De Aplicacion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('formaAplicacion/formformaAplicacion', array('edit' => $edit, 'objformaAplicacion' => $objformaAplicacion)) ?>
  </fieldset>
</div>