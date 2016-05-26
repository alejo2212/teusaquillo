<?php

use mvc\translator\translatorClass AS translator ?>
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
    <h3> Postura </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
    <div class="btn-group">
      <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
      <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
      </ul>
    </div>
  </div>
  <?php if (count($objPostura) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Lote</th>
              <th>Ramada</th>
              <th>Fecha de Realizacion</th>
              <th>Postura</th>
              <th>Incubacion</th>
              <th>Consumo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $idLote = loteTableClass::ID ?>
            <?php $idAmbi = ambienteBaseTableClass::ID ?>
            <?php $id = posturaTableClass::ID ?>
            <?php $lote = posturaTableClass::LOTE_ID ?>
            <?php $ambi = posturaTableClass::AMBIENTE_ID ?>
            <?php $fecha = posturaTableClass::FECHA ?>
            <?php foreach ($objPostura as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                <td><?php echo loteTableClass::getLote($data->$lote) ?></td>
                <td><?php echo ambienteTableClass::getNombreById($data->$ambi) ?></td>
                <td><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha))) ?></td>
                <?php for ($i = 1; $i < 4; $i++) { ?>
                  <td><?php echo (posturaDetalleTableClass::getPosturaIncuConsumoById($data->$id, $i)) ? posturaDetalleTableClass::getPosturaIncuConsumoById($data->$id, $i) : 0 ?></td>
                <?php } ?>
                <td class="acciones">
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'view', array(posturaTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'edit', array(posturaTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'detail', array(posturaTableClass::ID => $data->$id)) ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fa fa-th"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="8" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('postura/filters', array('countPages' => $countPages, 'objambiente' => $objambiente, 'objlote' => $objlote)) ?>
<?php mvc\view\viewClass::includePartial('postura/informe', array('objambiente' => $objambiente, 'objlote' => $objlote)) ?>
<?php mvc\view\viewClass::includePartial('postura/deleteModal') ?>