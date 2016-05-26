<?phpuse mvc\i18n\i18nClass ?>
        <?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = tipoReparacionTableClass::ID ?>
<?php $nombre = tipoReparacionTableClass::NOMBRE ?>
<?php $observacion = tipoReparacionTableClass::OBSERVACION ?>
        <legend><h1><i class="fa fa-user"></i> Nombre "<?php echo $objtipoReparacion->$nombre ?>"</h1></legend>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Observacion</h4>
                <p class="list-group-item-text"><?php echo $objtipoReparacion->$observacion ?></p>
            </div>
        </div>
    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoReparacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoReparacion', 'edit', array($id => $objtipoReparacion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>