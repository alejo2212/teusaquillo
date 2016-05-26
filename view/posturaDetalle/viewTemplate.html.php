<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = posturaDetalleTableClass::ID ?>
    <?php $idPostu = posturaDetalleTableClass::POSTURA_ID ?>
    <?php $idClasi = posturaDetalleTableClass::CLASIFICACION_POSTURA_ID ?>
    <?php $idEmple = posturaDetalleTableClass::EMPLEADO_ID ?>
    <?php $cantidad = posturaDetalleTableClass::CANTIDAD ?>
    <?php $venta = posturaDetalleTableClass::INGRESO_VENTA ?>
    <legend><h1><i class="fa fa-bookmark"></i> Detalle Postura</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Numero de Postura</h4>
        <p class="list-group-item-text"><?php echo $objDetallePostu->$idPostu ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Clasificacion</h4>
        <p class="list-group-item-text"><?php echo clasificacionPosturaTableClass::getClasificacionById($objDetallePostu->$idClasi) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad</h4>
        <p class="list-group-item-text"><?php echo $objDetallePostu->$cantidad ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Total Venta</h4>
        <p class="list-group-item-text"><?php echo $objDetallePostu->$venta ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Empleado</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objDetallePostu->$idEmple) ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'detail', array(posturaTableClass::ID => $objDetallePostu->$idPostu)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'edit', array($id => $objDetallePostu->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>