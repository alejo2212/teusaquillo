<!-- Modal -->
<?php $idtipoinsumo = tipoInsumoTableClass::ID ?>
<?php $nombretipoinsu = tipoInsumoTableClass::NOMBRE ?>
<?php $idpresentacion = presentacionTableClass::ID ?>
<?php $nombrepresentacion = presentacionTableClass::NOMBRE ?>
<?php $idunidadmedida = unidadMedidaTableClass::ID ?>
<?php $nombreunidadmedida = unidadMedidaTableClass::NOMBRE ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog MImodal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index') ?>" class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" class="col-sm-4 control-label">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" placeholder="Nombre de Insumo a buscar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true) ?>" class="col-sm-4 control-label">Existencia</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="<?php echo insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true) ?>" placeholder=" Insumo a buscar por Existencia en Bodega">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true) ?>" class="col-sm-4 control-label">Tipo de Insumo</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true) ?>" id="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objtipoinsumo as $datatipoinsumo): ?>
                                    <option value="<?php echo $datatipoinsumo->$idtipoinsumo ?>"><?php echo $datatipoinsumo->$nombretipoinsu ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">

                        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true) ?>" class="col-sm-4 control-label">Presentacion de Insumo</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true) ?>" id="<?php echo insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objpresentacion as $datapresentacion): ?>
                                    <option value="<?php echo $datapresentacion->$idpresentacion ?>"><?php echo $datapresentacion->$nombrepresentacion ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true) ?>" class="col-sm-4 control-label">Unidad Medida de Insumo</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="<?php echo insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true) ?>" id="<?php echo insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true) ?>">
                                <option value="">Seleccione</option>
                                <?php foreach ($objunidadmedida as $dataunidadmedida): ?>
                                    <option value="<?php echo $dataunidadmedida->$idunidadmedida ?>"><?php echo $dataunidadmedida->$nombreunidadmedida ?></option>
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