<?php

use mvc\translator\translatorClass AS translator ?>
<?php
use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = controlAlimentoTableClass::ID ?>
    <?php $ambHistoLote = controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID ?>
    <?php $salidaInsumo = controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
    <?php $emple = controlAlimentoTableClass::ID_EMPLEADO ?>
    <?php $sexo = controlAlimentoTableClass::SEXO ?>
    <?php $cantidad = controlAlimentoTableClass::CANTIDAD ?>
    <?php $fecha = controlAlimentoTableClass::FECHA ?>
    <?php $semana = controlAlimentoTableClass::SEMANA ?>
    <?php $observacion = controlAlimentoTableClass::OBSERVACION ?>
    <legend><h1><i class="fa fa-bookmark"></i> <?php echo i18nClass::__('controlalimento') ?> "<?php echo ($objControlAlimento->$fecha) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objControlAlimento->$fecha))) : 'No Registrada' ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('sexo') ?></h4>
        <p class="list-group-item-text"><?php echo ($objControlAlimento->$sexo) ? 'Masculino' : 'Femenino' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('empleado') ?></h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objControlAlimento->$emple) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidad') ?></h4>
        <p class="list-group-item-text"><?php echo $objControlAlimento->$cantidad ?> Blts</p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('semana') ?></h4>
        <p class="list-group-item-text"><?php echo $objControlAlimento->$semana ?></p>
      </div>
    </div>


    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              <b><i class="fa fa-angle-double-down"> </i> Ver Salida de Insumo numero <?php echo $objControlAlimento->$salidaInsumo ?></b>
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
                <?php $datos = salidaInsumoDetalleTableClass::getInsumosByIdSalidaInsumo($objControlAlimento->$salidaInsumo) ?>
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
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('observacion') ?></h4>
        <p class="list-group-item-text"><?php echo ($objControlAlimento->$observacion) ? $objControlAlimento->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'edit', array($id => $objControlAlimento->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>