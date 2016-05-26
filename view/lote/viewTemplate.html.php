<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
     
<?php $id = loteTableClass::ID ?>
<?php $nlote = loteTableClass::LOTE ?>
<?php $fEntradaG = loteTableClass::FECHA_ENTRADA_GRANJA ?>
<?php $fSalidaEs = loteTableClass::FECHA_SALIDA_ESTIPULADA ?>
<?php $fSalidaR = loteTableClass::FECHA_SALIDA_REAL ?>
<?php $razaId = loteTableClass::RAZA_ID ?>
<?php $pesoPm = loteTableClass::PESO_PROMEDIO_MACHOS ?>
<?php $pesoPh = loteTableClass::PESO_PROMEDIO_HEMBRAS ?>
<?php $cantM = loteTableClass::CANTIDAD_MACHOS ?>
<?php $cantH = loteTableClass::CANTIDAD_HEMBRAS ?>
<?php $cantT = loteTableClass::CANTIDAD_TOTAL ?>
<?php $fEntradaProduc = loteTableClass::FECHA_ENTRA_PRODUCCION ?>
<?php $observacion = loteTableClass::OBSERVACION ?>
<?php $empleId = loteTableClass::EMPLEADO_ID ?>
      
    <legend><h1><i class="fa fa-user"></i> <?php echo i18nClass::__('lote') ?> "<?php echo $lote->$nlote ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaEntradaGranja') ?></h4>
        <p class="list-group-item-text"><?php echo ($lote->$fEntradaG) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($lote->$fEntradaG))) : 'No Registrada' ?></p>
      </div>
    </div>
    
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaSalidaEstipulada') ?></h4>
        <p class="list-group-item-text"><?php  echo ($lote->$fSalidaEs) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($lote->$fSalidaEs))): 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaSalidaReal') ?></h4>
        <p class="list-group-item-text"><?php echo ($lote->$fSalidaR) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($lote->$fSalidaR))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('raza') ?></h4>
        <p class="list-group-item-text"><?php echo razaTableClass::getNombreById($lote->$razaId) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('pesoPromedioMachos') ?></h4>
        <p class="list-group-item-text"><?php echo $lote->$pesoPm ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('pesoPromedioHembras') ?></h4>
        <p class="list-group-item-text"><?php echo $lote->$pesoPh ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidadMachos') ?></h4>
        <p class="list-group-item-text"><?php echo $lote->$cantM ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidadHembras') ?></h4>
        <p class="list-group-item-text"><?php echo $lote->$cantH ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('cantidadTotal') ?></h4>
        <p class="list-group-item-text"><?php echo $lote->$cantT ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('fechaEntradaProduccion') ?></h4>
        <p class="list-group-item-text"><?php echo ($lote->$fEntradaProduc) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($lote->$fEntradaProduc))): 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('observacion') ?></h4>
        <p class="list-group-item-text"><?php echo ($lote->$observacion) ? $lote->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('empleado') ?></h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($lote->$empleId) ?></p>
      </div>
    </div>
    
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> <?php echo i18nClass::__('volver') ?> </a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'edit', array($id => $lote->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i><?php echo i18nClass::__('editar') ?></a>
  </div>
</div>