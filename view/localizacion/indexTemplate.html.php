<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <?php if (count($objLocalidad) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <div id="toolBarGeneral" role="toolbar">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'deleted') ?>" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
      <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-filter fa-fw"></i> Filtros</a>
      <a href="#" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
    </div>
    <form action="" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>id</th>
              <th>Ciudad</th>
              <th>Departamento</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = localidadTableClass::ID ?>
            <?php $depto = localidadTableClass::NOMBRE ?>
            <?php $ciu = localidadTableClass::LOCALIDAD_ID ?>

            <?php foreach ($objLocalidad as $data): ?>
              <?php if ($data->$ciu != null): ?>
                <tr>
                  <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                  <td><?php echo $data->$id ?></td>
                  <td><?php echo $data->$depto ?></td>
                  <td><?php echo $data->$ciu ?></td>
                  <td>
                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'view', array(localidadTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'edit', array(localidadTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'deleted', array(localidadTableClass::ID => $data->$id)) ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach ?>
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