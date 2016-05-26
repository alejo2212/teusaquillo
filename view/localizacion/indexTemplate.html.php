<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> Localizaciones </h3>
  </div>
<?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i> Filtros</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> Resetear</a>
  </div>
  <?php if (count($objLocalidad) === 0): ?>
    <h1>No existen datos</h1>
<?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>

              <th><?php echo i18nClass::__('ciudad') ?></th>
              <th>Departamento</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = localidadTableClass::ID ?>
            <?php $ciu = localidadTableClass::NOMBRE ?>
            <?php $depto = localidadTableClass::LOCALIDAD_ID ?>

  <?php foreach ($objLocalidad as $data): ?>
    <?php if ($data->$depto != null): ?>
                <tr>
                  <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>

                  <td><?php echo $data->$ciu ?></td>
                  <td><?php echo localidadTableClass::getLocalidadById($data->$depto) ?></td>
                  <td>
                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'view', array(localidadTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'edit', array(localidadTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                    <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
    <?php endif; ?>
  <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('localizacion/filters', array('countPages' => $countPages, 'objDeptos' => $objDeptos)) ?>
<?php mvc\view\viewClass::includePartial('localizacion/deleteModal') ?>
