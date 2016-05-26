<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>
<div class="container container-fluid">
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
    <div class="page-header">
        <h3>TIPO DESINFECCION</h3>
    </div>
    <div id="toolBarGeneral" role="toolbar">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
        <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
        
    </div>
    <?php if (count($objtipoDesinfeccion) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>

        <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'deleteAll') ?>" method="post">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>
                            <th>Nombre</th>
                            <th>Observacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = tipoDesinfeccionTableClass::ID ?>
                        <?php $nombre = tipoDesinfeccionTableClass::NOMBRE ?>
                        <?php $observacion = tipoDesinfeccionTableClass::OBSERVACION ?>

                        <?php foreach ($objtipoDesinfeccion as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                                <td><?php echo $data->$nombre ?></td>
                                <td><?php echo ($data->$observacion) ? $data->$observacion : 'Ninguna' ?></td>

                                <td>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'view', array(tipoDesinfeccionTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'edit', array(tipoDesinfeccionTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('tipoDesinfeccion/filters', array('countPages' => $countPages)) ?>

<?php mvc\view\viewClass::includePartial('tipoDesinfeccion/deleteModal') ?>

