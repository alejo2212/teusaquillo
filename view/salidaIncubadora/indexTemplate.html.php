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
    <h3> Salida Incubadora </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
  </div>
  <?php if (count($objSalida) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>N° de Pedido</th>
              <th>Cantidad de Huevos</th>
              <th>Fecha de Realizacion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = salidaincubadoraTableClass::ID ?>
            <?php $empleado = salidaincubadoraTableClass::EMPLEADO_ID ?>
            <?php $cantidad = salidaincubadoraTableClass::CANTIDAD ?>
            <?php $fecha = salidaincubadoraTableClass::FECHA ?>
            <?php $fecha_lle = salidaincubadoraTableClass::FECHA_LLEGADA ?>
            <?php $fecha_sa = salidaincubadoraTableClass::FECHA_SALIDAD ?>
            <?php $npedido = salidaincubadoraTableClass::NO_PEDIDO ?>
            
            <?php foreach ($objSalida as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$npedido ?></td>
<!--                <td><?php // echo incubadoraTableClass::getIncubadoraById($data->$incubadora) ?></td>-->
                <td><?php echo $data->$cantidad ?></td>
                <td><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha))) ?></td>
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'view', array(salidaincubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'edit', array(salidaincubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fa fa-th"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('salidaIncubadora/filters', array('countPages' => $countPages, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('salidaIncubadora/deleteModal') ?>