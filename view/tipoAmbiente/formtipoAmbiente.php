
<?php

use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass ?>
<?php $id = tipoAmbienteTableClass::ID ?>
<?php $nombre = tipoAmbienteTableClass::NOMBRE ?>
<?php $descripcion = tipoAmbienteTableClass::DESCRIPCION ?>
<?php $observacion = tipoAmbienteTableClass::OBSERVACION ?>
<?php $tipoAmbienteForm = session::getInstance()->getFlash('tipoAmbiente') ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoAmbiente', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
    <div class="form-group">
        <label for="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('nombre') ?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE, true) ?>" name="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $TipoAmbiente->$nombre : ((isset($tipoAmbienteForm[$nombre])) ? $tipoAmbienteForm[$nombre] : '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('descripcion') ?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php
            echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION
                    , true)
?>" name="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $TipoAmbiente->$descripcion : '' ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION, true) ?>"class="col-sm-2 control-label"><?php echo i18nClass::__('observacion') ?></label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION, true) ?>" name="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $TipoAmbiente->$observacion : ((isset($tipoAmbienteForm[$nombre])) ? $tipoAmbienteForm[$nombre] : '') ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoAmbiente', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoAmbiente', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> <?php echo i18nClass::__('cancelar') ?></a>
        </div>
    </div>
<?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID, true) ?>" name="<?php echo tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID, true) ?>" value="<?php echo $TipoAmbiente->$id ?>">
<?php endif; ?>
</form>