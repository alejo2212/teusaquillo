<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = entradaBodegaTableClass::ID ?>
        <?php $empleado = entradaBodegaTableClass::EMPLEADO_ID ?>
        <?php $transportador = entradaBodegaTableClass::TRANSPORTADOR_ID ?>
        <?php $fechaentrada = entradaBodegaTableClass::FECHA_ENTRADA ?>
        <?php $remision = entradaBodegaTableClass::REMISION ?>
        <?php $observacion = entradaBodegaTableClass::OBSERVACION ?>


        <legend><h1><i class="fa fa-user"></i> Entrada Bodega "<?php echo $objentradaBodega->$id ?>"</h1></legend>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Empleado</h4>
                <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objentradaBodega->$empleado) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Transportador</h4>
                <p class="list-group-item-text"><?php echo transportadorTableClass::getNombreById($objentradaBodega->$transportador) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Fecha de entrada </h4>
                <p class="list-group-item-text"><?php echo ($objentradaBodega->$fechaentrada) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objentradaBodega->$fechaentrada))) : 'No Registrada' ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Remision </h4>
                <p class="list-group-item-text"><?php echo $objentradaBodega->$remision ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Observacion </h4>
                <p class="list-group-item-text"><?php echo $objentradaBodega->$observacion ?></p>
            </div>
        </div>

    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', 'edit', array($id => $objentradaBodega->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>