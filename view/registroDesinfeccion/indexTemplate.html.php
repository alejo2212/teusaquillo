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
    <h3>REGISTRO DESINFECCION</h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
    <div class="btn-group">
      <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
      <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'informe') ?>" target=_blank ><i class="fa fa-file-text-o fa-fw"></i> Completo</a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
      </ul>
    </div>
  </div>
  <?php if (count($objregistroDesinfeccion) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Fecha De Realizacion</th>
              <!--<th>Fecha De Finalizacion</th>-->
              <th>Desinf. Bodega</th>
              <th>Desinf. Ambiente</th>
              <th>Desinf. Pediluvio</th>
              <th>Responsable</th>
              <th>Tipo De Desinfeccion</th>
              <th>Acciones</th>

            </tr>
          </thead>
          <tbody>
            <?php $id = registroDesinfeccionTableClass::ID ?>
            <?php $fechare = registroDesinfeccionTableClass::FECHA_REALIZACION ?>
            <?php $fechater = registroDesinfeccionTableClass::FECHA_TERMINADO ?>
            <?php $respon = registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE ?>
            <?php $tipdesin = registroDesinfeccionTableClass::TIPO_DESINFECCION_ID ?>
            <?php $desBodega = registroDesinfeccionTableClass::DES_BODEGA ?>
            <?php $desPediluvios = registroDesinfeccionTableClass::DES_PEDILUVIOS ?>
            <?php $desRamadas = registroDesinfeccionTableClass::DES_RAMDAS ?>
            <?php $cantPediluvios = registroDesinfeccionTableClass::CANT_PEDILUVIOS ?>

            <?php foreach ($objregistroDesinfeccion as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                <td><?php echo ($data->$fechare) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechare))) : 'No Registrada' ?></td>
                <!--<td><?php // echo ($data->$fechater) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fechater))) : 'No Registrada' ?></td>-->
                <td><?php echo ($data->$desBodega) ? 'Si': 'No' ?></td>
                <td><?php echo $data->$desRamadas ?></td>
                <td><?php echo ($data->$desPediluvios) ? 'Si - '.$data->$cantPediluvios: 'No' ?></td>
                <td><?php echo empleadoTableClass::getEmpleadoById($data->$respon) ?></td>
                <td><?php echo tipoDesinfeccionTableClass::getNombreById($data->$tipdesin) ?></td>


                <td class="acciones">
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'view', array(registroDesinfeccionTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'edit', array(registroDesinfeccionTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="9" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('registroDesinfeccion/filters', array('countPages' => $countPages, 'objtipoDesinfeccion' => $objtipoDesinfeccion, 'objEmpleado' => $objEmpleado, 'objEmpleadoVeri' => $objEmpleadoVeri)) ?>
<?php mvc\view\viewClass::includePartial('registroDesinfeccion/informe', array('countPages' => $countPages, 'objtipoDesinfeccion' => $objtipoDesinfeccion, 'objEmpleado' => $objEmpleado, 'objEmpleadoVeri' => $objEmpleadoVeri)) ?>
<?php mvc\view\viewClass::includePartial('registroDesinfeccion/deleteModal') ?>