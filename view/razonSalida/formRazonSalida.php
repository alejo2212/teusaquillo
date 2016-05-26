
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\i18n\i18nClass ?>
<?php $id = razonSalidaTableClass::ID ?>
<?php $razon = razonSalidaTableClass::RAZON ?>
<?php $observacion = razonSalidaTableClass::OBSERVACION ?>
<?php $razonSalidaForm = session::getInstance()->getFlash('razonSalida') ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
    <div class="form-group">
        <label for="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('razon') ?></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON, true) ?>" name="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objRazonSalidaE->$razon : ((isset($razonSalidaForm[$razon])) ? $razonSalidaForm[$razon] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('observacion') ?></label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::OBSERVACION, true) ?>" name="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::OBSERVACION, true) ?>"> <?php echo (isset($edit) and $edit) ? $objRazonSalidaE->$observacion : ((isset($razonSalidaForm[$observacion])) ? $razonSalidaForm[$observacion] : '') ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?></a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i><?php echo i18nClass::__('registrar') ?> </button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i><?php echo i18nClass::__('cancelar') ?></a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::ID, true) ?>" name="<?php echo razonSalidaTableClass::getNameField(razonSalidaTableClass::ID, true) ?>" value="<?php echo $objRazonSalidaE->$id ?>">
<?php endif; ?>
</form>