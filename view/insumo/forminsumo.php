<?php

use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $insumoform = session::getInstance()->getFlash('insumo') ?>
<?php $id = insumoTableClass::ID ?>
<?php $actived = insumoTableClass::ACTIVO ?>
<?php $nombre = insumoTableClass::NOMBRE ?>
<?php $tpinsumo = insumoTableClass::TIPO_INSUMO_ID ?>
<?php $prinsumo = insumoTableClass::PRESENTACION_ID ?>
<?php $unimedi = insumoTableClass::UNIDAD_MEDIDA_ID ?>
<?php $existencia = insumoTableClass::INVENTARIO_BODEGA ?>
<?php $idtipoinsumo = tipoInsumoTableClass::ID ?>
<?php $nombretipoinsu = tipoInsumoTableClass::NOMBRE ?>
<?php $idpresentacion = presentacionTableClass::ID ?>
<?php $nombrepresentacion = presentacionTableClass::NOMBRE ?>
<?php $idunidadmedida = unidadMedidaTableClass::ID ?>
<?php $nombreunidadmedida = unidadMedidaTableClass::NOMBRE ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <?php if (isset($edit) and $edit): ?>
        <div class="form-group">
            <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::ACTIVO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
            <div class="col-sm-10 checkboxFlow">
                <input type="checkbox" class="form-control" id="<?php echo insumoTableClass::getNameField(insumoTableClass::ACTIVO, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ACTIVO, true) ?>" value="t" <?php echo ($objinsumo->$actived) ? 'checked' : '' ?>>
                <input type="hidden" id="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" value="<?php echo $objinsumo->$id ?>">
            </div>
        </div>
    <?php endif ?>

    <div class="form-group">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objinsumo->$nombre : ((isset($insumoform[$nombre])) ? $insumoform[$nombre] : '')  ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Tipo de Insumo</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true) ?>" id="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objtipoinsumo as $datatipoinsumo): ?>
                <option <?php echo (((isset($edit) and $edit) and ($objinsumo->$tpinsumo == $datatipoinsumo->$idtipoinsumo)) ? 'selected' : ((isset($insumoform[$tpinsumo]) and ($insumoform[$tpinsumo] == $datatipoinsumo->$idtipoinsumo)) ? 'selected ' : '')) ?> value="<?php echo $datatipoinsumo->$idtipoinsumo ?>"><?php echo $datatipoinsumo->$nombretipoinsu ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Presentacion de Insumo</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true) ?>" id="<?php echo presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objpresentacion as $datapresentacion): ?>
                    <option <?php echo (((isset($edit) and $edit) and ($objinsumo->$prinsumo == $datapresentacion->$idpresentacion)) ? 'selected' : ((isset($insumoform[$prinsumo]) and ($insumoform[$prinsumo] == $datapresentacion->$idpresentacion)) ? 'selected ' : '')) ?> value="<?php echo $datapresentacion->$idpresentacion ?>"><?php echo $datapresentacion->$nombrepresentacion ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Unidad Medida de Insumo</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true) ?>" id="<?php echo unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true) ?>">
                <option value="" >Seleccione</option>
                <?php foreach ($objunidadmedida as $dataunidadmedida): ?>
                    <option <?php echo (((isset($edit) and $edit) and ($objinsumo->$unimedi == $dataunidadmedida->$idunidadmedida)) ? 'selected' : ((isset($insumoform[$unimedi]) and ($insumoform[$unimedi] == $dataunidadmedida->$idunidadmedida)) ? 'selected ' : '')) ?> value="<?php echo $dataunidadmedida->$idunidadmedida ?>"><?php echo $dataunidadmedida->$nombreunidadmedida ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <!--<label for="<?php echo insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true) ?>" class="col-sm-2 control-label">Cantidad en Bodega</label>-->
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="<?php echo insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objinsumo->$existencia : ((isset($insumoform[$existencia])) ? $insumoform[$existencia] : 0) ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" value="<?php echo $objinsumo->$id ?>">
    <?php endif; ?>
</form>