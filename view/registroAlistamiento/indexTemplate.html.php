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
    <h3> Registro Alistamiento </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
    <div class="btn-group">
      <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
      <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'informe') ?>" target=_blank ><i class="fa fa-file-text-o fa-fw"></i> Completo</a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
      </ul>
    </div>
  </div>
  <?php if (count($objregistroAlistamiento) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Empleado</th>
              <th>Lote</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = registroAlistamientoTableClass::ID ?>
            <?php $empleado = registroAlistamientoTableClass::EMPLEADO_ID ?>
            <?php $lote = registroAlistamientoTableClass::LOTE_ID ?>
            <?php $salida = registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
            <?php $fecha_ini = registroAlistamientoTableClass::FECHA_INICIO ?>
            <?php $fecha_fin = registroAlistamientoTableClass::FECHA_FIN ?>
            <?php $fecha_ini_cortina = registroAlistamientoTableClass::FECHA_INICIO_CORTINA ?>
            <?php $fecha_fin_cortina = registroAlistamientoTableClass::FECHA_FIN_CORTINA ?>
            <?php $fecha_ini_cama = registroAlistamientoTableClass::FECHA_ENTRADA_CAMA ?>
            <?php $fecha_fin_cama = registroAlistamientoTableClass::FECHA_TERMINO_CAMA ?>
            <?php $fecha_equipo = registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO ?>

            <?php foreach ($objregistroAlistamiento as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td class="emple"><?php echo empleadoTableClass::getEmpleadoById($data->$empleado) ?></td>
                <td><?php echo loteTableClass::getLote($data->$lote) ?></td>
                <td><?php echo ($data->$fecha_ini) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha_ini))) : 'No Registrada' ?></td>
                <td><?php echo ($data->$fecha_fin) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha_fin))) : 'No Registrada' ?></td>
                
                <td class="acciones">
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'view', array(empleadoTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'edit', array(empleadoTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('registroAlistamiento/filters', array('countPages' => $countPages, 'objlote' => $objlote, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('registroAlistamiento/informe', array('objlote' => $objlote, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('registroAlistamiento/deleteModal') ?>