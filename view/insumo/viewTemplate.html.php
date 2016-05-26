<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = insumoTableClass::ID ?>
        <?php $actived = insumoTableClass::ACTIVO ?>
        <?php $nombre = insumoTableClass::NOMBRE ?>
        <?php $tpinsumo = insumoTableClass::TIPO_INSUMO_ID ?>
        <?php $prinsumo = insumoTableClass::PRESENTACION_ID ?>
        <?php $unid = insumoTableClass::UNIDAD_MEDIDA_ID ?>
        <?php $existencia = insumoTableClass::INVENTARIO_BODEGA ?>

        <legend><h1><i class="fa fa-user"></i> Insumo "<?php echo $objinsumo->$nombre ?>"</h1></legend>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('activado') ?></h4>
                <p class="list-group-item-text"><?php echo ($objinsumo->$actived) ? i18nClass::__('si') : i18nClass::__('no') ?></p>
            </div>
        </div>
       
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Tipo Insumo</h4>
                <p class="list-group-item-text"><?php echo tipoInsumoTableClass::getNombreById ($objinsumo->$tpinsumo) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Presentacion de Insumo</h4>
                <p class="list-group-item-text"><?php echo presentacionTableClass::getNombreById ($objinsumo->$prinsumo) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Unidad Medida de Insumo</h4>
                <p class="list-group-item-text"><?php echo unidadMedidaTableClass::getNombreById ($objinsumo->$unid) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Cantidad Almacenada en Bodega</h4>
                <p class="list-group-item-text"><?php echo $objinsumo->$existencia ?></p>
            </div>
        </div>

    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'edit', array($id => $objinsumo->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>