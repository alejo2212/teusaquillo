<?php use mvc\translator\translatorClass AS translator ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<?php $idLote = loteTableClass::ID ?>
<?php $nomLote = loteTableClass::LOTE ?>
<?php $idEmple = empleadoTableClass::ID ?>
<?php $nomEmple = empleadoTableClass::NOMBRE ?>
<?php $idSalida = salidaInsumoDetalleTableClass::ID ?>
<?php $id = registroAlistamientoTableClass::ID ?>
<?php $empleado = registroAlistamientoTableClass::EMPLEADO_ID ?>
<?php $lote = registroAlistamientoTableClass::LOTE_ID ?>
<?php $salida = registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $fecha_ini = registroAlistamientoTableClass::FECHA_INICIO ?>
<?php $fecha_fin = registroAlistamientoTableClass::FECHA_FIN ?>
<?php $fecha_ini_cortina = registroAlistamientoTableClass::FECHA_INICIO_CORTINA ?>
<?php $fecha_fin_cortina = registroAlistamientoTableClass::FECHA_FIN_CORTINA ?>
<?php $fecha_ini_cama = registroAlistamientoTableClass::FECHA_ENTRADA_CAMA ?>
<?php $fecha_fin_cama = registroAlistamientoTableClass::FECHA_TERMINO_CAMA ?>
<?php $fecha_equipo = registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO ?>

<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-bookmark"></i> Realizador "<?php echo empleadoTableClass::getEmpleadoById($registroAlistamiento->$empleado) ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Lote</h4>
        <p class="list-group-item-text"><?php echo loteTableClass::getLote($registroAlistamiento->$lote) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Salida Insumo</h4>
        <p class="list-group-item-text"><?php echo $registroAlistamiento->$salida ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Inicio</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_ini) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_ini))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Finalizacion</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_fin) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_fin))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Inico Cortina</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_ini_cortina) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_ini_cortina))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Finalizacion Cortina</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_fin_cortina) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_fin_cortina))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Inico Cama</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_ini_cama) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_ini_cama))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Finalizacion Cama</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_fin_cama) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_fin_cama))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Entrada del Equipo</h4>
        <p class="list-group-item-text"><?php echo ($registroAlistamiento->$fecha_equipo) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($registroAlistamiento->$fecha_equipo))) : 'No Registrada' ?></p>
      </div>
    </div>
    
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'edit', array($id => $registroAlistamiento->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>