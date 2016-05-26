<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $transportdorForm = session::getInstance()->getFlash('transportador') ?>
<?php $id = transportadorTableClass::ID ?>
<?php $nombre = transportadorTableClass::NOMBRE ?>
<?php $placa = transportadorTableClass::PLACA_VAHICULO ?>
<?php $observacion = transportadorTableClass::OBSERVACION ?>
<?php $transportadorForm = session::getInstance()->getFlash('transportador') ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="form-group">
        <label for="<?php echo transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true) ?>" name="<?php echo transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtransportador->$nombre : ((isset($transportdorForm[$nombre])) ? $transportadorForm[$nombre] : '') ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="<?php echo transportadorTableClass::getNameField(transportadorTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo transportadorTableClass::getNameField(transportadorTableClass::OBSERVACION, true) ?>" name="<?php echo transportadorTableClass::getNameField(transportadorTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtransportador->$observacion : ((isset($transportdorForm[$observacion])) ? $transportadorForm[$observacion] : '') ?>">
        </div>
    </div>
  <div class="form-group">
        <label for="<?php echo transportadorTableClass::getNameField(transportadorTableClass::PLACA_VAHICULO, true) ?>" class="col-sm-2 control-label">Placa del Vehiculo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo transportadorTableClass::getNameField(transportadorTableClass::PLACA_VAHICULO, true) ?>" name="<?php echo transportadorTableClass::getNameField(transportadorTableClass::PLACA_VAHICULO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objtransportador->$placa : ((isset($transportdorForm[$placa])) ? $transportadorForm[$placa] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo transportadorTableClass::getNameField(transportadorTableClass::ID, true) ?>" name="<?php echo transportadorTableClass::getNameField(transportadorTableClass::ID, true) ?>" value="<?php echo $objtransportador->$id ?>">
<?php endif; ?>
</form>