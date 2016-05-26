<?php use mvc\translator\translatorClass AS translator ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>
<div class="container container-fluid">
    <div class="page-header">
        <h3>ALISTAMIENTO REPARACION</h3>
    </div>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->

    <div id="toolBarGeneral" role="toolbar"><!-- subimos los botones listo-->
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
        <a  data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw "></i> Resetear</a>

        <div class="btn-group">
            <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
            <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'informe') ?>" target=_blank ><i class="fa fa-file-text-o fa-fw"></i> Completo</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
            </ul>
        </div>


    </div>


    <?php if (count($objalistamientoReparacion) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>

        <form action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'deleteAll') ?>" method="post" id="gridMain">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>

                            <th>Registro Alistamiento</th>
                            <th>Tipo de Reparacion</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Finalizacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = alistamientoReparacionTableClass::ID ?>
                        <?php $registoali = alistamientoReparacionTableClass:: REGISTRO_ALISTAMIENTO_ID ?>
                        <?php $tiporepa = alistamientoReparacionTableClass::TIPO_REPARACION_ID ?>
                        <?php $fechaini = alistamientoReparacionTableClass::FECHA_INICIO ?>
                        <?php $fechafin = alistamientoReparacionTableClass::FECHA_FIN ?>

                        <?php foreach ($objalistamientoReparacion as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                                <td><?php echo $data->$registoali ?></td>
                                <td><?php echo tipoReparacionTableClass::getNombreById($data->$tiporepa) ?></td>
                                <td><?php echo ($data->$fechaini) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechaini))) : 'No Registrada' ?></td>
                                <td><?php echo ($data->$fechafin) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechafin))) : 'No Registrada' ?></td>

                                <td class="acciones">
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'view', array(alistamientoReparacionTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'edit', array(alistamientoReparacionTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index') ?>"><!-- cortamos y cambiamos la direccion donde quiere que nos llegue paginacion-->
                                    <?php for ($x = 0; $x < $countPages; $x++): ?>
                                        <option <?php echo ($page == $x) ? 'selected' : '' ?> value="<?php echo ($x + 1) ?>"><?php echo ($x + 1) ?></option>
                                    <?php endfor ?>
                                </select> de <?php echo $countPages ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    <?php endif ?>
</div>
<?php mvc\view\viewClass::includePartial('alistamientoReparacion/filters', array('countPages' => $countPages, 'objalistamientoReparacion' => $objalistamientoReparacion, 'objtiporepa' => $objtiporepa)) ?>
<?php mvc\view\viewClass::includePartial('alistamientoReparacion/informe', array('objalistamientoReparacion' => $objalistamientoReparacion, 'objtiporepa' => $objtiporepa)) ?>
<?php mvc\view\viewClass::includePartial('alistamientoReparacion/deleteModal') ?>
