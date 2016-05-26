<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\i18n\i18nClass ?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> DETALLE SALIDA INSUMO </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
  <div id="toolBarGeneral" role="toolbar"> 
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'new', array('id' => $id)) ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> <?php echo i18nClass::__('nuevo') ?></a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'index') ?>" class="btn btn-default btn-xs"><i class="fa fa-table fa-fw"></i> Volver</a>
<!--        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i><?php echo i18nClass::__('filtrar') ?> </a>
    <a href="#" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i><?php echo i18nClass::__('resetear') ?></a>-->

  </div>
  <?php if (count($objSalidainsumoDetalle) === 0): ?>
    <h1><?php echo i18nClass::__('noExistenDatos') ?>  </h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'deleteAll', array('id' => $id)) ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th># Salida Insumo</th>
              <th>Bodega</th>
              <th>Insumo</th>
              <th><?php echo i18nClass::__('cantidad') ?></th>
              <th><?php echo i18nClass::__('anulado') ?></th>
              <th><?php echo i18nClass::__('acciones') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $ids = salidaInsumoDetalleTableClass::ID ?>
            <?php $salidaIn = salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID ?>
            <?php $bodegaId = salidaInsumoDetalleTableClass::BODEGA_ID ?>
            <?php $cantidad = salidaInsumoDetalleTableClass::CANTIDAD ?>
            <?php $observacion = salidaInsumoDetalleTableClass::OBSERVACION ?>
            <?php $anulado = salidaInsumoDetalleTableClass::ANULADO ?>
            <?php $insumo = salidaInsumoDetalleTableClass::INSUMO_ID ?>


            <?php foreach ($objSalidainsumoDetalle as $data): ?>

              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$ids ?>" name="chk[]" value="<?php echo $data->$ids ?>"></td>
                <td><?php echo $data->$salidaIn ?></td>
                <td><?php echo bodegaTableClass::getNombreBodegaById($data->$bodegaId) ?></td>
                <td><?php echo insumoTableClass::getNombreById($data->$insumo) ?></td>
                <td><?php echo $data->$cantidad ?></td>
                <td class="text-center"><i class="fa fa-<?php echo ($data->$anulado) ? '' : 'check clrRojo' ?>"></i></td>

                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'view', array(salidaInsumoDetalleTableClass::ID => $data->$ids)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'edit', array(salidaInsumoDetalleTableClass::ID => $data->$ids)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$ids ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'detail', array('id' => $id)) ?>', 'modal<?php echo $data->$ids ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>

            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('salidaInsumoDetalle/filters', array('countPages' => $countPages)) ?>
<?php mvc\view\viewClass::includePartial('salidaInsumoDetalle/deleteModal') ?>