<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $idMa = maquinaTableClass::ID ?>
    <?php $nombreMa = maquinaTableClass::DESCRIPCION ?>
    <?php $idEmp = empleadoTableClass::ID ?>
    <?php $nombreEmp = empleadoTableClass::NOMBRE ?>
    <?php $idTma = tipoMantenimientoTableClass::ID ?>
    <?php $nombreTma = tipoMantenimientoTableClass::NOMBRE ?>
    <?php $id = mantenimientoTableClass::ID ?>
    <?php $maquina = mantenimientoTableClass::MAQUINA_ID ?>
    <?php $empleado = mantenimientoTableClass::EMPLEADO_ID ?>
    <?php $tipoMante = mantenimientoTableClass::TIPO_MANTENIMIENTO_ID ?>
    <?php $fechaini = mantenimientoTableClass::FECHA_INICIO ?>
    <?php $fechafin = mantenimientoTableClass::FECHA_FIN ?>
    <?php $causa = mantenimientoTableClass::CAUSA ?>
    <?php $arreglo = mantenimientoTableClass::ARREGLO ?>
    <?php $observacion = mantenimientoTableClass::OBSERVACION ?>
    <legend><h1><i class="fa fa-bookmark"></i> Mantenimiento </h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Maquina</h4>
        <p class="list-group-item-text"><?php echo maquinaTableClass::getMaquinaById($objMante->$maquina) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Empleado</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objMante->$empleado) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Tipo de Mantenimiento</h4>
        <p class="list-group-item-text"><?php echo tipoMantenimientoTableClass::getTipoManteById($objMante->$tipoMante) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Inicio del Mantenimiento</h4>
        <p class="list-group-item-text"><?php echo ($objMante->$fechaini) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objMante->$fechaini))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Finalizacion del Mantenimiento</h4>
        <p class="list-group-item-text"><?php echo ($objMante->$fechafin) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objMante->$fechafin))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Causa</h4>
        <p class="list-group-item-text"><?php echo $objMante->$causa ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Arreglo</h4>
        <p class="list-group-item-text"><?php echo $objMante->$arreglo ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objMante->$observacion) ? $objMante->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'edit', array($id => $objMante->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>