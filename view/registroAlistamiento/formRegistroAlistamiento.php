<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $registroAlistamientoForm = session::getInstance()->getFlash('registroAlistamiento') ?>
<?php $idLote = loteTableClass::ID ?>
<?php $nomLote = loteTableClass::LOTE ?>
<?php $idEmple = empleadoTableClass::ID ?>
<?php $nomEmple = empleadoTableClass::NOMBRE ?>
<?php $idSalida = salidaInsumoDetalleTableClass::ID ?>
<?php $id = registroAlistamientoTableClass::ID ?>
<?php $empleado = registroAlistamientoTableClass::EMPLEADO_ID ?>
<?php $lote = registroAlistamientoTableClass::LOTE_ID ?>
<?php $salida = registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $fecha_ini = registroAlistamientoTableClass::FECHA_INICIO ?>
<?php $fecha_fin = registroAlistamientoTableClass::FECHA_FIN ?>
<?php $fecha_ini_cortina = registroAlistamientoTableClass::FECHA_INICIO_CORTINA ?>
<?php $fecha_fin_cortina = registroAlistamientoTableClass::FECHA_FIN_CORTINA ?>
<?php $fecha_ini_cama = registroAlistamientoTableClass::FECHA_ENTRADA_CAMA ?>
<?php $fecha_fin_cama = registroAlistamientoTableClass::FECHA_TERMINO_CAMA ?>
<?php $fecha_equipo = registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="row">
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true) ?>" class="col-sm-4 control-label">Empleado</label>
        <div class="col-sm-8">
          <select class="form-control" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true) ?>" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true) ?>">
            <option value="">Seleccione</option>
            <?php foreach ($objEmpleado as $data): ?>
              <option <?php echo (((isset($edit) and $edit) and ( $objregistroAlistamiento->$empleado == $data->$idEmple)) ? 'selected ' : ((isset($registroAlistamientoForm[$empleado]) and ( $registroAlistamientoForm[$empleado] == $data->$idEmple)) ? 'selected ' : '')) ?>value="<?php echo $data->$idEmple ?>"><?php echo $data->$nomEmple ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true) ?>" class="col-sm-4 control-label">Lote</label>
        <div class="col-sm-8">
          <select class="form-control" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true) ?>" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true) ?>">
            <option value="">Seleccione</option>
            <?php foreach ($objlote as $dataL): ?>
              <option <?php echo (((isset($edit) and $edit) and ( $objregistroAlistamiento->$lote == $dataL->$idLote)) ? 'selected ' : ((isset($registroAlistamientoForm[$lote]) and ( $registroAlistamientoForm[$lote] == $dataL->$idLote)) ? 'selected ' : '')) ?>value="<?php echo $dataL->$idLote ?>"><?php echo $dataL->$nomLote ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>" class="col-sm-4 control-label">Inicio Cortina</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_ini_cortina) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_ini_cortina)) : '' : ((isset($registroAlistamientoForm[$fecha_ini_cortina])) ? $registroAlistamientoForm[$fecha_ini_cortina] : '') ?>" placeholder="Fecha de inicio de Cortina">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>" class="col-sm-4 control-label">Inicio Cama</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_ini_cama) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_ini_cama)) : '' : ((isset($registroAlistamientoForm[$fecha_ini_cama])) ? $registroAlistamientoForm[$fecha_ini_cama] : '') ?>" placeholder="Fecha de inicio de Cama">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>" class="col-sm-4 control-label">Inicio Alistamiento</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_ini) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_ini)) : '' : ((isset($registroAlistamientoForm[$fecha_ini])) ? $registroAlistamientoForm[$fecha_ini] : '') ?>" placeholder="Fecha de inicio del Alistamiento">
        </div>
      </div>
    </div>
    <div id="" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-4 control-label">Numero de Salida</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objregistroAlistamiento->$salida : ((isset($registroAlistamientoForm[$salida])) ? $registroAlistamientoForm[$salida] : '') ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>" class="col-sm-4 control-label">Entrada Equipo</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_equipo) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_equipo)) : '' : ((isset($registroAlistamientoForm[$fecha_equipo])) ? $registroAlistamientoForm[$fecha_equipo] : '') ?>" placeholder="Fecha de entrada del equipo">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>" class="col-sm-4 control-label">Fin Cortina</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_fin_cortina) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_fin_cortina)) : '' : ((isset($registroAlistamientoForm[$fecha_fin_cortina])) ? $registroAlistamientoForm[$fecha_fin_cortina] : '') ?>" placeholder="Fecha de finalizacion de Cortina">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>" class="col-sm-4 control-label">Fin Cama</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_fin_cama) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_fin_cama)) : '' : ((isset($registroAlistamientoForm[$fecha_fin_cama])) ? $registroAlistamientoForm[$fecha_fin_cama] : '') ?>" placeholder="Fecha de finalizacion de Cama">
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>" class="col-sm-4 control-label">Fin del Alistamiento</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroAlistamiento->$fecha_fin) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroAlistamiento->$fecha_fin)) : '' : ((isset($registroAlistamientoForm[$fecha_fin])) ? $registroAlistamientoForm[$fecha_fin] : '') ?>" placeholder="Fecha de finalizacion del Alistamiento">
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::ID, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objregistroAlistamiento->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>