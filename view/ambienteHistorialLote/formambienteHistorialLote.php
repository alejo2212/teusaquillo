<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $ambienteHistorialLoteform = session::getInstance()->getFlash('ambienteHistorialLote') ?>
<?php $id = ambienteHistorialLoteTableClass::ID ?>
<?php $ambiente = ambienteHistorialLoteTableClass::AMBIENTE_ID ?>
<?php $lote = ambienteHistorialLoteTableClass::LOTE_ID ?>
<?php $numerocaseta = ambienteHistorialLoteTableClass::NO_CASETA ?>
<?php $canth = ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS ?>
<?php $cantm = ambienteHistorialLoteTableClass::CANTIDAD_MACHOS ?>

<?php $idambiente = ambienteTableClass::ID ?>
<?php $nombreambiente = ambienteTableClass::NOMBRE ?>
<?php $idlote = loteTableClass::ID ?>
<?php $nombrelote = loteTableClass::LOTE ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <div class="form-group">
        <label for="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Ambiente</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objambiente as $dataambiente): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objambienteHistorialLote->$ambiente == $dataambiente->$idambiente)) ? 'selected' : ((isset($ambienteHistorialLoteform[$ambiente]) and ($ambienteHistorialLoteform[$ambiente] == $dataambiente->$idambiente)) ? 'selected ' : '')) ?> value="<?php echo $dataambiente->$idambiente ?>"><?php echo $dataambiente->$nombreambiente ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" class="col-sm-2 control-label">Lote</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" id="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objlote as $datalote): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objambienteHistorialLote->$lote == $datalote->$idlote)) ? 'selected' : ((isset($ambienteHistorialLoteform[$lote]) and ($ambienteHistorialLoteform[$lote] == $datalote->$idlote)) ? 'selected ' : '')) ?> value="<?php echo $datalote->$idlote ?>"><?php echo $datalote->$nombrelote ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true) ?>" class="col-sm-2 control-label">Numero de Caseta</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true) ?>" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objambienteHistorialLote->$numerocaseta : ((isset($ambienteHistorialLoteform[$numerocaseta])) ? $ambienteHistorialLoteform[$numerocaseta] : '') ?>">
        </div>
    </div>

     <div class="form-group">
        <label for="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" class="col-sm-2 control-label">Cantidad de Hembras</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objambienteHistorialLote->$canth : ((isset($ambienteHistorialLoteform[$canth])) ? $ambienteHistorialLoteform[$canth] : '') ?>">
        </div>
    </div>

     <div class="form-group">
        <label for="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_MACHOS, true) ?>" class="col-sm-2 control-label">Cantidad de Machos</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_MACHOS, true) ?>" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_MACHOS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objambienteHistorialLote->$cantm : ((isset($ambienteHistorialLoteform[$cantm])) ? $ambienteHistorialLoteform[$cantm] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID, true) ?>" name="<?php echo ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID, true) ?>" value="<?php echo $objambienteHistorialLote->$id ?>">
    <?php endif; ?>
</form>