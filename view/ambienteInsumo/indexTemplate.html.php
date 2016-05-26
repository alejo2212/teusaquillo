<?php use mvc\translator\translatorClass AS translator ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>

    <div class="container container-fluid">
    <div class="page-header">
        <h3> AMBIENTE INSUMO </h3>
    </div>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
    <div id="toolBarGeneral" role="toolbar">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i><?php echo i18nClass::__('nuevo') ?></a>
        <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> <?php echo i18nClass::__('filtrar') ?></a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i><?php echo i18nClass::__('resetear') ?></a>
        
        <div class="btn-group">
            <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
            <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'informe') ?>" target=_blank ><i class="fa fa-file fa-fw"></i> Completo</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
            </ul>
        </div>
    </div>
    <?php if (count($objAmbienteinsumo) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>
        <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'deleteAll') ?>" method="post">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18nClass::__('ambiente') ?></th>
                            <th><?php echo i18nClass::__('salidaInsumo') ?></th>
                            <th><?php echo i18nClass::__('fechaAsignacion') ?></th>
                            <th><?php echo i18nClass::__('fechaRetiro') ?></th>
                            <th><?php echo i18nClass::__('acciones') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = ambienteInsumoTableClass::ID ?>
                        <?php $ambId = ambienteInsumoTableClass::AMBIENTE_ID ?>
                        <?php $salidaInD = ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
                        <?php $fechaA = ambienteInsumoTableClass::FECHA_ASIGNACION ?>
                        <?php $fechaR = ambienteInsumoTableClass::FECHA_RETIRO ?>

                        <?php foreach ($objAmbienteinsumo as $data): ?>

                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                                <td><?php echo ambientetableClass::getNombreById($data->$ambId) ?></td>
                                <td><?php echo $data->$salidaInD ?></td>
                                <td><?php echo  ($data->$fechaA) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechaA))) : 'No Registrada' ?></td>
                                <td><?php echo ($data->$fechaR) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechaR))) : 'No Registrada' ?></td>
                                <td class="acciones">
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'view', array(ambienteInsumoTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'edit', array(ambienteInsumoTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index') ?>">
                                    <?php for ($x = 0; $x < $countPages; $x++): ?>
                                        <option <?php echo ($page == $x) ? 'selected' : '' ?> value="<?php echo ($x + 1) ?>"><?php echo ($x + 1) ?></option>
                                    <?php endfor ?>
                                </select> de de <?php echo $countPages ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    <?php endif ?>
</div>
<?php mvc\view\viewClass::includePartial('ambienteInsumo/filters', array('countPages' => $countPages, 'objAmbiente' => $objAmbiente)) ?>
<?php mvc\view\viewClass::includePartial('ambienteInsumo/informe', array( 'objAmbiente' => $objAmbiente)) ?>
<?php mvc\view\viewClass::includePartial('ambienteInsumo/deleteModal') ?>
