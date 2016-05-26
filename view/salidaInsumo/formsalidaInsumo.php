<?php

use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass ?>
<?php $id = salidaInsumoTableClass::ID ?>
<?php $empleSal = salidaInsumoTableClass::EMPLEADO_ID_SALIDA ?>
<?php $empleRec = salidaInsumoTableClass::EMPLEADO_ID_RECEPCION ?>
<?php $fecha = salidaInsumoTableClass::FECHA ?>
<?php $observacion = salidaInsumoTableClass::OBSERVACION ?>
<?php $anulado = salidaInsumoTableClass::ANULADO ?>
<?php $requisi = salidaInsumoTableClass::REQUISICION_ID ?>
<?php $idEmplSal = empleadoTableClass::ID ?>
<?php $nombreEmplSal = empleadoTableClass::NOMBRE ?>
<?php $idEmplRec = empleadoTableClass::ID ?>
<?php $nombreEmplRec = empleadoTableClass::NOMBRE ?>
<?php $salidaInsumoForm = session::getInstance()->getFlash('salidaInsumo') ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
  <!--  <div class="form-group">
      <label for="<?ph echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>" class="col-sm-2 control-label"><?ph echo i18nClass::__('fecha') ?></label>
      <div class="col-sm-10">
        <input type="datetime-local" class="form-control" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>"  value="<?php echo (isset($edit) and $edit) ? $SalidaInsumo->$fecha : ((isset($salidaInsumoForm[$fecha])) ? $salidaInsumoForm[$fecha] : '') ?>">
      </div>
    </div>-->

  <div class="form-group">
    <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('empleadoEntrega') ?> </label>
    <div class="col-sm-10">
      <select id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true) ?>" class="form-control">
        <option value="">Seleccione</option>
        <?php foreach ($objEmplSal as $dataEmplSal): ?>

          <option  <?php echo (((isset($edit) and $edit) and ( $SalidaInsumo->$empleSal == $dataEmplSal->$idEmplSal )) ? 'selected ' : ((isset($salidaInsumoForm[$empleSal]) and ( $salidaInsumoForm[$empleSal] == $dataEmplSal->$idEmplSal)) ? 'selected ' : '') ) ?> value="<?php echo $dataEmplSal->$idEmplSal ?>"><?php echo $dataEmplSal->$nombreEmplSal ?></option>

        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('empleadoRecibe') ?></label>
    <div class="col-sm-10">
      <select id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true) ?>" class="form-control">
        <option value="">Seleccione</option>
        <?php foreach ($objEmplRec as $dataEmplRec): ?>
          <option  <?php echo (((isset($edit) and $edit) and ( $SalidaInsumo->$empleRec == $dataEmplRec->$idEmplRec )) ? 'selected ' : ((isset($salidaInsumoForm[$empleRec]) and ( $salidaInsumoForm[$empleRec] == $dataEmplRec->$idEmplRec)) ? 'selected ' : '') ) ?>  value="<?php echo $dataEmplRec->$idEmplRec ?>"><?php echo $dataEmplRec->$nombreEmplRec ?></option>

        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <input type="hidden" value="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'searchControl') ?>" id="urlBuscarControl">
    <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true) ?>" class="col-sm-2 control-label">Requisicion Numero</label>
    <div class="col-sm-10">
      <div class="input-group">
        <input type="text" class="form-control" data-id="idBuscarControl" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $SalidaInsumo->$requisi : ((isset($salidaInsumoForm[$requisi])) ? $salidaInsumoForm[$requisi] : '') ?>">
        <span class="input-group-btn">
          <a id="btnBuscarControl" class="btn btn-default"><i class="fa fa-search fa-fw"></i> Buscar</a>
        </span>
      </div>
    </div>
  </div>
  <div class="form-group">

    <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('observacion') ?></label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::OBSERVACION, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $SalidaInsumo->$observacion : ((isset($salidaInsumoForm[$observacion])) ? $salidaInsumoForm[$observacion] : '') ?></textarea>
    </div>
  </div>
  <?php if (isset($edit) and $edit): ?>
    <div class="form-group">
      <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
      <div class="col-sm-10 checkboxFlow">
        <input type="checkbox" class="form-control" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true) ?>" value="t" <?php echo (isset($edit) and $edit and $SalidaInsumo->$anulado) ? 'checked' : ((isset($salidaInsumoForm[$anulado])) ? $salidaInsumoForm[$anulado] : '') ?>>
        <input type="hidden" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $SalidaInsumo->$id : '' ?>">
      </div>
    </div>
  <?php endif ?>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> <?php echo i18nClass::__('volver') ?></a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i><?php echo i18nClass::__('registrar') ?> </button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i><?php echo i18nClass::__('cancelar') ?></a>
    </div>
  </div>
  <?php if (isset($edit) === true and $edit === true): ?>
    <input type="hidden" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true) ?>" value="<?php echo $SalidaInsumo->$id ?>">
  <?php endif; ?>
</form>

<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>