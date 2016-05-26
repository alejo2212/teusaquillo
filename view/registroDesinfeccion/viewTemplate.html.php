<?php

use mvc\translator\translatorClass AS translator ?>
<?php
use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = registroDesinfeccionTableClass::ID ?>
    <?php $fechare = registroDesinfeccionTableClass::FECHA_REALIZACION ?>
    <?php $fechater = registroDesinfeccionTableClass::FECHA_TERMINADO ?>
    <?php $respon = registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE ?>
    <?php $veri = registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR ?>
    <?php $insumo = registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID ?>
    <?php $solucion = registroDesinfeccionTableClass::SOLUCION ?>
    <?php $observacion = registroDesinfeccionTableClass::OBSERVACION ?>
    <?php $tipdesin = registroDesinfeccionTableClass::TIPO_DESINFECCION_ID ?>
    <?php $deleted = registroDesinfeccionTableClass::DELETED_AT ?>

    <?php $desBodega = registroDesinfeccionTableClass::DES_BODEGA ?>
    <?php $desPediluvios = registroDesinfeccionTableClass::DES_PEDILUVIOS ?>
    <?php $desRamadas = registroDesinfeccionTableClass::DES_RAMDAS ?>
    <?php $cantPediluvios = registroDesinfeccionTableClass::CANT_PEDILUVIOS ?>

    <legend><h1><i class="fa fa-area-chart"></i> Registro Desinfeccion</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha De Realizacion</h4>
        <p class="list-group-item-text"><?php echo ($objregistroDesinfeccion->$fechare) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objregistroDesinfeccion->$fechare))) : 'No Registrada' ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha De Finalizacion</h4>
        <p class="list-group-item-text"><?php echo ($objregistroDesinfeccion->$fechater) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objregistroDesinfeccion->$fechater))) : 'No Registrada' ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Responsable</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objregistroDesinfeccion->$respon) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Verificador</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objregistroDesinfeccion->$veri) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Tipo De Desinfeccion</h4>
        <p class="list-group-item-text"><?php echo tipoDesinfeccionTableClass::getNombreById($objregistroDesinfeccion->$tipdesin) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Insumo</h4>
        <p class="list-group-item-text"><?php echo insumoTableClass::getNombreById($objregistroDesinfeccion->$insumo) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Solucion</h4>
        <p class="list-group-item-text"><?php echo $objregistroDesinfeccion->$solucion ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Bodegas desinfectadas</h4>
        <p class="list-group-item-text"><?php echo ($objregistroDesinfeccion->$desBodega) ? 'Si' : 'No' ?></p>
      </div>
      <div class="panel panel-default">
        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>Pediluvios desinfectados</th>
              <th>Cantidad</th>
              <th>Ambientes desinfectados</th>
            </tr>
            <tr>
              <td style="width: 217px;"><?php echo ($objregistroDesinfeccion->$desPediluvios) ? 'Si' : 'No' ?></td>
              <td><?php echo $objregistroDesinfeccion->$cantPediluvios ?></td>
              <td><?php echo $objregistroDesinfeccion->$desRamadas ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observaciones</h4>
        <p class="list-group-item-text"><?php echo ($objregistroDesinfeccion->$observacion) ? $objregistroDesinfeccion->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'edit', array($id => $objregistroDesinfeccion > $id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>