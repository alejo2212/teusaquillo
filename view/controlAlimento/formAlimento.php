<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $controlAlimentoForm = session::getInstance()->getFlash('controlAlimento') ?>
<?php $id = controlAlimentoTableClass::ID ?>
<?php $ambHistoLote = controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID ?>
<?php $salidaInsumo = controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $emple = controlAlimentoTableClass::ID_EMPLEADO ?>
<?php $sexo = controlAlimentoTableClass::SEXO ?>
<?php $cantidad = controlAlimentoTableClass::CANTIDAD ?>
<?php $fecha = controlAlimentoTableClass::FECHA ?>
<?php $semana = controlAlimentoTableClass::SEMANA ?>
<?php $observacion = controlAlimentoTableClass::OBSERVACION ?>
<?php $idEmple = empleadoTableClass::ID ?>
<?php $nomEmple = empleadoTableClass::NOMBRE ?>
<?php $nomAmbi = ambienteTableClass::NOMBRE ?>
<?php $lote = loteTableClass::LOTE ?>
<?php $idAhl = ambienteHistorialLoteTableClass::ID ?>
<?php $nomAhl = ambienteHistorialLoteTableClass::AMBIENTE_ID ?>
<?php $loteAhl = ambienteHistorialLoteTableClass::LOTE_ID ?>
<?php $casetaAhl = ambienteHistorialLoteTableClass::NO_CASETA ?>
<?php $chAhl = ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS ?> 
<?php $cmAhl = ambienteHistorialLoteTableClass::CANTIDAD_MACHOS ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="row">
        <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <input type="hidden" value="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'searchControl') ?>" id="urlBuscarControl">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>">Numero de Salida</label>
                <div class="input-group">
                    <input type="text" class="form-control" data-id="idBuscarControl" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objControlAlimento->$salidaInsumo : ((isset($controlAlimentoForm[$salidaInsumo])) ? $controlAlimentoForm[$salidaInsumo] : '') ?>">
                    <span class="input-group-btn">
                        <a id="btnBuscarControl" class="btn btn-default"><i class="fa fa-search fa-fw"></i> Buscar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true) ?>">Empleado que realiza</label>
                <select id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true) ?>" class="form-control">
                    <option>Seleccione</option>
                    <?php foreach ($objEmpleado as $dataEmple): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objControlAlimento->$emple == $dataEmple->$idEmple)) ? 'selected ' : ((isset($controlAlimentoForm[$emple]) and ($controlAlimentoForm[$emple] == $dataEmple->$idEmple)) ? 'selected ' : '')) ?>  value="<?php echo $dataEmple->$idEmple ?>"><?php echo $dataEmple->$nomEmple ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true) ?>">Sexo del ave</label>
                <select id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true) ?>" class="form-control">
                    <option value="">Seleccione</option>
                    <option <?php echo (((isset($edit) and $edit) and ($objControlAlimento->$sexo == true)) ? 'selected ' : ((isset($controlAlimentoForm[$sexo]) and ($controlAlimentoForm[$sexo] == true)) ? 'selected ' : '')) ?> value="t">Masculino</option>
                    <option <?php echo (((isset($edit) and $edit) and ($objControlAlimento->$sexo == false)) ? 'selected ' : ((isset($controlAlimentoForm[$sexo]) and ($controlAlimentoForm[$sexo] == false)) ? 'selected ' : '')) ?> value="f">Femenino</option>
                </select>
            </div>
            <div class="form-group">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD, true) ?>">Cantidad de insumo utilizado</label>
                <input type="text" class="form-control" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objControlAlimento->$cantidad : ((isset($controlAlimentoForm[$cantidad])) ? $controlAlimentoForm[$cantidad] : '') ?>">
            </div>
        </div><!-- /.bloque 1. -->

        <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>">Fecha de realizacion</label>
                <input type="datetime-local" class="form-control" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objControlAlimento->$fecha) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objControlAlimento->$fecha)) : '' : ((isset($controlAlimentoForm[$fecha])) ? $controlAlimentoForm[$fecha] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>">N° de Ramada</label>
                <select id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" class="form-control">
                    <option>Seleccione</option>
                    <?php foreach ($objAmbienteHistorial as $dataAmbiente): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objControlAlimento->$ambHistoLote == $dataAmbiente->$idAhl)) ? 'selected ' : ((isset($controlAlimentoForm[$ambHistoLote]) and ($controlAlimentoForm[$ambHistoLote] == $dataAmbiente->$idAhl)) ? 'selected ' : '')) ?> value="<?php echo $dataAmbiente->$idAhl ?>"><?php echo $dataAmbiente->$nomAmbi . ' - Lote:' . $dataAmbiente->$lote . ' - Caseta:' . $dataAmbiente->$casetaAhl ?></option>
                    <?php endforeach; ?>
                </select>
                </select>
            </div>

            <div class="form-group">
                <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true) ?>">Semana (Edad de las aves)</label>
                <input type="text" class="form-control" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objControlAlimento->$semana : ((isset($controlAlimentoForm[$semana])) ? $controlAlimentoForm[$semana] : '') ?>">
            </div>
        </div><!-- /.bloque 2. -->
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div id="observa" class="">
            <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION, true) ?>">Observacion</label>
            <textarea class="form-control" rows="3" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objControlAlimento->$observacion : ((isset($controlAlimentoForm[$observacion])) ? $controlAlimentoForm[$observacion] : '') ?></textarea>
          </div>
        </div>
    </div>

    <input type="hidden" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objControlAlimento->$id : '' ?>">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
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