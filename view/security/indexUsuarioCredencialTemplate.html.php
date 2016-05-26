<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> Usuarios </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'delete') ?>" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>" class="btn btn-default btn-xs"><i class="fa fa-table fa-fw"></i> Volver</a>
    <!--<a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="#" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>-->
  </div>
  <?php if (count($objUsuarioCredenciales) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form action="" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Nombre credencial</th>
              <th>Fecha de asignación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = usuarioCredencialTableClass::ID ?>
            <?php $credencial_id = usuarioCredencialTableClass::CREDENCIAL_ID ?>
            <?php $created_at = usuarioCredencialTableClass::CREATED_AT ?>
            <?php foreach ($objUsuarioCredenciales as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$credencial_id ?></td>
                <td><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$created_at)) ?></td>
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'view', array(usuarioTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'edit', array(usuarioTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('security/filters', array('countPages' => $countPages)) ?>