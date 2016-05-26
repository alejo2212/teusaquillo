<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Registro Desinfeccion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('registroDesinfeccion/formregistroDesinfeccion', array('edit' => $edit, 'objregistroDesinfeccion' => $objregistroDesinfeccion, 'objtipoDesinfeccion' => $objtipoDesinfeccion,  'objRespon'=>$objRespon, 'objVerificador'=>$objVerificador, 'numramadas'=>$numramadas )) ?>
  </fieldset>
</div>