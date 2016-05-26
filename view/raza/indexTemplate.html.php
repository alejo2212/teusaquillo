<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<?php use mvc\config\configClass as config ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>
<div class="container container-fluid">
    <div class="page-header">
        <h3> RAZA </h3>
    </div>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
    <div id="toolBarGeneral" role="toolbar">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> <?php echo i18nClass::__('nuevo') ?></a>
        <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i><?php echo i18nClass::__('resetear') ?></a>
    </div>
    <?php if (count($objRaza) === 0): ?>
        <h1><?php echo i18nClass::__('noExistenDatos') ?></h1>
    <?php else: ?>

        <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'deleteAll') ?>" method="post">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>
                           
                            <th><?php echo i18nClass::__('nombre') ?></th>
                            <th><?php echo i18nClass::__('descripcion') ?></th>
                            <th><?php echo i18nClass::__('foto') ?></th>
                            <th><?php echo i18nClass::__('acciones') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = razaTableClass::ID ?>
                        <?php $nombre = razaTableClass::NOMBRE ?>
                        <?php $des = razaTableClass::DESCRIPCION ?>
                        <?php $foto = razaTableClass::FOTO ?>
                        <?php $deleted = razaTableClass::DELETED_AT ?>

                        <?php foreach ($objRaza as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                                <td><?php echo $data->$nombre ?></td>
                                <td><?php echo $data->$des ?></td>
                                <td><img class="img-responsive img-thumbnail" style="width: 50px" src="<?php echo config::getUrlBase() . 'upload/' . $data->$foto ?>"></td>
                                <td>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'view', array(razaTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'edit', array(razaTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('raza/filters', array('countPages' => $countPages)) ?>
<?php mvc\view\viewClass::includePartial('raza/deleteModal') ?>