<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $devolucionForm = session::getInstance()->getFlash('devolucion') ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<?php $id = devolucionIncubadoraTableClass::ID ?>
<?php $salidain = devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID ?>
<?php $llegada = devolucionIncubadoraTableClass::CANTIDAD_LLEGADA ?>
<?php $faltante = devolucionIncubadoraTableClass::CANTIDAD_FALTANTE ?>
<?php $devolucion = devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION ?>
<?php $fecha = devolucionIncubadoraTableClass::FECHA ?>
<?php $empleado = devolucionIncubadoraTableClass::EMPLEADO ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="row">
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true) ?>" class="col-sm-4 control-label">Empleado</label>
        <div class="col-sm-8">
          <select class="form-control" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true) ?>" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true) ?>">
            <option value="">Seleccione</option>
            <?php foreach ($objEmpleado as $data): ?>
              <option <?php echo (((isset($edit) and $edit) and ( $objdevolucion->$empleado == $data->$idEmp)) ? 'selected ' : ((isset($devolucionForm[$empleado]) and ( $devolucionForm[$empleado] == $data->$idEmp)) ? 'selected ' : '')) ?> value="<?php echo $data->$idEmp ?>"><?php echo $data->$nombreEmp ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true) ?>" class="col-sm-4 control-label">Numero de Pedido</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objdevolucion->$salidain : ((isset($devolucionForm[$salidain])) ? $devolucionForm[$salidain] : '') ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true) ?>" class="col-sm-4 control-label">Cantidad Llegada</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objdevolucion->$llegada : ((isset($devolucionForm[$llegada])) ? $devolucionForm[$llegada] : '') ?>" placeholder="Cantidad que Llego">
        </div>
      </div>
    </div>
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>" class="col-sm-4 control-label">Fecha Realizacion</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objdevolucion->$fecha) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objdevolucion->$fecha)) : '' : ((isset($devolucionForm[$fecha])) ? $devolucionForm[$fecha] : '') ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true) ?>" class="col-sm-4 control-label">Devolucion Total</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objdevolucion->$devolucion : ((isset($devolucionForm[$devolucion])) ? $devolucionForm[$devolucion] : '') ?>" placeholder="Cantidad total de la devolucion">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true) ?>" class="col-sm-4 control-label">Cantidad Faltante</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objdevolucion->$faltante : ((isset($devolucionForm[$faltante])) ? $devolucionForm[$faltante] : '') ?>" placeholder="Cantidad que falto">
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::ID, true) ?>" name="<?php echo devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objdevolucion->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
