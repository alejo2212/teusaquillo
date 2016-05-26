<!-- Modal -->
<?php use mvc\i18n\i18nClass ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> <?php echo i18nClass::__('filtrar') ?> <?php echo $countPages ?></h4>
            </div>
            <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'index') ?>" class="form-horizontal" role="form">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('insumo') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true) ?>" placeholder="Insumo a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('bodega') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true) ?>" placeholder="Bodega a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('cantidad') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true) ?>" placeholder="Cantidad a buscar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('anulado') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true) ?>" placeholder="Estado a buscar">
                        </div>
                    </div>
               </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18nClass::__('close') ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo i18nClass::__('filtrar') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>