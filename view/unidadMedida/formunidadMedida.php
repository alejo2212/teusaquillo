<?php

use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $unidadMedidaForm = session::getInstance()->getFlash('unidadMedida') ?>
<?php $id = unidadMedidaTableClass::ID ?>
<?php $nombre = unidadMedidaTableClass::NOMBRE ?>
<?php $sigla = unidadMedidaTableClass::SIGLA ?>
<?php $observacion = unidadMedidaTableClass::OBSERVACION ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="form-group">
        <label for="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true) ?>" name="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objunidadMedida->$nombre : ((isset($unidadMedidaForm[$nombre])) ? $unidadMedidaForm[$nombre] : '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA, true) ?>" class="col-sm-2 control-label">Sigla</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA, true) ?>" name="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objunidadMedida->$sigla : ((isset($unidadMedidaForm[$nombre])) ? $unidadMedidaForm[$sigla] : '') ?>">
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION, true) ?>" name="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objunidadMedida->$observacion : ((isset($unidadMedidaForm[$nombre])) ? $unidadMedidaForm[$observacion] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID, true) ?>" name="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID, true) ?>" value="<?php echo $objunidadMedida->$id ?>">
<?php endif; ?>
</form>