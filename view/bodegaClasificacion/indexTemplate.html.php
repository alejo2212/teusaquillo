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
        <h3>CLASIFICACION DE BODEGA</h3>
    </div>

    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->

    <div id="toolBarGeneral" role="toolbar"><!-- subimos los botones listo-->
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
        <a  data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw "></i> Resetear</a>
    </div>


    <?php if (count($objbodegaClasificacion) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>

        <form action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'deleteAll') ?>" method="post" id="gridMain">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>

                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = bodegaClasificacionTableClass::ID ?>
                        <?php $nombre = bodegaClasificacionTableClass::NOMBRE ?>
                        <?php $actived = bodegaClasificacionTableClass::ACTIVO ?>

                        <?php foreach ($objbodegaClasificacion as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                                <td class="text-center"><i class="fa fa-<?php echo ($data->$actived) ? 'check clrVerde' : 'times clrRojo' ?>"></i></td>
                                <td><?php echo $data->$nombre ?></td>
                                <td>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'view', array(bodegaClasificacionTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'edit', array(bodegaClasificacionTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index') ?>"><!-- cortamos y cambiamos la direccion donde quiere que nos llegue paginacion-->
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
<?php mvc\view\viewClass::includePartial('bodegaClasificacion/filters', array('countPages' => $countPages)) ?>
<?php mvc\view\viewClass::includePartial('bodegaClasificacion/deleteModal') ?>
