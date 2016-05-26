<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> Detalle Salida Incubadora </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?>
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'new', array('idSalida' => $idSalida)) ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i> Nuevo</a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>" class="btn btn-default btn-xs"><i class="fa fa-table fa-fw"></i> Volver</a>
  </div>

  <?php if (count($objDetalleSalida) === 0): ?>
    <h1>No existen datos</h1>
  <?php else: ?>
    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'deleteAll', array('id' => $idSalida)) ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th>Numero de Salida</th>
              <th>Incubadora</th>
              <th>Cantidad Enviada</th>
              <th>Tipo de Empaque</th>
              <th>Cantidad de Empaque</th>                            
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $id = salidaDetalleIncubadoraTableClass::ID ?>
            <?php $salida = salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID ?>
            <?php $incubadora = salidaDetalleIncubadoraTableClass::INCUBADORA_ID ?>
            <?php $empaque = salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID ?>
            <?php $cantidad = salidaDetalleIncubadoraTableClass::CANTIDAD ?>
            <?php $descripcion = salidaDetalleIncubadoraTableClass::DESCRIPCION ?>
            <?php $canti_emp = salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE ?>

            <?php foreach ($objDetalleSalida as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$salida ?></td>
                <td><?php echo incubadoraTableClass::getIncubadoraById($data->$incubadora) ?></td>
                <td><?php echo $data->$cantidad ?></td>
                <td><?php echo tipoEmpaqueTableClass::getTipoEmpaqueById($data->$empaque) ?></td> 
                <td><?php echo $data->$canti_emp ?></td>                              
                <td>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'view', array(salidaDetalleIncubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'edit', array(salidaDetalleIncubadoraTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'detail', array('id' => $idSalida)) ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', 'index') ?>">
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
<?php mvc\view\viewClass::includePartial('salidaDetalleIncubadora/deleteModal') ?>