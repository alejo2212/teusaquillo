<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = razonSalidaTableClass::ID ?>
        <?php $razon = razonSalidaTableClass::RAZON ?>
        <?php $observacion = razonSalidaTableClass::OBSERVACION ?>


        <legend><h1><i class="fa fa-user"></i><?php echo i18nClass::__('razon') ?>"<?php echo $razonSalida->$razon ?>"</h1></legend>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('observacion') ?></h4>
                <p class="list-group-item-text"><?php echo $razonSalida->$observacion ?></p>
            </div>
        </div>

    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'edit', array($id => $razonSalida->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i><?php echo i18nClass::__('editar') ?> </a>
    </div>
</div>