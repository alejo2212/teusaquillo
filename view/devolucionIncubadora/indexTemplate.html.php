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
    <h3> Devolucion de Incubadora </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
  </div>
  <?php if (count($objdevolucion) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Empleado</th>
              <th>Cant. Llegada</th>
              <th>Cant. Faltante</th>
              <th>Fecha de Devolucion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = devolucionIncubadoraTableClass::ID ?>
            <?php $salidain = devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID ?>
            <?php $llegada = devolucionIncubadoraTableClass::CANTIDAD_LLEGADA ?>
            <?php $faltante = devolucionIncubadoraTableClass::CANTIDAD_FALTANTE ?>
            <?php $devolucion = devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION ?>
            <?php $fecha = devolucionIncubadoraTableClass::FECHA ?>
            <?php $empleado = devolucionIncubadoraTableClass::EMPLEADO ?>

            <?php foreach ($objdevolucion as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo empleadoTableClass::getEmpleadoById($data->$empleado) ?></td>
                <td><?php echo $data->$llegada ?></td>
                <td><?php echo $data->$faltante ?></td>
                <td><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha))) ?></td>
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'view', array(devolucionIncubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'edit', array(devolucionIncubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                  
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('devolucionIncubadora/filters', array('countPages' => $countPages, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('devolucionIncubadora/deleteModal') ?>