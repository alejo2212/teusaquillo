<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Tipo De Desinfeccion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('tipoDesinfeccion/formtipoDesinfeccion', array('edit' => $edit, 'objtipoDesinfeccion' => $objtipoDesinfeccion)) ?>
  </fieldset>
</div>