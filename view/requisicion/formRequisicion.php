<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $RequisicionForm = session::getInstance()->getFlash('Requisicion') ?>
<?php $id = requisicionTableClass::ID ?>
<?php $empleado = requisicionTableClass::EMPLEADO_ID ?>
<?php $fecha = requisicionTableClass::FECHA_REALIZACION ?>
<?php $anulado = requisicionTableClass::ANULADO ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nomEmp = empleadoTableClass::NOMBRE ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true) ?>" class="col-sm-2 control-label">Empleado</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true) ?>" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objEmpleado as $data): ?>
          <option <?php echo (((isset($edit) and $edit) and ($objRequisicion->$empleado == $data->$idEmp)) ? 'selected ' : ((isset($RequisicionForm[$empleado]) and ($RequisicionForm[$empleado] == $data->$idEmp)) ? 'selected ' : '')) ?> value="<?php echo $data->$idEmp ?>"><?php echo $data->$nomEmp ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>" class="col-sm-2 control-label">Fecha de Realizacion</label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objRequisicion->$fecha) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objRequisicion->$fecha)) : '' : ((isset($RequisicionForm[$fecha])) ? $RequisicionForm[$fecha] : '') ?>">
    </div>
  </div>
  <?php if (isset($edit) and $edit): ?>
    <div class="form-group">
      <label for="<?php echo requisicionTableClass::getNameField(requisicionTableClass::ANULADO, true) ?>" class="col-sm-2 control-label">Anulado</label>
      <div class="col-sm-10 checkboxFlow">
        <input type="checkbox" class="form-control" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::ANULADO, true) ?>" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::ANULADO, true) ?>" value="t" <?php echo ($objRequisicion->$anulado) ? 'checked' : '' ?>>
      </div>
    </div>
  <?php endif ?>
  <input type="hidden" id="<?php echo requisicionTableClass::getNameField(requisicionTableClass::ID, true) ?>" name="<?php echo requisicionTableClass::getNameField(requisicionTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objRequisicion->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
