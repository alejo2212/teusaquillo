<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php $Mante = detalleMantenimientoTableClass::ID ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Detalle Mantenimiento</h1></legend>
    <?php \mvc\view\viewClass::includePartial('detalleMantenimiento/formdetaMante', array('edit' => $edit, 'objDetalleMante' => $objDetalleMante, 'Mante' => $objDetalleMante->$Mante)) ?>
  </fieldset>
</div>