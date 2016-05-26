<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = ambienteHistorialLoteTableClass::ID ?>
        <?php $ambiente = ambienteHistorialLoteTableClass::AMBIENTE_ID ?>
        <?php $lote = ambienteHistorialLoteTableClass::LOTE_ID ?>
        <?php $numerocaseta = ambienteHistorialLoteTableClass::NO_CASETA ?>
        <?php $canth = ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS ?>
        <?php $cantm = ambienteHistorialLoteTableClass::CANTIDAD_MACHOS ?>


        <legend><h1><i class="fa fa-user"></i> Ambiente Historial Lote "<?php echo $objambienteHistorialLote->$id ?>"</h1></legend>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Ambiente</h4>
                <p class="list-group-item-text"><?php echo ambienteTableClass::getNombreById($objambienteHistorialLote->$ambiente) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Lote</h4>
                <p class="list-group-item-text"><?php echo loteTableClass::getNombreById($objambienteHistorialLote->$lote) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Numero de caseta </h4>
                <p class="list-group-item-text"><?php echo $objambienteHistorialLote->$numerocaseta ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Cantidad de Hembras</h4>
                <p class="list-group-item-text"><?php echo $objambienteHistorialLote->$canth ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Cantidad de Machos </h4>
                <p class="list-group-item-text"><?php echo $objambienteHistorialLote->$cantm ?></p>
            </div>
        </div>

    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', 'edit', array($id => $objambienteHistorialLote->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>