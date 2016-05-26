<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $entradaBodegaform = session::getInstance()->getFlash('entradaBodega') ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php $empleado = entradaBodegaTableClass::EMPLEADO_ID ?>
<?php $transportador = entradaBodegaTableClass::TRANSPORTADOR_ID ?>
<?php $fechaentrada = entradaBodegaTableClass::FECHA_ENTRADA ?>
<?php $remision = entradaBodegaTableClass::REMISION ?>
<?php $observacion = entradaBodegaTableClass::OBSERVACION ?>
<?php $idempleado = empleadoTableClass::ID ?>
<?php $nombreempleado = empleadoTableClass::NOMBRE ?>
<?php $idtransportador = transportadorTableClass::ID ?>
<?php $nombretransportador = transportadorTableClass::NOMBRE ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Empleado</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objempleado as $dataempleado): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objentradaBodega->$empleado == $dataempleado->$idempleado)) ? 'selected' : ((isset($entradaBodegaform[$empleado]) and ($entradaBodegaform[$empleado] == $dataempleado->$idempleado)) ? 'selected ' : '')) ?> value="<?php echo $dataempleado->$idempleado ?>"><?php echo $dataempleado->$nombreempleado ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Transportador</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true) ?>" id="<?php echo transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objtransportador as $datatransportador): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objentradaBodega->$transportador == $datatransportador->$idtransportador)) ? 'selected' : ((isset($entradaBodegaform[$transportador]) and ($entradaBodegaform[$transportador] == $datatransportador->$idtransportador)) ? 'selected ' : '')) ?> value="<?php echo $datatransportador->$idtransportador ?>"><?php echo $datatransportador->$nombretransportador ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA_ENTRADA, true) ?>" class="col-sm-2 control-label">Fecha de entrada</label>
        <div class="col-sm-10">
            <input type="datetime-local" class="form-control" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA_ENTRADA, true) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA_ENTRADA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objentradaBodega->$fechaentrada) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objentradaBodega->$fechaentrada)) : '' : ((isset($entradaBodegaform[$fechaentrada])) ? $entradaBodegaform[$fechaentrada] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true) ?>" class="col-sm-2 control-label">N° Factura o Remision</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objentradaBodega->$remision : ((isset($entradaBodegaform[$remision])) ? $entradaBodegaform[$remision] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::OBSERVACION, true) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objentradaBodega->$observacion : ((isset($entradaBodegaform[$observacion])) ? $entradaBodegaform[$observacion] : '') ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, true) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, true) ?>" value="<?php echo $objentradaBodega->$id ?>">
    <?php endif; ?>
</form>