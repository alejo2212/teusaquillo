<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\config\configClass as config ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> Empleados </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
      <a  href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
    <div class="btn-group">
      <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
      <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'informe') ?>" target=_blank ><i class="fa fa-file-text-o fa-fw"></i> Completo</a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
      </ul>
    </div>
  </div>
  <?php if (count($objEmpleado) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Cargo</th>
              <th>Foto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = empleadoTableClass::ID ?>
            <?php $nombre = empleadoTableClass::NOMBRE ?>
            <?php $apellido = empleadoTableClass::APELLIDO ?>
            <?php $direc = empleadoTableClass::DIRECCION ?>
            <?php $tel = empleadoTableClass::TELEFONO ?>
            <?php $foto = empleadoTableClass::FOTO ?>
            <?php $cargo = empleadoTableClass::CARGO ?>

            <?php foreach ($objEmpleado as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$nombre ?></td>
                <td><?php echo $data->$apellido ?></td>
                <td><?php echo $data->$direc ?></td>
                <td><?php echo $data->$tel ?></td>
                <td><?php echo cargoTableClass::getCargoById($data->$cargo) ?></td>
                <td><img class="img-responsive img-thumbnail" style="width: 70px; height: 70px" src="<?php echo config::getUrlBase() . 'upload/' . $data->$foto ?>"></td>
                <td class="acciones">
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'view', array(empleadoTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'edit', array(empleadoTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="8" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('empleado/filters', array('countPages' => $countPages, 'objTipoid' => $objTipoid, 'objCargo' => $objCargo)) ?>
<?php mvc\view\viewClass::includePartial('empleado/informe', array('objTipoid' => $objTipoid, 'objCargo' => $objCargo)) ?>
<?php mvc\view\viewClass::includePartial('empleado/deleteModal') ?>