<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = salidaInsumoTableClass::ID ?>
        <?php $empleSal = salidaInsumoTableClass::EMPLEADO_ID_SALIDA ?>
        <?php $empleRec = salidaInsumoTableClass::EMPLEADO_ID_RECEPCION ?>
        <?php $fecha = salidaInsumoTableClass::FECHA ?>
        <?php $observacion = salidaInsumoTableClass::OBSERVACION ?>
        <?php $anulado = salidaInsumoTableClass::ANULADO ?>
        <?php $requisi = salidaInsumoTableClass::REQUISICION_ID ?>


        <legend><h1><i class="fa fa-user"></i><?php echo i18nClass::__('empleadoEntrega') ?> "<?php echo $salidaInsumo->$empleSal ?>"</h1></legend>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('empleadoEntrega') ?></h4>
                <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($salidaInsumo->$empleSal) ?></p>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('empleadoRecibe') ?></h4>
                <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($salidaInsumo->$empleRec) ?></p>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('observacion') ?></h4>
                <p class="list-group-item-text"><?php echo ($salidaInsumo->$observacion) ? $salidaInsumo->$observacion : 'Ninguna' ?></p>
            </div>
            <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('anulado') ?></h4>
        <p class="list-group-item-text"><?php echo ($salidaInsumo->$anulado) ? i18nClass::__('no') : i18nClass::__('si') ?></p>
      </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('requisicion') ?></h4>
                <p class="list-group-item-text"><?php echo $salidaInsumo->$requisi ?></p>
            </div>
        </div>
    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'edit', array($id => $salidaInsumo->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i><?php echo i18nClass::__('editar') ?> </a>
    </div>
</div>