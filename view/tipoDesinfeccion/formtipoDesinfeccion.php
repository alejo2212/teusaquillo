<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = tipoDesinfeccionTableClass::ID ?>
<?php $nombre = tipoDesinfeccionTableClass::NOMBRE ?>
<?php $observacion = tipoDesinfeccionTableClass::OBSERVACION ?>
<?php $tipoDesinfeccion = session::getInstance()->getFlash('tipoDesinfeccion') ?>
<?php \mvc\view\viewClass::includeHandlerMessage() ?><!--es para mostrar los mensajes-->

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="form-group">
        <label for="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" maxlength="10" id="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true) ?>" name="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoDesinfeccion->$nombre :  ((isset($tipoDesinfeccion[$nombre])) ? $tipoDesinfeccion[$nombre] :'') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true) ?>" name="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objtipoDesinfeccion->$observacion :  ((isset($tipoDesinfeccion[$observacion])) ? $tipoDesinfeccion[$observacion] :'') ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true) ?>" name="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true) ?>" value="<?php echo $objtipoDesinfeccion->$id ?>">
<?php endif; ?>
</form>