<?php use mvc\translator\translatorClass AS translator ?>
<?php

use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = salidaLoteTableClass::ID ?>
    <?php $ambhislote = salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID ?>
    <?php $fecha = salidaLoteTableClass::FECHA_REALI ?>
    <?php $razonsal = salidaLoteTableClass::RAZON_SALIDA_ID ?>
    <?php $cantt = salidaLoteTableClass::CANTIDAD_TOTAL ?>
    <?php $cantm = salidaLoteTableClass::CANTIDAD_MACHOS ?>
    <?php $canth = salidaLoteTableClass::CANTIDAD_HEMBRAS ?>
    <?php $empl = salidaLoteTableClass::EMPLEADO_ID ?>
    <?php $idAhl = ambienteHistorialLoteTableClass::ID ?>
    <?php $casetaAhl = ambienteHistorialLoteTableClass::NO_CASETA ?>
    <?php $nomAmbi = ambienteTableClass::NOMBRE ?>
    <?php $lote = loteTableClass::LOTE ?>
    <?php $ambi = ambienteHistorialLoteTableClass::getAmbienteHistLoteById($salidaLote->$ambhislote) ?>

    <legend><h1><i class="fa fa-user"></i> <?php echo i18nClass::__('ambienteHistorialLote') ?> "<?php echo $ambi->$nomAmbi . ' - Lote:' . $ambi->$lote . ' - Caseta:' . $ambi->$casetaAhl ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Realizacion</h4>
        <p class="list-group-item-text"><?php echo ($salidaLote->$fecha) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($salidaLote->$fecha))) : 'No Registrada' ?></p>
      </div>
    </div>    
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('razon') ?></h4>
        <p class="list-group-item-text"><?php echo razonSalidaTableClass::getNombreById($salidaLote->$razonsal) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidadTotal') ?></h4>
        <p class="list-group-item-text"><?php echo $salidaLote->$cantt ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidadMachos') ?></h4>
        <p class="list-group-item-text"><?php echo $salidaLote->$cantm ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidadHembras') ?></h4>
        <p class="list-group-item-text"><?php echo $salidaLote->$canth ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('empleado') ?></h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($salidaLote->$empl) ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i>  <?php echo i18nClass::__('volver') ?></a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'edit', array($id => $salidaLote->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i><?php echo i18nClass::__('editar') ?> </a>
  </div>
</div>