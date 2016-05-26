<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php $idRequisicion = requisiciondetalleTableClass::ID ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Detalle Requisicion</h1></legend>
    <?php \mvc\view\viewClass::includePartial('detalleRequisicion/formRequisicionDetalle', array('edit' => $edit, 'objDetalleRequi' => $objDetalleRequi, 'idRequisicion' => $objDetalleRequi->$idRequisicion, 'objInsumo' => $objInsumo)) ?>
  </fieldset>
</div>