<?php

use mvc\translator\translatorClass AS translator ?>
<?php
use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = controlCucarronTableClass::ID ?>
    <?php $admin = controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR ?>
    <?php $veteri = controlCucarronTableClass::EMPLEADO_ID_VETERINARIO ?>
    <?php $respon = controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE ?>
    <?php $fechare = controlCucarronTableClass::FECHA_REALIZACION ?>
    <?php $insumo = controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID ?>
    <?php $solucion = controlCucarronTableClass::SOLUCION ?>
    <?php $formapli = controlCucarronTableClass::FORMA_APLICACION_ID ?>
    <?php $aretrata = controlCucarronTableClass::AREA_TRATADA ?>
    <?php $observa = controlCucarronTableClass::OBSERVACION ?>
    <?php $deleted = controlCucarronTableClass::DELETED_AT ?>

    <legend><h1><i class="fa fa-unlink"></i> Control Cucarron</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Administrador</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objcontrolCucarron->$admin) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Veterinario</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objcontrolCucarron->$veteri) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Responsable</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objcontrolCucarron->$respon) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Realizacion</h4>
        <p class="list-group-item-text"><?php echo ($objcontrolCucarron->$fechare) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objcontrolCucarron->$fechare))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              <b><i class="fa fa-angle-double-down"> </i> Ver Salida de Insumo numero <?php echo $objcontrolCucarron->$insumo ?></b>
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="panel-body">
            <table class="table">
              <tr>
                <th style="width: 30%;">Nombre</th>
                <th>Cantidad</th>
                <th>Disponible</th>
              </tr>
              <tbody>
                <?php $datos = salidaInsumoDetalleTableClass::getInsumosByIdSalidaInsumo($objcontrolCucarron->$insumo) ?>
                <?php foreach ($datos as $data): ?>
                  <tr>
                    <td><?php echo $data->nombre ?></td>
                    <td><?php echo $data->cantidad ?></td>
                    <td><?php echo $data->disponible ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Solucion</h4>
        <p class="list-group-item-text"><?php echo $objcontrolCucarron->$solucion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Forma De Aplicacion</h4>
        <p class="list-group-item-text"><?php echo $objcontrolCucarron->$formapli ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Area Tratada</h4>
        <p class="list-group-item-text"><?php echo $objcontrolCucarron->$aretrata ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observaciones</h4>
        <p class="list-group-item-text"><?php echo ($objcontrolCucarron->$observa) ? $objcontrolCucarron->$observa : 'Ninguna' ?></p>
      </div>
    </div>
</div>
</fieldset>
<div class="text-right">
  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', 'edit', array($id => $objcontrolCucarron > $id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
</div>
</div>