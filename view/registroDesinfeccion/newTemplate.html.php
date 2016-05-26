<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <fieldset>
    <legend><h1>Nuevo Registro De Desinfeccion</h1></legend>
  <?php \mvc\view\viewClass::includePartial('registroDesinfeccion/formregistroDesinfeccion', array('objtipoDesinfeccion' => $objtipoDesinfeccion,  'objRespon'=>$objRespon, 'objVerificador'=>$objVerificador, 'numramadas'=>$numramadas )) ?>
    </fieldset>
</div>