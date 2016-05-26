<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $alistamientoReparacionTableClassform = session::getInstance()->getFlash('alistamientoReparacion') ?>
<?php $id = alistamientoReparacionTableClass::ID ?>
<?php $registoali = alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID ?>
<?php $tiporepa = alistamientoReparacionTableClass::TIPO_REPARACION_ID ?>
<?php $fechaini = alistamientoReparacionTableClass::FECHA_INICIO ?>
<?php $fechafin = alistamientoReparacionTableClass::FECHA_FIN ?>
<?php $idtiporepa = tipoReparacionTableClass::ID ?>
<?php $nombretiporepa = tipoReparacionTableClass::NOMBRE ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <div class="form-group">
        <label for="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true) ?>" class="col-sm-2 control-label">Registro Alistamiento</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true) ?>" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objalistamientoReparacion->$registoali : ((isset($alistamientoReparacionTableClassform[$registoali])) ? $alistamientoReparacionTableClassform[$registoali] : '') ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Tipo de Reparacion</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true) ?>" id="<?php echo tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objtiporepa as $datarepa): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objalistamientoReparacion->$tiporepa == $datarepa->$idtiporepa)) ? 'selected' : ((isset($alistamientoReparacionTableClassform[$tiporepa]) and ( $alistamientoReparacionTableClassform[$tiporepa] == $datarepa->$idtiporepa)) ? 'selected ' : '')) ?> value="<?php echo $datarepa->$idtiporepa ?>"><?php echo $datarepa->$nombretiporepa ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true) ?>" class="col-sm-2 control-label">Fecha de Inicio</label>
        <div class="col-sm-10">
            <input type="datetime-local" class="form-control" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true) ?>" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objalistamientoReparacion->$fechaini) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objalistamientoReparacion->$fechaini)) : '' : ((isset($alistamientoReparacionTableClassform[$fechaini])) ? $alistamientoReparacionTableClassform[$fechaini] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_FIN, true) ?>" class="col-sm-2 control-label">Fecha de Finalizacion</label>
        <div class="col-sm-10">
            <input type="datetime-local" class="form-control" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_FIN, true) ?>" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_FIN, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objalistamientoReparacion->$fechafin) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objalistamientoReparacion->$fechafin)) : '' : ((isset($alistamientoReparacionTableClassform[$fechafin])) ? $alistamientoReparacionTableClassform[$fechafin] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID, true) ?>" name="<?php echo alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID, true) ?>" value="<?php echo $objalistamientoReparacion->$id ?>">
    <?php endif; ?>
</form>