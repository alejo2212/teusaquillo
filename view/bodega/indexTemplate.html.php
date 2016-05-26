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
        <h3>NUEVA ENTRADA DE BODEGA</h3>
    </div>
    <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->

    <div id="toolBarGeneral" role="toolbar"><!-- subimos los botones listo-->
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
        <a  data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw "></i> Resetear</a>
    </div>


    <?php if (count($objbodega) === 0): ?>
        <h1>No existen datos</h1>
    <?php else: ?>

        <form action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'deleteAll') ?>" method="post" id="gridMain">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="chkAll"></th>

                            <th>Numero de Lote</th>
                            <th>Tipo de Bodega</th>
                            <th>Insumo</th>
                            
                            <th>Fecha Vencimiento</th>
                            <th>Cantidad Entrante</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = bodegaTableClass::ID ?>
                        <?php $lote = bodegaTableClass::LOTE_ID ?>
                        <?php $clasibode = bodegaTableClass::BODEGA_CLASIFICACION_ID ?>
                        <?php $insu = bodegaTableClass::INSUMO_ID ?>
                        
                        <?php $fechaven = bodegaTableClass::FECHA_VENCIMIENTO ?>
                        <?php $cantida = bodegaTableClass::CANTIDAD ?>
                        <?php $actived = bodegaTableClass::ACTIVO ?>

                        <?php foreach ($objbodega as $data): ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>


                                <td><?php echo loteTableClass::getNombreById($data->$lote) ?></td>
                                <td><?php echo bodegaClasificacionTableClass::getNombreById($data->$clasibode) ?></td>
                                <td><?php echo insumoTableClass::getNombreById($data->$insu) ?></td>
                              
                                <td><?php echo ($data->$fechaven) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechaven))) : 'No Registrada' ?></td>
                                <td><?php echo $data->$cantida ?></td>
                                <td class="text-center"><i class="fa fa-<?php echo ($data->$actived) ? 'check clrVerde' : 'times clrRojo' ?>"></i></td>

                                <td class="acciones">
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'view', array(bodegaTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'edit', array(bodegaTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-right">
                                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index') ?>"><!-- cortamos y cambiamos la direccion donde quiere que nos llegue paginacion-->
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
<?php mvc\view\viewClass::includePartial('bodega/filters', array('countPages' => $countPages,'objlote' => $objlote, 'objclasibodega' => $objclasibodega, 'objinsu' => $objinsu)) ?>
<?php mvc\view\viewClass::includePartial('bodega/deleteModal') ?>
