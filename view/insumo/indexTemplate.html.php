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
        <h3>INSUMO</h3>
    </div>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->

    <div id="toolBarGeneral" role="toolbar"><!-- subimos los botones listo-->
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
        <a  data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw "></i> Resetear</a>

        <div class="btn-group">
            <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
            <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'informe') ?>" target=_blank ><i class="fa fa-file-text-o fa-fw"></i> Completo</a></li>
                <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
            </ul>
        </div>


    </div>


    <?php if (count($objinsumo) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>

        <form action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'deleteAll') ?>" method="post" id="gridMain">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>

                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Tipo de Insumo</th>
                            <th>Presentaion del Insumo</th>
                            <th>Unidad Medida</th>
                            <th>Existencia en Bodega</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = insumoTableClass::ID ?>
                        <?php $actived = insumoTableClass::ACTIVO ?>
                        <?php $nombre = insumoTableClass::NOMBRE ?>
                        <?php $tpinsumo = insumoTableClass::TIPO_INSUMO_ID ?>
                        <?php $prinsumo = insumoTableClass::PRESENTACION_ID ?>
                        <?php $presen = insumoTableClass::UNIDAD_MEDIDA_ID ?>
                        <?php $existencia = insumoTableClass::INVENTARIO_BODEGA ?>

                        <?php foreach ($objinsumo as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                                <td class="text-center"><i class="fa fa-<?php echo ($data->$actived) ? 'check clrVerde' : 'times clrRojo' ?>"></i></td>
                                <td><?php echo $data->$nombre ?></td>
                                <td><?php echo tipoInsumoTableClass::getNombreById($data->$tpinsumo) ?></td>
                                <td><?php echo presentacionTableClass::getNombreById($data->$prinsumo) ?></td>
                                <td><?php echo unidadMedidaTableClass::getNombreById($data->$presen) ?></td>
                                <td><?php echo $data->$existencia ?></td>

                                <td class="acciones">
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'view', array(tipoInsumoTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'edit', array(tipoInsumoTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index') ?>"><!-- cortamos y cambiamos la direccion donde quiere que nos llegue paginacion-->
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
<?php mvc\view\viewClass::includePartial('insumo/filters', array('countPages' => $countPages, 'objtipoinsumo' => $objtipoinsumo, 'objpresentacion' => $objpresentacion, 'objunidadmedida' => $objunidadmedida)) ?>
<?php mvc\view\viewClass::includePartial('insumo/informe', array( 'objtipoinsumo' => $objtipoinsumo, 'objpresentacion' => $objpresentacion, 'objunidadmedida' => $objunidadmedida)) ?>
<?php mvc\view\viewClass::includePartial('insumo/deleteModal') ?>
