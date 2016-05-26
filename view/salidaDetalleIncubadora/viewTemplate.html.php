<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = salidaDetalleIncubadoraTableClass::ID ?>
    <?php $salida = salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID ?>
    <?php $incubadora = salidaDetalleIncubadoraTableClass::INCUBADORA_ID ?>
    <?php $empaque = salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID ?>
    <?php $cantidad = salidaDetalleIncubadoraTableClass::CANTIDAD ?>
    <?php $descripcion = salidaDetalleIncubadoraTableClass::DESCRIPCION ?>
    <?php $canti_emp = salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE ?>
    <legend><h1><i class="fa fa-bookmark"></i> Detalle Salida Incubadora</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Incubadora</h4>
        <p class="list-group-item-text"><?php echo incubadoraTableClass::getIncubadoraById($objDetalleSalida->$incubadora) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Numero de Salida</h4>
        <p class="list-group-item-text"><?php echo $objDetalleSalida->$salida ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad</h4>
        <p class="list-group-item-text"><?php echo $objDetalleSalida->$cantidad ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Tipo de Empaque</h4>
        <p class="list-group-item-text"><?php echo tipoEmpaqueTableClass::getTipoEmpaqueById($objDetalleSalida->$empaque) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad de Empaque</h4>
        <p class="list-group-item-text"><?php echo $objDetalleSalida->$canti_emp ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Descripcion</h4>
        <p class="list-group-item-text"><?php echo $objDetalleSalida->$descripcion ?></p>
      </div>
    </div>
    
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => $objDetalleSalida->$salida)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'edit', array($id => $objDetalleSalida->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>