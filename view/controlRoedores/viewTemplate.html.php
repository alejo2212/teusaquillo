<?php

use mvc\translator\translatorClass AS translator ?>
<?php
use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = controlRoedoresTableClass::ID ?>
    <?php $admin = controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR ?>
    <?php $veteri = controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO ?>
    <?php $respon = controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE ?>
    <?php $fechare = controlRoedoresTableClass::FECHA_REALIZACION ?>
    <?php $insumo = controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID ?>
    <?php $pellets = controlRoedoresTableClass::PELLETS ?>
    <?php $bloques = controlRoedoresTableClass::BLOQUES ?>
    <?php $eviconsu = controlRoedoresTableClass::EVIDENCIA_CONSUMO ?>
    <?php $lugar = controlRoedoresTableClass::LUGAR ?>
    <?php $observa = controlRoedoresTableClass::OBSERVACION ?>
    <?php $deleted = controlRoedoresTableClass::DELETED_AT ?>

    <legend><h1><i class="fa fa-wechat"></i> Control Roedores</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Administrador</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objcontrolRoedores->$admin) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Veterinario</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objcontrolRoedores->$veteri) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Responsable</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objcontrolRoedores->$respon) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Realizacion</h4>
        <p class="list-group-item-text"><?php echo ($objcontrolRoedores->$fechare) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objcontrolRoedores->$fechare))) : 'No Registrada' ?></p>
      </div>
    </div>


    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              <b><i class="fa fa-angle-double-down"> </i> Ver Salida de Insumo numero <?php echo $objcontrolRoedores->$insumo ?></b>
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
                <?php $datos = salidaInsumoDetalleTableClass::getInsumosByIdSalidaInsumo($objcontrolRoedores->$insumo) ?>
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
        <h4 class="list-group-item-heading">Lugar De Aplicacion</h4>
        <p class="list-group-item-text"><?php echo $objcontrolRoedores->$lugar ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Pellets</h4>
        <p class="list-group-item-text"><?php echo $objcontrolRoedores->$pellets ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Bloques</h4>
        <p class="list-group-item-text"><?php echo $objcontrolRoedores->$bloques ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Evidencia De Consumo</h4>
        <p class="list-group-item-text"><?php echo ($objcontrolRoedores->$eviconsu) ? 'Si' : 'No' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observaciones</h4>
        <p class="list-group-item-text"><?php echo ($objcontrolRoedores->$observa) ? $objcontrolRoedores->$observa : 'Ninguna' ?></p>
      </div>
    </div>
</div>
</fieldset>
<div class="text-right">
  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', 'edit', array($id => $objcontrolRoedores > $id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
</div>
</div>