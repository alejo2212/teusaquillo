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
        <h3> RAZON SALIDA </h3>
    </div>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
    <div id="toolBarGeneral" role="toolbar">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i><?php echo i18nClass::__('nuevo') ?></a>
        <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i><?php echo i18nClass::__('filtrar') ?> </a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> <?php echo i18nClass::__('resetear') ?></a>
    </div>

    <?php if (count($objRazonSalida) === 0): ?>
        <h1><?php echo i18nClass::__('noExistenDatos') ?></h1>
    <?php else: ?>

        <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'deleteAll') ?>" method="post">

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>

                            <th><?php echo i18nClass::__('razon') ?></th>
    <!--                            <th><?php echo i18nClass::__('observacion') ?></th>-->
                            <th><?php echo i18nClass::__('acciones') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = razonSalidaTableClass::ID ?>
                        <?php $razon = razonSalidaTableClass::RAZON ?>
                        <?php $observacion = razonSalidaTableClass::OBSERVACION ?>


                        <?php foreach ($objRazonSalida as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                                <td><?php echo $data->$razon ?></td>
        <!--                    <td><?php echo $data->$observacion ?></td>
                                -->
                                <td>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'view', array(razonSalidaTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'edit', array(razonSalidaTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('razonSalida/deleteModal') ?>
<?php mvc\view\viewClass::includePartial('razonSalida/filters', array('countPages' => $countPages)) ?>
