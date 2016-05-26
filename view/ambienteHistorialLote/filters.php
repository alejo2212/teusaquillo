<!-- Modal -->
<?php $numerocaseta = ambienteHistorialLoteTableClass::NO_CASETA ?>
<?php $idambiente = ambienteTableClass::ID ?>
<?php $nombreambiente = ambienteTableClass::NOMBRE ?>
<?php $idlote = loteTableClass::ID ?>
<?php $nombrelote = loteTableClass::LOTE ?>

<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog MImodal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', 'index') ?>" class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true) ?>" class="col-sm-4 control-label">Numero de Caseta</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true) ?>" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true) ?>" placeholder="Numero de caseta a buscar">
                        </div>
                    </div>
                    <div class="form-group">

                        <label for="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true) ?>" class="col-sm-4 control-label">Ambiente</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true) ?>" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objambiente as $dataambiente): ?>
                                    <option value="<?php echo $dataambiente->$idambiente ?>"><?php echo $dataambiente->$nombreambiente ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">

                        <label for="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true) ?>" class="col-sm-4 control-label">Lote</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true) ?>" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objlote as $datalote): ?>
                                    <option value="<?php echo $datalote->$idlote ?>"><?php echo $datalote->$nombrelote ?></option>
                                <?php endforeach; ?>
                            </select>
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