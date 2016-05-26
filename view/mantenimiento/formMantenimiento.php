<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $manteForm = session::getInstance()->getFlash('mantenimiento') ?>
<?php $idMa = maquinaTableClass::ID ?>
<?php $nombreMa = maquinaTableClass::DESCRIPCION ?>
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<?php $idTma = tipoMantenimientoTableClass::ID ?>
<?php $nombreTma = tipoMantenimientoTableClass::NOMBRE ?>
<?php $id = mantenimientoTableClass::ID ?>
<?php $maquina = mantenimientoTableClass::MAQUINA_ID ?>
<?php $empleado = mantenimientoTableClass::EMPLEADO_ID ?>
<?php $tipoMante = mantenimientoTableClass::TIPO_MANTENIMIENTO_ID ?>
<?php $fechaini = mantenimientoTableClass::FECHA_INICIO ?>
<?php $fechafin = mantenimientoTableClass::FECHA_FIN ?>
<?php $causa = mantenimientoTableClass::CAUSA ?>
<?php $arreglo = mantenimientoTableClass::ARREGLO ?>
<?php $observacion = mantenimientoTableClass::OBSERVACION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="row">
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true) ?>" class="col-sm-4 control-label">Mantenimiento</label>
        <div class="col-sm-8">
          <select class="form-control" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true) ?>" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true) ?>">
            <option value="">Seleccione</option>
            <?php foreach ($objTipoMante as $dataTma): ?>
              <option <?php echo (((isset($edit) and $edit) and ( $objMante->$tipoMante == $dataTma->$idTma)) ? 'selected ' : ((isset($manteForm[$tipoMante]) and ( $manteForm[$tipoMante] == $dataTma->$idTma)) ? 'selected ' : '')) ?> value="<?php echo $dataTma->$idTma ?>"><?php echo $dataTma->$nombreTma ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true) ?>" class="col-sm-4 control-label">Maquina o Equipo</label>
        <div class="col-sm-8">
          <select class="form-control" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true) ?>" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true) ?>">
            <option value="">Seleccione</option>
            <?php foreach ($objMaquina as $dataMa): ?>
              <option <?php echo (((isset($edit) and $edit) and ( $objMante->$maquina == $dataMa->$idMa)) ? 'selected ' : ((isset($manteForm[$maquina]) and ( $manteForm[$maquina] == $dataMa->$idMa)) ? 'selected ' : '')) ?> value="<?php echo $dataMa->$idMa ?>"><?php echo $dataMa->$nombreMa ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>" class="col-sm-4 control-label">Fecha Realizacion</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objMante->$fechaini) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objMante->$fechaini)) : '' : ((isset($manteForm[$fechaini])) ? $manteForm[$fechaini] : '') ?>">
        </div>
      </div>
    </div>
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true) ?>" class="col-sm-4 control-label">Empleado Realizador</label>
        <div class="col-sm-8">
          <select class="form-control" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true) ?>" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true) ?>">
            <option value="">Seleccione</option>
            <?php foreach ($objEmpleado as $dataEmp): ?>
              <option <?php echo (((isset($edit) and $edit) and ( $objMante->$empleado == $dataEmp->$idEmp)) ? 'selected ' : ((isset($manteForm[$empleado]) and ( $manteForm[$empleado] == $dataEmp->$idEmp)) ? 'selected ' : '')) ?> value="<?php echo $dataEmp->$idEmp ?>"><?php echo $dataEmp->$nombreEmp ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>" class="col-sm-4 control-label">Fecha Finalizacion</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($objMante->$fechafin) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objMante->$fechafin)) : '' : ((isset($manteForm[$fechafin])) ? $manteForm[$fechafin] : '') ?>">
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::CAUSA, true) ?>" class="col-sm-2 control-label">Causa</label>
    <div class="col-sm-10">
      <textarea class="form-control popover-dismiss" data-toggle="popover" title="Ayuda" data-placement="top" data-content="Descripcion de porque se va a realizar el mantenimiento" rows="3" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::CAUSA, true) ?>" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::CAUSA, true) ?>"><?php echo (isset($edit) and $edit) ? $objMante->$causa : ((isset($manteForm[$causa])) ? $manteForm[$causa] : '') ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::ARREGLO, true) ?>" class="col-sm-2 control-label">Arreglo</label>
    <div class="col-sm-10">
      <textarea class="form-control popover-dismiss" data-toggle="popover" title="Ayuda" data-placement="top" data-content="Descripcion de lo que se le realizo o realizara a la maquina o equipo." rows="3" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::ARREGLO, true) ?>" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::ARREGLO, true) ?>"><?php echo (isset($edit) and $edit) ? $objMante->$arreglo : ((isset($manteForm[$arreglo])) ? $manteForm[$arreglo] : '') ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::OBSERVACION, true) ?>" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objMante->$observacion : ((isset($manteForm[$observacion])) ? $manteForm[$observacion] : '') ?></textarea>
    </div>
  </div>
  <input type="hidden" id="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::ID, true) ?>" name="<?php echo mantenimientoTableClass::getNameField(mantenimientoTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objMante->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
