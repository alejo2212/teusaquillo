<!-- Modal -->
<?php $registoali = alistamientoReparacionTableClass:: REGISTRO_ALISTAMIENTO_ID ?>
<?php $idrepa = tipoReparacionTableClass::ID ?>
<?php $nombrerepa = tipoReparacionTableClass::NOMBRE ?>
<?php $fechaini = alistamientoReparacionTableClass::FECHA_INICIO ?>

<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog MImodal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index') ?>" class="form-horizontal" role="form">
               <div class="modal-body">

                    <div class="form-group">
                        <label for="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true) ?>" class="col-sm-4 control-label">Alistamiento Reparacion</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true) ?>" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true) ?>" placeholder="alistamiento Reparacion a buscar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true) ?>" class="col-sm-4 control-label">Tipo de Reparacion</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true) ?>" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objtiporepa as $datarepa): ?>
                                    <option value="<?php echo $datarepa->$idrepa ?>"><?php echo $datarepa->$nombrerepa ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true) ?>" class="col-sm-4 control-label">Fecha de Inicio</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true) ?>" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true) ?>" placeholder="Fecha de Inicio">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
</div>