<!-- Modal -->
<?php $idEmplSal = empleadoTableClass::ID ?>
<?php $nombreEmplSal = empleadoTableClass::NOMBRE ?>
<?php $idEmplRec = empleadoTableClass::ID ?>
<?php $nombreEmplRec = empleadoTableClass::NOMBRE ?>



<?php use mvc\i18n\i18nClass ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe Por:</h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('fecha') ?></label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>_ini" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>_ini" placeholder="Fecha inicio">
                        <br>
                        <input type="date" class="form-control" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>_fin" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) ?>_fin" placeholder="Fecha final">
                    </div>
                        </div>
                    <div class="form-group">
                        <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('empleadoEntrega') ?></label>
                        <div class="col-sm-10">
                            <select id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true) ?>" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($objEmplSal as $dataEmplSal): ?>
                                    <option value="<?php echo $dataEmplSal->$idEmplSal ?>"><?php echo $dataEmplSal->$nombreEmplSal ?></option>
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
                                    <option value="<?php echo $dataEmplRec->$idEmplRec ?>"><?php echo $dataEmplRec->$nombreEmplRec ?></option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('requisicion') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true) ?>" placeholder="Requisicion Salida Insumo a buscar">
                        </div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label for="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
                                            <div class="col-sm-10 checkboxFlow">
                                                <input type="checkbox" class="form-control" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true) ?>" value="t" <?php echo ($SalidaInsumo->$anulado) ? 'checked' : '' ?>>
                                                <input type="hidden" id="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true) ?>" name="<?php echo salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true) ?>" value="<?php echo $SalidaInsumo->$id ?>">
                                            </div>
                                        </div>-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18nClass::__('close') ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo i18nClass::__('generar') ?></button>
                    </div>
                    </div>
            </form>
        
    </div>
</div>
</div>