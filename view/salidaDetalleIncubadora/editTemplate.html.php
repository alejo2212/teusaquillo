<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php $idSalida = salidaDetalleIncubadoraTableClass::ID ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Detalle Salida Incubadora</h1></legend>
    <?php \mvc\view\viewClass::includePartial('salidaDetalleIncubadora/formDetaIncu', array('edit' => $edit, 'objDetalleSalida' => $objDetalleSalida, 'idSalida' => $objDetalleSalida->$idSalida, 'objEmpaque' => $objEmpaque, 'objincubadora' => $objincubadora)) ?>
  </fieldset>
</div>