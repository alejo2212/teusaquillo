<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = alistamientoReparacionTableClass::ID ?>
        <?php $registoali = alistamientoReparacionTableClass:: REGISTRO_ALISTAMIENTO_ID ?>
        <?php $tiporepa = alistamientoReparacionTableClass::TIPO_REPARACION_ID ?>
        <?php $fechaini = alistamientoReparacionTableClass::FECHA_INICIO ?>
        <?php $fechafin = alistamientoReparacionTableClass::FECHA_FIN ?>


        <legend><h1><i class="fa fa-user"></i> Alistamiento Reparacion "<?php echo $objalistamientoReparacion->$id ?>"</h1></legend>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Registro Alistamiento</h4>
                <p class="list-group-item-text"><?php echo $objalistamientoReparacion->$registoali ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Tipo de Reparacion</h4>
                <p class="list-group-item-text"><?php echo tipoReparacionTableClass::getNombreById($objalistamientoReparacion->$tiporepa) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Fecha de inicio </h4>
                <p class="list-group-item-text"><?php echo ($objalistamientoReparacion->$fechaini) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objalistamientoReparacion->$fechaini))) : 'No Registrada' ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Fecha de Finalizacion </h4>
                <p class="list-group-item-text"><?php echo ($objalistamientoReparacion->$fechafin) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objalistamientoReparacion->$fechafin))) : 'No Registrada' ?></p>
            </div>
        </div>

    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'edit', array($id => $objalistamientoReparacion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>