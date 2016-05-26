
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\i18n\i18nClass ?>
<?php $id = ambienteTableClass::ID ?>
<?php $nombre = ambienteTableClass::NOMBRE ?>
<?php $observacion = ambienteTableClass::OBSERVACION ?>
<?php $tipoamb = ambienteTableClass::TIPO_AMBIENTE_ID ?>
<?php $idTipoAmb = tipoAmbienteTableClass::ID ?>
<?php $nombreTipoAmb = tipoAmbienteTableClass::NOMBRE ?>
<?php $ambienteForm = session::getInstance()->getFlash('ambiente') ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambiente', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
    <div class="form-group">
        <label for="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('nombre') ?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $ambiente->$nombre : ((isset($ambienteForm[$nombre])) ? $ambienteForm[$nombre] : '') ?>">
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('tipoAmbiente') ?></label>
        <div class="col-sm-10">
            <select id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true) ?>" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true) ?>" class=" form-control">
                <option value="">Seleccione</option>
                <?php foreach ($objTipoAmb as $dataTipoAmb): ?>
                <option  <?php echo (((isset($edit) and $edit) and ($ambiente->$tipoamb == $dataTipoAmb->$idTipoAmb )) ? 'selected ': ((isset($ambienteForm[$tipoamb]) and ($ambienteForm[$tipoamb] == $dataTipoAmb->$idTipoAmb)) ? 'selected ' : '') ) ?> value="<?php echo $dataTipoAmb->$idTipoAmb ?>"><?php echo $dataTipoAmb->$nombreTipoAmb ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
            <label for="<?php echo ambienteTableClass::getNameField(ambienteTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('observacion') ?></label>
            <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::OBSERVACION, true) ?>" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $ambiente->$observacion : ((isset($ambienteForm[$observacion])) ? $ambienteForm[$observacion] : '') ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambiente', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> <?php echo i18nClass::__('volver') ?></a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> <?php echo i18nClass::__('registrar') ?></button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambiente', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> <?php echo i18nClass::__('cancelar') ?></a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo ambienteTableClass::getNameField(ambienteTableClass::ID, true) ?>" name="<?php echo ambienteTableClass::getNameField(ambienteTableClass::ID, true) ?>" value="<?php echo $ambiente->$id ?>">
    <?php endif; ?>
</form>