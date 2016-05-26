<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = bodegaClasificacionTableClass::ID ?>
        <?php $nombre = bodegaClasificacionTableClass::NOMBRE ?>
        <?php $actived = bodegaClasificacionTableClass::ACTIVO ?>

        <legend><h1><i class="fa fa-user"></i> Bodega Clasificacion "<?php echo $objbodegaClasificacion->$nombre ?>"</h1></legend>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('activado') ?></h4>
                <p class="list-group-item-text"><?php echo ($objbodegaClasificacion->$actived) ? i18nClass::__('si') : i18nClass::__('no') ?></p>
            </div>
        </div>
    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'edit', array($id => $objbodegaClasificacion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>