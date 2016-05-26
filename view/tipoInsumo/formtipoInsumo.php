<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = tipoInsumoTableClass::ID ?>
<?php $nombre = tipoInsumoTableClass::NOMBRE ?>
<?php $observacion = tipoInsumoTableClass::OBSERVACION ?>
<?php $tipoInsumoForm = session::getInstance()->getFlash('tipoInsumo') ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoInsumo', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="form-group">
        <label for="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true) ?>" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoInsumo->$nombre : ((isset($tipoInsumoForm[$nombre])) ? $tipoInsumoForm[$nombre] : '') ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true) ?>" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtipoInsumo->$observacion : ((isset($tipoInsumoForm[$observacion])) ? $tipoInsumoForm[$observacion] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoInsumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoInsumo', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true) ?>" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true) ?>" value="<?php echo $objtipoInsumo->$id ?>">
<?php endif; ?>
</form>