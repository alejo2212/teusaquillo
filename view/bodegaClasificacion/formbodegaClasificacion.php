<?php

use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $clasibodeform = session::getInstance()->getFlash('clasibodega') ?>
<?php $id = bodegaClasificacionTableClass::ID ?>
<?php $nombre = bodegaClasificacionTableClass::NOMBRE ?>
<?php $actived = bodegaClasificacionTableClass::ACTIVO ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <?php if (isset($edit) and $edit): ?>
        <div class="form-group">
            <label for="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ACTIVO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
            <div class="col-sm-10 checkboxFlow">
                <input type="checkbox" class="form-control" id="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ACTIVO, true) ?>" name="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ACTIVO, true) ?>" value="t" <?php echo ($objbodegaClasificacion->$actived) ? 'checked' : '' ?>>
                <input type="hidden" id="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ID, true) ?>" name="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ID, true) ?>" value="<?php echo $objbodegaClasificacion->$id ?>">
            </div>
        </div>
    <?php endif ?>

    <div class="form-group">
        <label for="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" name="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objbodegaClasificacion->$nombre : ((isset($clasibodeform[$nombre])) ? $clasibodeform[$nombre] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ID, true) ?>" name="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ID, true) ?>" value="<?php echo $objbodegaClasificacion->$id ?>">
    <?php endif; ?>
</form>