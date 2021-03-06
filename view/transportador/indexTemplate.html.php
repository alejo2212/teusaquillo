<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>

<div class="container container-fluid">
  <div class="page-header">
    <h3>TRANSPORTADOR</h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->

  <div id="toolBarGeneral" role="toolbar"><!-- subimos los botones listo-->
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i><?php echo i18nClass::__('nuevo') ?></a>
    <a  data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i><?php echo i18nClass::__('eliminar') ?></a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> <?php echo i18nClass::__('filtros') ?></a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw "></i><?php echo i18nClass::__('resetear') ?></a>
  </div>


  <?php if (count($objtransportador) === 0): ?>
    <h1><?php echo i18nClass::__('noExistenDatos') ?></h1>
  <?php else: ?>

    <form action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'deleteAll') ?>" method="post" id="gridMain">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>

              <th><?php echo i18nClass::__('nombre') ?> </th>
              <th>Placa del Vehiculo </th>
              <th><?php echo i18nClass::__('observaciones') ?></th>
              <th><?php echo i18nClass::__('acciones') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $id = transportadorTableClass::ID ?>
            <?php $nombre = transportadorTableClass::NOMBRE ?>
            <?php $placa = transportadorTableClass::PLACA_VAHICULO ?>
            <?php $observacion = transportadorTableClass::OBSERVACION ?>

            <?php foreach ($objtransportador as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                <td><?php echo $data->$nombre ?></td> 
                <td><?php echo ($data->$placa) ? $data->$placa : 'Ninguna' ?></td> 
                <td><?php echo ($data->$observacion) ? $data->$observacion : 'Ninguna' ?></td>

                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'view', array(transportadorTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'edit', array(transportadorTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index') ?>"><!-- cortamos y cambiamos la direccion donde quiere que nos llegue paginacion-->
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
<?php mvc\view\viewClass::includePartial('transportador/filters', array('countPages' => $countPages)) ?>
<?php mvc\view\viewClass::includePartial('transportador/deleteModal') ?>
