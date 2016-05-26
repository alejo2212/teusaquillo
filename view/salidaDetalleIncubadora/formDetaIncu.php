<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $detalleIncuForm = session::getInstance()->getFlash('detalleIncu') ?>
<?php $id = salidaDetalleIncubadoraTableClass::ID ?>
<?php $salida = salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID ?>
<?php $incubadora = salidaDetalleIncubadoraTableClass::INCUBADORA_ID ?>
<?php $empaque = salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID ?>
<?php $cantidad = salidaDetalleIncubadoraTableClass::CANTIDAD ?>
<?php $descripcion = salidaDetalleIncubadoraTableClass::DESCRIPCION ?>
<?php $canti_emp = salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE ?>
<?php $idInc = incubadoraTableClass::ID ?>
<?php $nomInc = incubadoraTableClass::NOMBRE ?>

<?php $idEmp = tipoEmpaqueTableClass::ID ?>
<?php $nomEmp = tipoEmpaqueTableClass::NOMBRE ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaDetalleIncubadora', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <input type="hidden" class="form-control" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID, true) ?>" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleSalida->$salida : $idSalida ?>">
    <div class="form-group">
    <label for="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::INCUBADORA_ID, true) ?>" class="col-sm-2 control-label">Incubadora</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::INCUBADORA_ID, true) ?>" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::INCUBADORA_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objincubadora as $dataI): ?>
          <option <?php echo (((isset($edit) and $edit) and ( $objDetalleSalida->$incubadora == $dataI->$idInc)) ? 'selected ' : ((isset($detalleIncuForm[$incubadora]) and ( $detalleIncuForm[$incubadora] == $dataI->$idInc)) ? 'selected ' : '')) ?> value="<?php echo $dataI->$idInc ?>"><?php echo $dataI->$nomInc ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID, true) ?>" class="col-sm-2 control-label">Tipo de Empaque</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID, true) ?>" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objEmpaque as $data): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objDetalleSalida->$empaque == $data->$idEmp )) ? 'selected ' : ((isset($detalleIncuForm[$empaque]) and ( $detalleIncuForm[$empaque] == $data->$idEmp)) ? 'selected ' : '')) ?>value="<?php echo $data->$idEmp ?>"><?php echo $data->$nomEmp ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE, true) ?>" class="col-sm-2 control-label">Cantidad de Empaque</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE, true) ?>" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleSalida->$canti_emp : ((isset($detalleIncuForm[$canti_emp])) ? $detalleIncuForm[$canti_emp] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD, true) ?>" class="col-sm-2 control-label">Cantidad de Huevos</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD, true) ?>" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetalleSalida->$cantidad : ((isset($detalleIncuForm[$cantidad])) ? $detalleIncuForm[$cantidad] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DESCRIPCION, true) ?>" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DESCRIPCION, true) ?>"><?php echo (isset($edit) and $edit) ? $objDetalleSalida->$descripcion : ((isset($detalleIncuForm[$descripcion])) ? $detalleIncuForm[$descripcion] : '') ?></textarea>
    </div>
  </div>
  
  <input type="hidden" id="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::ID, true) ?>" name="<?php echo salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objDetalleSalida->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => (isset($edit) and $edit) ? $objDetalleSalida->$salida : $idSalida)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => (isset($edit) and $edit) ? $objDetalleSalida->$salida : $idSalida)) ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
