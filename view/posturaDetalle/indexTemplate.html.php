<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> Detalle de Postura </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'new', array('idPostura' => $idPostura)) ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index') ?>" class="btn btn-default btn-xs"><i class="fa fa-table fa-fw"></i> Volver</a>
  </div>
  <?php // print_r($objDetallePostu) ?>
  <?php if (count($objDetallePostu) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'deleteAll', array('id' => $idPostura)) ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Numero de Postura</th>
              <th>Clasificacion</th>
              <th>Cantidad Recolectada</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = posturaDetalleTableClass::ID ?>
            <?php $idPostu = posturaDetalleTableClass::POSTURA_ID ?>
            <?php $idClasi = posturaDetalleTableClass::CLASIFICACION_POSTURA_ID ?>
            <?php $idEmple = posturaDetalleTableClass::EMPLEADO_ID ?>
            <?php $cantidad = posturaDetalleTableClass::CANTIDAD ?>
            <?php $venta = posturaDetalleTableClass::INGRESO_VENTA ?>
            <?php $idEm = empleadoTableClass::ID ?>
            <?php $nomEm = empleadoTableClass::NOMBRE ?>
            <?php $idClas = clasificacionPosturaTableClass::ID ?>
            <?php $nomClas = clasificacionPosturaTableClass::NOMBRE ?>

            <?php foreach ($objDetallePostu as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$idPostu ?></td>
                <td><?php echo clasificacionPosturaTableClass::getClasificacionById($data->$idClasi) ?></td>
                <td><?php echo $data->$cantidad ?></td>
                <!--<td><?ph echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha)) ?></td>-->
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'view', array(posturaDetalleTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'edit', array(posturaDetalleTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'detail', array('id' => $idPostura)) ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('posturaDetalle/deleteModal') ?>