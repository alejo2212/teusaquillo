<!-- Modal -->
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

<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog MImodal-dialogLote">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Genertar Informe Por:</h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="row">
            <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
              <div class="form-group">
                <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true) ?>" class="col-sm-4 control-label">Lote</label>
                <div class="col-sm-8">
                  <select class="form-control" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true) ?>" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objlote as $dataL): ?>
                      <option value="<?php echo $dataL->$idLote ?>"><?php echo $dataL->$nomLote ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
              <div class="form-group">
                <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true) ?>" class="col-sm-4 control-label">Empleado</label>
                <div class="col-sm-8">
                  <select class="form-control" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true) ?>" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objEmpleado as $data): ?>
                      <option value="<?php echo $data->$idEmple ?>"><?php echo $data->$nomEmple ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" class="col-sm-4 control-label">Numero de salida</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" placeholder="Numero de salida">
                </div>
              </div>
            </div>
            <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">

              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Entrada Equipo</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Inicio</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Inicio Cortina</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Inicio Cama</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
            </div>

            <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Finalizacion</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Finalizacion Cortina</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Fecha de Finalizacion Cama</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>_ini" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>_ini" placeholder="Fecha inicio">
                  <br>
                  <input type="date" class="form-control" id="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>_fin" name="<?php echo registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) ?>_fin" placeholder="Fecha final">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
      </form>
    </div>
  </div>
</div>