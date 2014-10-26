<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <?php if (count($objunidadMedida) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>
        <div id="toolBarGeneral" role="toolbar">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'delete') ?>" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
            <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-filter fa-fw"></i> Filtros</a>
            <a href="#" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
        </div>
        <form action="" method="post">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Sigla</th>
                            <th>Observacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = unidadMedidaTableClass::ID ?>
                        <?php $nombre = unidadMedidaTableClass::NOMBRE ?>
                        <?php $sigla = unidadMedidaTableClass::SIGLA ?>
                        <?php $observacion = unidadMedidaTableClass::OBSERVACION ?>

                        <?php foreach ($objunidadMedida as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                                <td><?php echo $data->$id ?></td>
                                <td><?php echo $data->$nombre ?></td>
                                <td><?php echo $data->$sigla ?></td>
                                <td><?php echo $data->$observacion ?></td>

                                <td>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'view', array(unidadMedidaTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'edit', array(unidadMedidaTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'delete', array(unidadMedidaTableClass::ID => $data->$id)) ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-right">
                                Página <select id="slcPage">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select> de 2
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    <?php endif ?>
</div>