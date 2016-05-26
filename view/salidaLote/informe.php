<!-- Modal -->
<?php $idrazonS = razonSalidaTableClass::ID ?>
<?php $nrazonS = razonSalidaTableClass::RAZON ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>


<?php use mvc\i18n\i18nClass ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
                <h4 class="modal-title" id="myModalInforme"><i class="fa fa-filter"></i>Generar Informe Por:</h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('ambienteHistorialLote') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true) ?>" placeholder="Ambiente H. Lote a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('razonSalida') ?></label>
                        <div class="col-sm-10">
                            <select id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true) ?>" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($objRazonSalida as $dataRazonSalida): ?>
                                    <option value="<?php echo $dataRazonSalida->$idrazonS ?>"><?php echo $dataRazonSalida->$nrazonS ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('cantidadTotal') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true) ?>" placeholder="Cantidad Total  a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('cantidadMachos') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true) ?>" placeholder="Cantidad de Machos a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('cantidadHembras') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" placeholder="Cantidad de Hembras a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('empleado') ?></label>
                        <div class="col-sm-10">
                            <select id="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true) ?>" name="<?php echo salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true) ?>" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($objEmpleado as $dataEmple): ?>
                                    <option value="<?php echo $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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