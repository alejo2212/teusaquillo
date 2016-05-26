<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> Detalle de Requisicion </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'new', array('idRequisicion' => $idRequisicion)) ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'index') ?>" class="btn btn-default btn-xs"><i class="fa fa-table fa-fw"></i> Volver</a>
  </div>
  <?php if (count($objDetalleRequi) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'deleteAll', array('id' => $idRequisicion)) ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Numero de Requisicion</th>
              <th>Insumo</th>
              <th>Cantidad Solicitada</th>
              <th>Fecha de Necesidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = requisiciondetalleTableClass::ID ?>
            <?php $requisicion = requisiciondetalleTableClass::REQUISICION_ID ?>
            <?php $bodega = requisiciondetalleTableClass::BODEGA_ID ?>
            <?php $cantidad = requisiciondetalleTableClass::CANTIDAD ?>
            <?php $fecha = requisiciondetalleTableClass::FECHA_NECESIDAD ?>

            <?php foreach ($objDetalleRequi as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$requisicion ?></td>
                <td><?php echo insumoTableClass::getNombreById($data->$bodega) ?></td>
                <td><?php echo $data->$cantidad ?></td>
                <td><?php echo date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fecha)) ?></td>
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'view', array(requisiciondetalleTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'edit', array(requisiciondetalleTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'detail',array('id' => $idRequisicion)) ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('detalleRequisicion', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('detalleRequisicion/filters', array('countPages' => $countPages)) ?>
<?php mvc\view\viewClass::includePartial('detalleRequisicion/deleteModal') ?>