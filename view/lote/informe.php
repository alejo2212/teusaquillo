<!-- Modal -->

<?php use mvc\i18n\i18nClass ?>
<?php $idraza = razaTableClass::ID ?>
<?php $nraza = razaTableClass::NOMBRE ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>

<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog MImodal-dialogLote"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por: </h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'informe') ?>" target="_blank" class="form-horizontal" role="form">

               <div class="modal-body">
          <div class="row">
            <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true) ?>"><?php echo i18nClass::__('empleado') ?></label>
                <select id="<?php echo loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true) ?>" class="form-control">
                  <option value=""><?php echo i18nClass::__('seleccione') ?></option>
                  <?php foreach ($objEmpleado as $dataEmple): ?>
                    <option value="<?php echo $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>"><?php echo i18nClass::__('lote') ?></label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" placeholder="numero lote  a buscar">
              </div>
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>">Fecha de Entrada a Granja</label>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>_ini" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>_ini" placeholder="Fecha inicio">
                <br>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>_fin" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>_fin" placeholder="Fecha final">
              </div>
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>"><?php echo i18nClass::__('fechaEntradaProduccion') ?></label>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>_ini" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>_ini" placeholder="Fecha inicio">
                <br>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>_fin" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>_fin" placeholder="Fecha final">
              </div>
            </div><!-- /.bloque 1. -->

            <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6"><!-- INICIO /.bloque 2. -->
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::RAZA_ID, true) ?>"><?php echo i18nClass::__('raza') ?></label>
                <select id="<?php echo loteTableClass::getNameField(loteTableClass::RAZA_ID, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::RAZA_ID, true) ?>" class="form-control">
                  <option value=""><?php echo i18nClass::__('seleccione') ?></option>
                  <?php foreach ($objRaza as $dataRaza): ?>
                    <option value="<?php echo $dataRaza->$idraza ?>"><?php echo $dataRaza->$nraza ?></option>
                  <?php endforeach; ?>
                </select>
              </div> 
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true) ?>"><?php echo i18nClass::__('cantidadTotal') ?></label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true) ?>" placeholder="numero lote  a buscar">
              </div>
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>"><?php echo i18nClass::__('fechaSalidaEstipulada') ?></label>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>_ini" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>_ini" placeholder="Fecha inicio">
                <br>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>_fin" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>_fin" placeholder="Fecha final">
              </div>
              <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>"><?php echo i18nClass::__('fechaSalidaReal') ?></label>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>_ini" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>_ini" placeholder="Fecha inicio">
                <br>
                <input type="date" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>_fin" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>_fin" placeholder="Fecha final">
              </div>
            </div><!-- /.bloque 2. -->
          </div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18nClass::__('close') ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo i18nClass::__('generar') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>