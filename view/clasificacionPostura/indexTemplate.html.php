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
    <h3> Clasificacion de Postura </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
  </div>
  <?php if (count($objclasificacionPostura) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>

              <th>Nombre</th>
              <th>Descripcion</th>
              <!--<th>Clasificacion</th>-->
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = clasificacionPosturaTableClass::ID ?>
            <?php $nombre = clasificacionPosturaTableClass::NOMBRE ?>
            <?php $descripcion = clasificacionPosturaTableClass::DESCRIPCION ?>
            <?php $observacion = clasificacionPosturaTableClass::OBSERVACION ?>
            <?php // $clasiId = clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID ?>

            <?php foreach ($objclasificacionPostura as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                <td><?php echo $data->$nombre ?></td>
                <td><?php echo $data->$descripcion ?></td>
                <!--<td><?ph  echo clasificacionPosturaTableClass::getClasificacionById($data->$clasiId)  ?></td>-->
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'view', array(clasificacionPosturaTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'edit', array(clasificacionPosturaTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('clasificacionPostura/filters', array('countPages' => $countPages)) ?>
<?php mvc\view\viewClass::includePartial('clasificacionPostura/deleteModal') ?>
