
<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = ambienteinsumoTableClass::ID ?>
        <?php $ambId = ambienteinsumoTableClass::AMBIENTE_ID ?>
        <?php $salidaInD = ambienteinsumoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
        <?php $fechaA = ambienteinsumoTableClass::FECHA_ASIGNACION ?>
        <?php $fechaR = ambienteinsumoTableClass::FECHA_RETIRO ?>

        <legend><h1><i class="fa fa-user"></i> <?php echo i18nClass::__('ambiente') ?> "<?php echo $ambienteInsumo->$ambId ?>"</h1></legend>
        <!--    <div class="list-group">
              <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('salidaInsumo') ?></h4>
                <p class="list-group-item-text"><?php echo $ambienteInsumo->$salidaInD ?></p>
              </div>
            </div>-->

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <b> <i class="fa fa-angle-double-down"> </i> Ver Salida de Insumo numero <?php echo $ambienteInsumo->$salidaInD ?></b>
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
                                <?php $datos = salidaInsumoDetalleTableClass::getInsumosByIdSalidaInsumo($ambienteInsumo->$salidaInD) ?>
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
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaAsignacion') ?></h4>
                <p class="list-group-item-text"><?php echo ($ambienteInsumo->$fechaA) ? date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($ambienteInsumo->$fechaA)) : 'No Registrada' ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaRetiro') ?></h4>
                <p class="list-group-item-text"><?php echo ($ambienteInsumo->$fechaR) ? date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($ambienteInsumo->$fechaR)) : 'No Registrada' ?></p>
            </div>
        </div>
    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?></a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'edit', array($id => $ambienteInsumo->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> <?php echo i18nClass::__('editar') ?></a>
    </div>
</div>