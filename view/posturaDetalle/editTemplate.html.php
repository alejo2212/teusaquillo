<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php $idPostura = posturaDetalleTableClass::ID ?>
<div class="container container-fluid">
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Detalle Postura</h1></legend>
    <?php \mvc\view\viewClass::includePartial('posturaDetalle/formPosturaDetalle', array('edit' => $edit, 'objDetallePostu' => $objDetallePostu, 'idPostura' => $objDetallePostu->$idPostura, 'objEmpleado' => $objEmpleado, 'objclasi' => $objclasi)) ?>
  </fieldset>
</div>