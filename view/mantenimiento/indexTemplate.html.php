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
    <h3> Mantenimiento </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
  </div>
  <?php if (count($objMante) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Maquina</th>
              <th>Tipo de Mantenimiento</th>
              <th>Fecha de Realizacion</th>
              <th>Fecha de Finalizacion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = mantenimientoTableClass::ID ?>
            <?php $maquina = mantenimientoTableClass::MAQUINA_ID ?>
            <?php $empleado = mantenimientoTableClass::EMPLEADO_ID ?>
            <?php $tipoMante = mantenimientoTableClass::TIPO_MANTENIMIENTO_ID ?>
            <?php $fechaini = mantenimientoTableClass::FECHA_INICIO ?>
            <?php $fechafin = mantenimientoTableClass::FECHA_FIN ?>
            <?php $causa = mantenimientoTableClass::CAUSA ?>
            <?php $arreglo = mantenimientoTableClass::ARREGLO ?>
            <?php $observacion = mantenimientoTableClass::OBSERVACION ?>

            <?php foreach ($objMante as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo maquinaTableClass::getMaquinaById($data->$maquina) ?></td>
                <td><?php echo tipoMantenimientoTableClass::getTipoManteById($data->$tipoMante) ?></td>
                <td><?php echo ($data->$fechaini) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechaini))) : 'No Registrada' ?></td>
                <td><?php echo ($data->$fechafin) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechafin))) : 'No Registrada' ?></td>
                <td class="acciones">
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'view', array(mantenimientoTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'edit', array(mantenimientoTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'detail', array(mantenimientoTableClass::ID => $data->$id)) ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fa fa-th"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('mantenimiento/filters', array('countPages' => $countPages,'objTipoMante' => $objTipoMante, 'objMaquina' => $objMaquina, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('mantenimiento/deleteModal') ?>