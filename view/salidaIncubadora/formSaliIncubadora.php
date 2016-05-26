<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $salidaForm = session::getInstance()->getFlash('salida') ?>
<?php $id = salidaincubadoraTableClass::ID ?>
<?php $idAnual = salidaincubadoraTableClass::ID_ANUAL ?>
<?php $empleado = salidaincubadoraTableClass::EMPLEADO_ID ?>
<?php $cantidad = salidaincubadoraTableClass::CANTIDAD ?>
<?php $fecha = salidaincubadoraTableClass::FECHA ?>
<?php $fecha_lle = salidaincubadoraTableClass::FECHA_LLEGADA ?>
<?php $fecha_sa = salidaincubadoraTableClass::FECHA_SALIDAD ?>
<?php $npedido = salidaincubadoraTableClass::NO_PEDIDO ?>
<?php $observacion = salidaincubadoraTableClass::OBSERVACION ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nomEmp = empleadoTableClass::NOMBRE ?>
<?php $idInc = incubadoraTableClass::ID ?>
<?php $nomInc = incubadoraTableClass::NOMBRE ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL, true) ?>" class="col-sm-10 control-label">N° Anual:</label>
    <div class="col-sm-2">
      <input type="text" maxlength="3" readonly="readonly" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objSalida->$idAnual : ((isset($salidaForm[$idAnual])) ? $salidaForm[$idAnual] : $idanual->idanual) ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true) ?>" class="col-sm-3 control-label">N° de Pedido</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objSalida->$npedido : ((isset($salidaForm[$npedido])) ? $salidaForm[$npedido] : $Npedido) ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true) ?>" class="col-sm-3 control-label">Empleado</label>
    <div class="col-sm-9">
      <select class="form-control" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true) ?>" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objEmpleado as $data): ?>
          <option <?php echo (((isset($edit) and $edit) and ( $objSalida->$empleado == $data->$idEmp)) ? 'selected ' : ((isset($salidaForm[$empleado]) and ( $salidaForm[$empleado] == $data->$idEmp)) ? 'selected ' : '')) ?> value="<?php echo $data->$idEmp ?>"><?php echo $data->$nomEmp ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <!--  <div class="form-group">
      <label for="<?ph echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>" class="col-sm-3 control-label">Fecha de Realizacion</label>
      <div class="col-sm-9">
        <input type="datetime-local" class="form-control" id="<?ph echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>" name="<?ph echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) ?>" value="<?ph echo (isset($edit) and $edit) ? $objSalida->$fecha : ((isset($salidaForm[$fecha])) ? $salidaForm[$fecha] : '') ?>">
      </div>
    </div>-->

  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true) ?>" class="col-sm-3 control-label">Cantidad Total Huevos</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objSalida->$cantidad : ((isset($salidaForm[$cantidad])) ? $salidaForm[$cantidad] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::OBSERVACION, true) ?>" class="col-sm-3 control-label">Observacion</label>
    <div class="col-sm-9">
      <textarea class="form-control" rows="3" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::OBSERVACION, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objSalida->$observacion : ((isset($salidaForm[$observacion])) ? $salidaForm[$observacion] : '') ?></textarea>
    </div>
  </div>
  <div class="page-header"></div>
  <div class="form-group">
    <label class="col-sm-12 control-label">Trasportador</label>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>" class="col-sm-3 control-label">Fecha de Llegada</label>
    <div class="col-sm-9">
      <input type="datetime-local" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objSalida->$fecha_lle) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objSalida->$fecha_lle)) : '' : ((isset($salidaForm[$fecha_lle])) ? $salidaForm[$fecha_lle] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>" class="col-sm-3 control-label">Fecha de Salida</label>
    <div class="col-sm-9">
      <input type="datetime-local" class="form-control" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objSalida->$fecha_sa) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objSalida->$fecha_sa)) : '' : ((isset($salidaForm[$fecha_sa])) ? $salidaForm[$fecha_sa] : '') ?>">
    </div>
  </div>


  <input type="hidden" id="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID, true) ?>" name="<?php echo salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objSalida->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
