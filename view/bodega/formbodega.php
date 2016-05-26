<?php

use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $bodegaForm = session::getInstance()->getFlash('bodega') ?>
<?php $id = bodegaTableClass::ID ?>
<?php $lote = bodegaTableClass::LOTE_ID ?>
<?php $clasibode = bodegaTableClass::BODEGA_CLASIFICACION_ID ?>
<?php $insu = bodegaTableClass::INSUMO_ID ?>
<?php $entrabode = bodegaTableClass::ENTRADA_BODEGA_ID ?>
<?php $fechaven = bodegaTableClass::FECHA_VENCIMIENTO ?>
<?php $cantida = bodegaTableClass::CANTIDAD ?>
<?php $actived = bodegaTableClass::ACTIVO ?>

<?php $idlote = loteTableClass::ID ?>
<?php $nombrelote = loteTableClass::LOTE ?>
<?php $idclasibode = bodegaClasificacionTableClass::ID ?>
<?php $nombreclasibode = bodegaClasificacionTableClass::NOMBRE ?>
<?php $idinsu = insumoTableClass::ID ?>
<?php $nombreinsu = insumoTableClass::NOMBRE ?>



<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">


    <div class="form-group">
        <label for="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" class="col-sm-4 control-label">Numero de lote</label>
        <div class="col-sm-8">

            <select class="form-control" name="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" id="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objlote as $datalote): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objbodega->$lote == $datalote->$idlote)) ? 'selected' : ((isset($bodegaForm[$lote]) and ($bodegaForm[$lote] == $datalote->$idlote)) ? 'selected ' : '')) ?> value="<?php echo $datalote->$idlote ?>"><?php echo $datalote->$nombrelote ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" class="col-sm-4 control-label">Clasificacion de Bodega</label>
        <div class="col-sm-8">

            <select class="form-control" name="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" id="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objclasibodega as $dataclasibode): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objbodega->$clasibode == $dataclasibode->$idclasibode)) ? 'selected' : ((isset($bodegaForm[$clasibode]) and ($bodegaForm[$clasibode] == $dataclasibode->$idclasibode)) ? 'selected ' : '')) ?> value="<?php echo $dataclasibode->$idclasibode ?>"><?php echo $dataclasibode->$nombreclasibode ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" class="col-sm-4 control-label">Insumo</label>
        <div class="col-sm-8">

            <select class="form-control" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" id="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>">
                <option value="" >Seleccione</option>
                <?php foreach ($objinsu as $datainsu): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objbodega->$insu == $datainsu->$idinsu)) ? 'selected' : ((isset($bodegaForm[$insu]) and ($bodegaForm[$insu] == $datainsu->$idinsu)) ? 'selected ' : '')) ?> value="<?php echo $datainsu->$idinsu ?>"><?php echo $datainsu->$nombreinsu ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ENTRADA_BODEGA_ID, true) ?>" class="col-sm-4 control-label">Numero de entrada Bodega (Factura o Remision)</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ENTRADA_BODEGA_ID, true) ?>" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ENTRADA_BODEGA_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? entradaBodegaTableClass::getRemision($objbodega->$entrabode) : ((isset($bodegaForm[$entrabode])) ? $bodegaForm[$entrabode] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::FECHA_VENCIMIENTO, true) ?>" class="col-sm-4 control-label">Fecha de Vencimiento</label>
        <div class="col-sm-8">
          <input type="datetime-local" class="form-control" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::FECHA_VENCIMIENTO, true) ?>" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::FECHA_VENCIMIENTO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objbodega->$fechaven) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objbodega->$fechaven)) : '' : ((isset($bodegaForm[$fechaven])) ? $bodegaForm[$fechaven] : '') ?>">
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::CANTIDAD, true) ?>" class="col-sm-4 control-label">Cantidad</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::CANTIDAD, true) ?>" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objbodega->$cantida : ((isset($bodegaForm[$cantida])) ? $bodegaForm[$cantida] : '') ?>" placeholder="Cantidad que entra a la bodega">
        </div>
    </div>

    <?php if (isset($edit) and $edit): ?>
        <div class="form-group">
            <label for="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ACTIVO, true) ?>" class="col-sm-4 control-label"><?php echo i18nClass::__('activado') ?></label>
            <div class="col-sm-8 checkboxFlow">
                <input type="checkbox" class="form-control" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ACTIVO, true) ?>" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ACTIVO, true) ?>" value="t" <?php echo ($objbodega->$actived) ? 'checked' : '' ?>>
                <input type="hidden" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ID, true) ?>" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ID, true) ?>" value="<?php echo $objbodega->$id ?>">
            </div>
        </div>
    <?php endif ?>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>



    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ID, true) ?>" name="<?php echo bodegaTableClass::getNameField(bodegaTableClass::ID, true) ?>" value="<?php echo $objbodega->$id ?>">
    <?php endif; ?>
</form>