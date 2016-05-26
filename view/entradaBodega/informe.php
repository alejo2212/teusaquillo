<!-- Modal -->
<?php $remision = entradaBodegaTableClass::REMISION ?>
<?php $idempleado = empleadoTableClass::ID ?>
<?php $nombreempleado = empleadoTableClass::NOMBRE ?>
<?php $idtransportador = transportadorTableClass::ID ?>
<?php $nombreransportador = transportadorTableClass::NOMBRE ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe por:</h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true) ?>" class="col-sm-4 control-label">Remision</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true) ?>" placeholder="Remision a buscar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true) ?>" class="col-sm-4 control-label">Empleado</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true) ?>" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objempleado as $dataempleado): ?>
                                    <option value="<?php echo $dataempleado->$idempleado ?>"><?php echo $dataempleado->$nombreempleado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">

                        <label for="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true) ?>" class="col-sm-4 control-label">Transportador</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true) ?>" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objtransportador as $datatransportador): ?>
                                    <option value="<?php echo $datatransportador->$idtransportador ?>"><?php echo $datatransportador->$nombreransportador ?></option>
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