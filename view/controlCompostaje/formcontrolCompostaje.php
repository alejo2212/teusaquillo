<?php

use mvc\config\configClass as config;
use mvc\i18n\i18nClass
?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = controlCompostajeTableClass::ID ?>
<?php $admin = controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR ?>
<?php $vete = controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO ?>
<?php $respon = controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE ?>
<?php $fechare = controlCompostajeTableClass::FECHA_REALIZACION ?>
<?php $cajon = controlCompostajeTableClass::CAJON_COMPOSTAJE_ID ?>
<?php $galli = controlCompostajeTableClass::GALLINAZA_UTILIZADA ?>
<?php $canaves = controlCompostajeTableClass::CANTIDAD_TOTAL_AVES ?>
<?php $cantm = controlCompostajeTableClass::CANTIDAD_MACHOS ?>
<?php $canth = controlCompostajeTableClass::CANTIDAD_HEMBRAS ?>
<?php $lotesalida = controlCompostajeTableClass::SALIDA_LOTE_ID ?>
<?php $observacion = controlCompostajeTableClass::OBSERVACION ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $idCajon = cajonCompostajeTableClass::ID ?>
<?php $numeroCajon = cajonCompostajeTableClass::OBSERVACION ?>
<?php $idSalidalote = salidaLoteTableClass::ID ?>
<?php $hembrasSalidalote = salidaLoteTableClass::CANTIDAD_HEMBRAS ?>
<?php $machosSalidalote = salidaLoteTableClass::CANTIDAD_MACHOS ?>
<?php $totalSalidalote = salidaLoteTableClass::CANTIDAD_TOTAL ?>
<?php $idAhl = ambienteHistorialLoteTableClass::ID ?>
<?php $casetaAhl = ambienteHistorialLoteTableClass::NO_CASETA ?>
<?php $nomAmbi = ambienteTableClass::NOMBRE ?>
<?php $lote = loteTableClass::LOTE ?>
<?php $controlCompostaje = session::getInstance()->getFlash('controlCompostaje') ?>
<?php $ahl = ambienteHistorialLoteTableClass::getAhlById(((isset($edit) and $edit) ? $objCompostajeE->$lotesalida : (isset($controlCompostaje[$lotesalida]) ? $controlCompostaje[$lotesalida] : $idSa['salida']))) ?>
<?php
$ambi = ambienteHistorialLoteTableClass::getAmbienteHistLoteById($ahl);

$fechahoy = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
$newLeng = strlen($fechahoy) - 3;
$fechahoy = substr($fechahoy, 0, $newLeng);
if (isset($edit) === true and isset($objCompostajeE->$fechare)) {
  $objCompostajeE->$fechare = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
  $newLeng = strlen($objCompostajeE->$fechare) - 3;
  $objCompostajeE->$fechare = substr($objCompostajeE->$fechare, 0, $newLeng);
}
?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

  <div class="row">
    <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" class="">Administrador</label>
        <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objAdmin as $dataAdmin): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objCompostajeE->$admin == $dataAdmin->$idEmpleado)) ? 'selected ' : ((isset($controlCompostaje[$admin]) and ( $controlCompostaje[$admin] == $dataAdmin->$idEmpleado)) ? 'selected ' : (count($objAdmin) == 1) ? ' selected ' : '')) ?>value="<?php echo $dataAdmin->$idEmpleado ?>"><?php echo $dataAdmin->$nombreEmpleado ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <input type="hidden" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>" value="<?php echo ((isset($edit) and $edit) ? $objCompostajeE->$lotesalida : (isset($controlCompostaje[$lotesalida]) ? $controlCompostaje[$lotesalida] : $idSa['salida'] )) ?>">
        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>" class="">Ubicacion - Numero Salida Lote '<?php echo ((isset($edit) and $edit) ? $objCompostajeE->$lotesalida : (isset($controlCompostaje[$lotesalida]) ? $controlCompostaje[$lotesalida] : $idSa['salida'] )) ?>'</label>
        <input type="text" class="form-control" id="" name="" required value="<?php echo 'Lote:' . $ambi->$lote . ' - ' . $ambi->$nomAmbi . ' - Caseta:' . $ambi->$casetaAhl ?>" readonly="">
        <!--<select readonly class="form-control" <?ph echo ((isset($idSa) and $idSa != '') ? ' disabled="" ' : '') ?> name="<?ph echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>" id="<?ph echo salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true) ?>">-->
        <!--          <option value="">Seleccione</option>
        <?ph foreach ($objSalidalote as $datalote): ?>
                      <option <?ph echo (((isset($edit) and $edit) and ( $objCompostajeE->$lotesalida == $datalote->$idSalidalote)) ? 'selected ' : ((isset($controlCompostaje[$lotesalida]) and ( $controlCompostaje[$lotesalida] == $datalote->$idSalidalote)) ? 'selected ' : ((isset($idSa)and ( $idSa == $datalote->$idSalidalote)) ? 'selected ' : ''))) ?> value="<?ph echo $datalote->$idSalidalote ?>"><?ph echo $datalote->$idSalidalote ?></option>
        <?ph endforeach; ?>
                </select>-->
      </div>
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true) ?>" class="">Cantidad Hembras</label>
        <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCompostajeE->$canth : ((isset($controlCompostaje[$canth])) ? $controlCompostaje[$canth] : $idSa['hembras']) ?>" readonly="">
      </div>
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" class=" control-label">Responsable</label>
        <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objEmpleado as $dataEmple): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objCompostajeE->$respon == $dataEmple->$idEmpleado)) ? 'selected ' : ((isset($controlCompostaje[$respon]) and ( $controlCompostaje[$respon] == $dataEmple->$idEmpleado)) ? 'selected ' : '')) ?> value="<?php echo $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true) ?>" class="">Cajon</label>
        <select class="form-control" name="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true) ?>" id="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objCajon as $dataCaj): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objCompostajeE->$cajon == $dataCaj->$idCajon)) ? 'selected ' : ((isset($controlCompostaje[$cajon]) and ( $controlCompostaje[$cajon] == $dataCaj->$idCajon)) ? 'selected ' : '')) ?>value="<?php echo $dataCaj->$idCajon ?>"><?php echo $dataCaj->$numeroCajon ?></option>
          <?php endforeach; ?>
        </select>
      </div>

    </div><!-- /.bloque 1. -->

    <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" class="">Veterinario</label>

        <select class="form-control" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objVeterinario as $dataVeteri): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objCompostajeE->$vete == $dataVeteri->$idEmpleado)) ? 'selected ' : ((isset($controlCompostaje[$vete]) and ( $controlCompostaje[$vete] == $dataVeteri->$idEmpleado)) ? 'selected ' : (count($objVeterinario) == 1) ? ' selected ' : '')) ?> value="<?php echo $dataVeteri->$idEmpleado ?>"><?php echo $dataVeteri->$nombreEmpleado ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true) ?>" class="">Cantidad Total Aves</label>
        <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCompostajeE->$canaves : ((isset($controlCompostaje[$canaves])) ? $controlCompostaje[$canaves] : $idSa['hembras'] + $idSa['machos']) ?>" readonly="">
      </div>
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true) ?>" class="">Cantiad Machos</label>
        <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCompostajeE->$cantm : ((isset($controlCompostaje[$cantm])) ? $controlCompostaje[$cantm] : $idSa['machos']) ?>" readonly="">
      </div>
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true) ?>" class="">Gallinaza Utilizada (Blts)</label>
        <input type="text" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objCompostajeE->$galli : ((isset($controlCompostaje[$galli])) ? $controlCompostaje[$galli] : '') ?>">
      </div>
      <div class="form-group">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>" class="">Fecha De Realizacion</label>
        <input type="datetime-local" class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($objCompostajeE->$fechare) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objCompostajeE->$fechare)) : $fechahoy : ((isset($controlCompostaje[$fechare])) ? $controlCompostaje[$fechare] : $fechahoy) ?>" required="">
      </div>
    </div><!-- /.bloque 2. -->   
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div id="observa" class="">
        <label for="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::OBSERVACION, true) ?>" class="">Observaciones</label>
        <textarea class="form-control" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::OBSERVACION, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objCompostajeE->$observacion : ((isset($controlCompostaje[$observacion])) ? $controlCompostaje[$observacion] : '') ?></textarea>
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
  <?php if (isset($edit) === true and $edit === true): ?>
    <input type="hidden" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::ID, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::ID, true) ?>" value="<?php echo $objCompostajeE->$id ?>">
    <input type="hidden" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true) ?>" value="<?php echo $objCompostajeE->$admin ?>">
    <input type="hidden" id="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" name="<?php echo controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true) ?>" value="<?php echo $objCompostajeE->$vete ?>">
  <?php endif; ?>

</form>