<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = detalleMantenimientoTableClass::ID ?>
    <?php $idMante = detalleMantenimientoTableClass::MANTENIMIENTO_ID ?>
    <?php $descripcion = detalleMantenimientoTableClass::DESCRIPCION ?>
    <?php $valor = detalleMantenimientoTableClass::VALOR ?>
    <?php $observacion = detalleMantenimientoTableClass::OBSERVACION ?>
    <legend><h1><i class="fa fa-bookmark"></i> Detalle Mantenimiento</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Codigo de Mantenimiento</h4>
        <p class="list-group-item-text"><?php echo $objDetalleMante->$idMante ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Descripcion</h4>
        <p class="list-group-item-text"><?php echo $objDetalleMante->$descripcion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo $objDetalleMante->$observacion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Valor</h4>
        <p class="list-group-item-text"><?php echo '$'.$objDetalleMante->$valor ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'detail', array(detalleMantenimientoTableClass::ID => $objDetalleMante->$idMante)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleMantenimiento', 'edit', array($id => $objDetalleMante->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>