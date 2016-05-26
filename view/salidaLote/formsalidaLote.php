<?php
use mvc\config\configClass as config;
use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass ?>
<?php $id = salidaLoteTableClass::ID ?>
<?php $fecha = salidaLoteTableClass::FECHA_REALI ?>
<?php $ambhislote = salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID ?>
<?php $razonsal = salidaLoteTableClass::RAZON_SALIDA_ID ?>
<?php $cantt = salidaLoteTableClass::CANTIDAD_TOTAL ?>
<?php $cantm = salidaLoteTableClass::CANTIDAD_MACHOS ?>
<?php $canth = salidaLoteTableClass::CANTIDAD_HEMBRAS ?>
<?php $empl = salidaLoteTableClass::EMPLEADO_ID ?>
<?php $idrazonS = razonSalidaTableClass::ID ?>
<?php $nrazonS = razonSalidaTableClass::RAZON ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $nomAmbi = ambienteTableClass::NOMBRE ?>
<?php $lote = loteTableClass::LOTE ?>
<?php $casetaAhl = ambienteHistorialLoteTableClass::NO_CASETA ?>
<?php $idAhl = ambienteHistorialLoteTableClass::ID ?>
<?php $salidaLoteForm = session::getInstance()->getFlash('salidaLote') ?>
<?php // echo 'id=',$SalidaLote->$id ?>
<?php
$fechahoy = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
$newLeng = strlen($fechahoy) - 3;
$fechahoy = substr($fechahoy, 0, $newLeng);
if(isset($edit) === true and isset($SalidaLote->$fecha)){
  $SalidaLote->$fecha = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
$newLeng = strlen($SalidaLote->$fecha) - 3;
$SalidaLote->$fecha = substr($SalidaLote->$fecha, 0, $newLeng);
}
?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
  <div class="form-group">
    <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>" class="col-sm-3 control-label">Fecha de Realizacion</label>
    <div class="col-sm-9">
      <input type="datetime-local" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($SalidaLote->$fecha) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($SalidaLote->$fecha)) : $fechahoy : ((isset($salidaLoteForm[$fecha])) ? $salidaLoteForm[$fecha] : $fechahoy) ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('ambienteHistorialLote') ?></label>
    <div class="col-sm-9">
      <select id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" class="form-control">
        <option>Seleccione</option>
        <?php foreach ($objAmbienteHistorial as $dataAmbiente): ?>
          <option <?php echo (((isset($edit) and $edit) and ( $SalidaLote->$ambhislote == $dataAmbiente->$idAhl)) ? 'selected ' : ((isset($salidaLoteForm[$ambhislote]) and ( $salidaLoteForm[$ambhislote] == $dataAmbiente->$idAhl)) ? 'selected ' : '')) ?> value="<?php echo $dataAmbiente->$idAhl ?>"><?php echo 'Lote:' . $dataAmbiente->$lote . ' - '. $dataAmbiente->$nomAmbi . ' - Caseta:' . $dataAmbiente->$casetaAhl ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('razon') ?></label>
    <div class="col-sm-9">
      <select id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true) ?>" class="form-control">
        <option value="">Seleccione</option>
        <?php foreach ($objRazonSalida as $dataRazonSalida): ?>
          <option  <?php echo (((isset($edit) and $edit) and ( $SalidaLote->$razonsal == $dataRazonSalida->$idrazonS )) ? 'selected ' : ((isset($salidaLoteForm[$razonsal]) and ( $salidaLoteForm[$razonsal] == $dataRazonSalida->$idrazonS)) ? 'selected ' : '') ) ?> value="<?php echo $dataRazonSalida->$idrazonS ?>"><?php echo $dataRazonSalida->$nrazonS ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <!--    <div class="form-group">
          <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('cantidadTotal') ?></label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $SalidaLote->$cantt : ((isset($salidaLoteForm[$cantt])) ? $salidaLoteForm[$cantt] : '') ?>">
          </div>
      </div>-->

  <div class="form-group">
    <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('cantidadMachos') ?></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true) ?>"  value="<?php echo (isset($edit) and $edit) ? $SalidaLote->$cantm : ((isset($salidaLoteForm[$cantm])) ? $salidaLoteForm[$cantm] : 0) ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('cantidadHembras') ?></label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true) ?>"  value="<?php echo (isset($edit) and $edit) ? $SalidaLote->$canth : ((isset($salidaLoteForm[$canth])) ? $salidaLoteForm[$canth] : 0) ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('empleado') ?></label>
    <div class="col-sm-9">
      <select id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true) ?>" class="form-control">
        <option value="">Seleccione</option>
        <?php foreach ($objEmpleado as $dataEmple): ?>
          <option  <?php echo (((isset($edit) and $edit) and ( $SalidaLote->$empl == $dataEmple->$idEmpleado )) ? 'selected ' : ((isset($salidaLoteForm[$empl]) and ( $salidaLoteForm[$empl] == $dataEmple->$idEmpleado)) ? 'selected ' : '') ) ?> value="<?php echo $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> <?php echo i18nClass::__('volver') ?></a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> <?php echo i18nClass::__('cancelar') ?></a>
    </div>
  </div>
  <?php if (isset($edit) === true and $edit === true): ?>
    <input type="hidden" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>" value="<?php echo $SalidaLote->$id ?>">
  <?php endif; ?>
</form>