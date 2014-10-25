<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php if (count($objSesion) === 0): ?>
    <h1>No Hay Datos</h1>
  <?php else: ?>
    <div id="toolBarGeneral" role="toolbar">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'deleted') ?>" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
      <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-filter fa-fw"></i> Filtros</a>
      <a href="#" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
    </div>
    <form action="" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"/></th>
              <th>Id</th>
              <th>Usuario</th>
              <th>Fecha de creacion</th>
              <th>Cookies</th>
              <th>Direccion Ip</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = sesionTableClass::ID ?>
            <?php $user = sesionTableClass::USUARIO_ID ?>
            <?php $created = sesionTableClass::CREATED_AT ?>
            <?php $cookie = sesionTableClass::HASH_COOKIE ?>
            <?php $ip = sesionTableClass::IP_ADDRESS ?>
            
            <?php foreach ($objSesion as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk"/></td>
                <td><?php echo $data->$id; ?></td>
                <td><?php echo $data->$user; ?></td>
                <td><?php echo $data->$cookie; ?></td>
                <td><?php echo $data->$ip; ?></td>
                <td><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$created)); ?></td>
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'view', array(sesionTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'edit', array(sesionTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('sesion', 'deleted', array(sesionTableClass::ID => $data->$id)) ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7" class="text-right">
                Página <select id="slcPage">
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select> de 500
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  <?php endif ?>
</div>