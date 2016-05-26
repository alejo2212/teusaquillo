<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = tipoReparacionTableClass::ID ?>
<?php $nombre = tipoReparacionTableClass::NOMBRE ?>
<?php $observacion = tipoReparacionTableClass::OBSERVACION ?>
<?php $tipoReparacionForm = session::getInstance()->getFlash('tipoReparacion') ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoReparacion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="form-group">
        <label for="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true) ?>" name="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoReparacion->$nombre : ((isset($tipoReparacionForm[$nombre])) ? $tipoReparacionForm[$nombre] : '') ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::OBSERVACION, true) ?>" name="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoReparacion->$observacion : ((isset($tipoReparacionForm[$observacion])) ? $tipoReparacionForm[$observacion] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoReparacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoReparacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID, true) ?>" name="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID, true) ?>" value="<?php echo $objtipoReparacion->$id ?>">
<?php endif; ?>
</form>