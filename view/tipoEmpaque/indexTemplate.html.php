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
    <h3> Tipo de Empaque </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
  <?php if (count($objtipoEmpaque) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = tipoEmpaqueTableClass::ID ?>
            <?php $nombre = tipoEmpaqueTableClass::NOMBRE ?>
            <?php $descripcion = tipoEmpaqueTableClass::DESCRIPCION ?>
            <?php $cantidad = tipoEmpaqueTableClass::CANTIDAD ?>

            <?php foreach ($objtipoEmpaque as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                <td><?php echo $data->$nombre ?></td>
                <td><?php echo $data->$cantidad ?></td>
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'view', array(tipoEmpaqueTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'edit', array(tipoEmpaqueTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('tipoEmpaque/deleteModal') ?>
<?php mvc\view\viewClass::includePartial('tipoEmpaque/filters', array('countPages' => $countPages)) ?>
